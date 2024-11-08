<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NitiController;
use App\Http\Controllers\Api\RitualController;
use App\Http\Controllers\Api\SebakController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ParkingController;
use App\Http\Controllers\Api\NitiloginController;
use App\Http\Controllers\Api\DarshanController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(NitiloginController::class)->group(function() {
    Route::post('/user-send-otp',  'sendOtp');
    Route::post('/user-verify-otp', 'verifyOtp');
});

Route::controller(NitiController::class)->group(function() {
    
    // Routes that do not require authentication
    Route::get('/manageniti', 'manageniti')->name('manageniti');
    Route::get('/daily_ritual_timing', 'dailyritualtimg')->name('dailyritualtimg');
    Route::get('/current_status_ritual', 'currentstatus')->name('currentstatus');

    // Routes that require authentication
    Route::middleware(['auth:sebak_api'])->group(function () {
        Route::post('/niti-start', 'start')->name('nitiStart');
        Route::post('/niti-end', 'end')->name('nitiEnd');
        Route::post('/niti-pause', 'pause')->name('nitiPause');
        Route::post('/niti-resume', 'resume')->name('nitiResume');
    });
});

Route::controller(DarshanController::class)->group(function() {
    Route::get('/daily_darshan', 'manageDarshan')->name('manageDarshan');
    Route::get('/current_status_darshan',  'currentDarshan')->name('currentDarshan');
});

Route::controller(RitualController::class)->group(function() {
    Route::get('/manage-ritual', 'manageritual')->name('manageRitual');
});

Route::controller(SebakController::class)->group(function() {
    Route::get('/manage-sebak',  'managesebak')->name('manageSebak');
});

Route::controller(EventController::class)->group(function() {
    Route::get('/manage-event', 'manageevent')->name('manageEvent');
});

Route::controller(ParkingController::class)->group(function() {
    Route::get('/parking-app', 'parkingApp')->name('parkingApp');
});

