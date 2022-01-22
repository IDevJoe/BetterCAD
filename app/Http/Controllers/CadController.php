<?php

namespace App\Http\Controllers;

use App\Events\UserStatusChange;
use App\Http\Resources\CadUser;
use App\Models\User;
use Illuminate\Http\Request;

class CadController extends Controller
{
    public function cadState(Request $request)
    {
        $units = CadUser::collection(User::where('current_status', '!=', '10-42')->where('socket_connected', 2)->get());
        return [
            'user' => new CadUser($request->user()),
            'bolos' => [],
            'calls' => [],
            'units' => $units
        ];
    }

    public function changeIdentifier(Request $request)
    {
        $this->validate($request, [
            'identifier' => 'required|string|regex:/^[A-Z0-9]{1,2}-[0-9]{1,3}$/'
        ]);
        $u = $request->user();
        $u->current_identifier = $request->get('identifier');
        $u->save();
        event(new UserStatusChange($u));
        return response(null, 204);
    }

    public function setStatus(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|string|regex:/^10-[0-9]{1,2}$/'
        ]);
        $u = $request->user();
        $u->current_status = $request->get('status');
        $u->socket_connected = 1;
        $u->save();
        event(new UserStatusChange($u));
        return response(null, 204);
    }
}
