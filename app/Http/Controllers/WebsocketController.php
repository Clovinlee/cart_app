<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Events\TestPrivateEvent;
use Illuminate\Http\Request;

class WebsocketController extends Controller
{
    //
    public function notify(Request $request)
    {

        $message = $request->message ?? "";
        $userId = $request->userId ?? 0;
        $mode = $request->mode ?? 0; //0 = public(default), 1 = private

        if ($mode == 0) {
            event(new TestEvent($message . "- Public - " . $userId));
        } else {
            event(new TestPrivateEvent($message . "- Private - " . $userId, $userId));
        }
    }
}
