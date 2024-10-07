<?php

use App\Jobs\SendPushNotificationJob;
use App\Jobs\SendPrayersEmailJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::job(new SendPrayersEmailJob)->dailyAt('18:00');
Schedule::job(new SendPushNotificationJob)->everyMinute();
