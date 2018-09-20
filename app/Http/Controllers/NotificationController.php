<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;

use Phrontlyne\Http\Requests;
use Phrontlyne\Http\Controllers\Controller;
use Illuminate\Support\Facades\Phrontlyne;



class NotificationController extends Controller
{
    public function renewalNotice()
    {
        return view('notifications.renewal');
    }

    public function postNotify(Request $request)
    {
        $notifyText = e($request->input('notify_text'));

        // TODO: Get Pusher instance from service container

        // TODO: The notification event data should have a property named 'text'

        // TODO: On the 'notifications' channel trigger a 'new-notification' event
    }
}
