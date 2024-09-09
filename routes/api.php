<?php

use App\Http\Controllers\API\AnalyticsController;
use App\Http\Controllers\API\DailyOfficeController;
use App\Http\Controllers\API\NewsletterController;
use App\Http\Controllers\API\PrayerController;
use App\Http\Controllers\API\VODController;
use App\Http\Controllers\API\LinksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('analytics', [AnalyticsController::class, 'store']);

Route::get('votd', [VodController::class, 'index']);
Route::post('newsletter', [NewsletterController::class, 'store']);
Route::get('prayer', [PrayerController::class, 'index']);
Route::post('prayer', [PrayerController::class, 'store']);
Route::post('prayer/{prayer:uuid}/prayed-for', [PrayerController::class, 'prayed_for']); // Route using UUID
Route::post('prayer/{prayer:uuid}/reported', [PrayerController::class, 'reported']); // Route using UUID

Route::get('links/countdown', [LinksController::class,'countdown']);
Route::get('msc', [DailyOfficeController::class, 'missionStClareReading']);
