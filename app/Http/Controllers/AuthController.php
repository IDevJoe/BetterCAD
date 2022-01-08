<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    private $auth;

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        $success = $this->auth->guard()->attempt(['email' => $request->get('email'),
            'password' => $request->get('password')]);
        if (!$success) {
            return response(null, 401);
        }
        $request->session()->regenerate();
        return response(null, 204);
    }

    /**
     * Logs the current user out
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request)
    {
        $this->auth->guard()->logout();
        return response(null, 204);
    }

    public function socDiscRed()
    {
        return Socialite::driver('discord')->scopes(['guilds'])->redirect();
    }

    private static function createUser($scuser)
    {
        return User::create([
            'name' => $scuser->name,
            'email' => $scuser->email,
            'password' => bcrypt(bin2hex(random_bytes(50))),
            'email_verified_at' => Carbon::now()
        ]);
    }

    public function signupCode(Request $request)
    {
        $code = Setting::getValue('GLOBAL_REGISTRATION_CODE');
        if ($code != $request->get('accesscode', bin2hex(random_bytes(15)))) {
            return view('error', ['error' => 'Code invalid. Try again.']);
        }
        $obj = $request->session()->get('accesscode.data');
        $u = User::create([
            'name' => $obj['username'],
            'email' => $obj['email'],
            'password' => $obj['password'],
            'email_verified_at' => Carbon::now()
        ]);
        $this->auth->guard()->login($u);
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    public function socDiscRet(Request $request)
    {
        $u = Socialite::driver('discord')->user();
        $at = $u->accessTokenResponseBody['access_token'];

        // Verify email has been confirmed
        if (!$u->user['verified']) {
            return response(null, 400);
        }

        // Fetch guilds
        $client = new Client();
        $greq = $client->get(
            'https://discord.com/api/users/@me/guilds',
            ['headers' => ['Authorization' => 'Bearer ' . $at]]
        );
        $guilds = json_decode($greq->getBody()->getContents());
        $inguild = false;
        $sid = Setting::getValue('DISCORD_SERVER_ID');
        if ($sid != null) {
            foreach ($guilds as $guild) {
                if ($guild->id == $sid) {
                    $inguild = true;
                    error_log("User is in guild.");
                    break;
                }
            }
        }

        // Lookup User
        $uu = User::where('email', $u->email)->first();

        if ($uu == null) {
            if (Setting::getValue("ALLOW_SELF_REGISTRATION", "false") == "false") {
                return view('error', ['error' => 'User does not exist and self registration is not enabled.']);
            }
            if ($inguild) {
                $uu = self::createUser($u);
            } elseif (!$inguild && $sid != null) {
                $request->session()->put(
                    'accesscode.data',
                    [
                        'username' => $u->name,
                        'email' => $u->email,
                        'password' => bcrypt(bin2hex(random_bytes(50)))
                    ]
                );
                return view('accesscode', ['username' => $u->name]);
            }
        }
        if (Setting::getValue("DISCORD_SERVER_FORCE", "false") == "true") {
            if (!$inguild) {
                return view('error', ['error' => 'User is not in the Discord server.']);
            }
        }

        // User exists. Finish login.
        $this->auth->guard()->login($uu);
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
}
