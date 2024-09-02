<?php

use App\Http\Controllers\Api\NewsletterController;
use App\Http\Controllers\API\VODController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('vod', [VodController::class, 'index']);
Route::post('newsletter', [NewsletterController::class, 'store']);
