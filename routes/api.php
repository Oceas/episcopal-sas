<?php

use App\Http\Controllers\Api\NewsletterController;
use App\Http\Controllers\Api\PrayerController;
use App\Http\Controllers\API\VODController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('vod', [VodController::class, 'index']);
Route::post('newsletter', [NewsletterController::class, 'store']);

Route::get('prayer', [PrayerController::class, 'index']);
Route::post('prayer', [PrayerController::class, 'store']);
Route::post('prayer/{prayer:uuid}/prayed-for', [PrayerController::class, 'prayed_for']); // Route using UUID
Route::post('prayer/{prayer:uuid}/reported', [PrayerController::class, 'reported']); // Route using UUID
