<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Disable the /register route by overriding it with a message or redirect
Route::get('/register', function () {
    return 'We do not allow registration at this time.';
})->name('register');

// Other routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/prayers', function () {
        return view('prayers');
    })->name('prayers');

    Route::get('/devices', [\App\Http\Controllers\DevicesController::class, 'index'])->name('devices');

    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include authentication routes
require __DIR__.'/auth.php';
