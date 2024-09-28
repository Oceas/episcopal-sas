<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendPushNotificationJob;


class NotificationController extends Controller
{

    public function sendGlobalNotification(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        SendPushNotificationJob::dispatch($request->title, $request->body);

        return response()->json(['message' => 'Notification queued for all devices']);
    }

}
