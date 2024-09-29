<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Jobs\SendPushNotificationJob;


class NotificationController extends Controller
{


    public function index() {

        // Fetch prayers with pagination
        $notifications = Notification::orderBy('created_at', 'desc')->paginate();

        return view('notifications', compact('notifications'));
    }

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
