<?php

namespace App\Jobs;

use App\Services\ExpoNotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPushNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        // No need to pass title and body, as this will pull notifications from the database
    }

    public function handle(ExpoNotificationService $expoNotificationService)
    {
        // Call the service to send all scheduled notifications
        $expoNotificationService->sendScheduledNotifications();
    }
}
