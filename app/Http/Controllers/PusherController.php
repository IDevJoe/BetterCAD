<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function webhookIntake(Request $request)
    {
        if (
            !$request->hasHeader('X-Pusher-Key')
            || !$request->hasHeader('X-Pusher-Signature')
            || $request->header('X-Pusher-Key') != env('PUSHER_APP_KEY')
        ) {
            return response("Forbidden.", 403);
        }

        $sig = hash_hmac('sha256', $request->getContent(), env('PUSHER_APP_SECRET'), false);
        if ($request->header('X-Pusher-Signature') != $sig) {
            return response("Forbidden.", 403);
        }

        // Request is now validated.

        $obj = json_decode($request->getContent());
        foreach ($obj->events as $e) {
            $this->processEvent($e);
        }
        return response(null, 204);
    }

    private function processEvent($data)
    {
        switch ($data->name) {
            case 'member_added':
                $u = User::find($data->user_id);
                if ($u == null) {
                    error_log('WARN: Unable to find user ' . $data->user_id);
                    break;
                }
                $u->socket_connected = 0;
                $u->save();
                break;
            case 'member_removed':
                $u = User::find($data->user_id);
                if ($u == null) {
                    error_log('WARN: Unable to find user ' . $data->user_id);
                    break;
                }
                $u->socket_connected = -1;
                $u->current_status = "10-42";
                $u->save();
                break;
        }
        error_log("Process event " . $data->name);
    }
}
