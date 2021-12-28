<?php

namespace App\Http\Controllers;

use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
}
