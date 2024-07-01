<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NitiController;
use App\Http\Controllers\Api\RitualController;
use App\Http\Controllers\Api\SebakController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ParkingController;





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(NitiController::class)->group(function() {
    Route::get('/manageniti',  'manageniti')->name('manageniti');
    Route::post('/niti-start', 'start')->name('nitiStart');
    Route::post('/niti-end', 'end')->name('nitiEnd');
    Route::post('/niti-pause', 'pause')->name('nitiPause');
    Route::post('/niti-resume', 'resume')->name('nitiResume');
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

