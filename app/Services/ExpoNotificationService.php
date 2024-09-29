<?php

namespace App\Services;

use App\Models\Device;
use App\Models\Notification;
use Illuminate\Support\Facades\Http;

class ExpoNotificationService
{
    protected $expoEndpoint = 'https://exp.host/--/api/v2/push/send';

    /**
     * Send notifications to all registered devices.
     *
     * @param string $title
     * @param string $body
     * @return void
     */
    public function sendNotificationToAllDevices($title, $body)
    {

        $devices = Device::where('is_active', true)
            ->whereNotNull('push_token')  // Ensures push_token is not null
            ->where('push_token', '!=', '')  // Ensures push_token is not an empty string
            ->where('push_token_valid', 1)  // Ensures push_token_valid is 1
            ->pluck('push_token')
            ->toArray();

        $chunks = array_chunk($devices, 100); // Expo allows up to 100 messages per request

        foreach ($chunks as $deviceTokens) {
            $messages = array_map(function ($token) use ($title, $body) {
                return [
                    'to' => $token,
                    'title' => $title,
                    'body' => $body,
                    'sound' => 'default'
                ];
            }, $deviceTokens);

            // Send request to Expo API
            Http::post($this->expoEndpoint, $messages);
        }
    }

    /**
     * Send scheduled notifications.
     *
     * @return void
     */
    public function sendScheduledNotifications()
    {

        $notifications = Notification::where('sent', false)
            ->where('scheduled_at', '<=', now())
            ->get();

        foreach ($notifications as $notification) {
            $this->sendNotificationToAllDevices($notification->title, $notification->body);
            $notification->update(['sent' => true]); // Mark notification as sent
        }
    }
}
