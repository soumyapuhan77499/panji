<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NitiController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SebakController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\YoutubeController;
use App\Http\Controllers\User\userController;
use App\Http\Controllers\TempleRitualController;
use App\Http\Controllers\sebayatregisterController;
use App\Http\Controllers\SebakLoginController;
use App\Http\Controllers\DeityController;


use App\Http\Controllers\Auth\LoginRegisterController;

Route::controller(SebakLoginController::class)->group(function () {
    // Public routes (accessible without authentication)
    Route::get('sebak/sebak-login', 'sebaklogin')->name('sebaklogin');
    Route::post('sebak/send-otp', 'sendOtp');
    Route::post('sebak/verify-otp', 'verifyOtp');
});

// login information route
Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/admin/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

// Niti information route
Route::controller(NitiController::class)->group(function(){
    Route::get('admin/manage-niti-details','managenitidetails')->name('managenitidetails');
    Route::get('admin/add-niti-details','addnitidetails');
    Route::post('admin/saveNiti', 'saveNiti')->name('saveNiti');
    Route::get('admin/delete-niti/{niti_id}', 'deletNiti')->name('deletNiti');
    Route::get('admin/edit-niti/{id}','editNiti')->name('editNiti');
    Route::put('admin/update-niti/{id}','update')->name('updateNiti');

    Route::get('admin/add-niti','addniti');
    Route::get('admin/manage-niti','manageniti')->name('manageniti');
    Route::post('admin/save-niti', 'saveNitiMaster')->name('saveNitiMaster');
    Route::delete('admin/delete-niti-master/{id}', 'deleteNitiMaster')->name('deletNitiMaster');
    Route::get('admin/edit-niti-master/{id}','editNitiMaster')->name('editNitiMaster');
    Route::put('admin/update-niti-master/{id}', 'updateNitiMaster')->name('updateNitiMaster');

});

Route::controller(NoticeController::class)->group(function(){
    Route::get('admin/notice','notice');
    Route::post('admin/saveNotice', 'saveNotice')->name('saveNotice');
    Route::get('admin/manage-notice', 'manageNotice')->name('managenotice');
    Route::get('admin/edit-notice/{id}','editNotice')->name('edit.notice');
    Route::post('admin/update-notice/{id}','updateNotice')->name('update.notice');
    Route::get('admin/delete-notice/{id}',  'deleteNotice')->name('delete.notice');
});

Route::controller(ParkingController::class)->group(function(){
    Route::get('admin/parking','parking');
    Route::post('admin/saveParking', 'saveParking')->name('saveParking');
    Route::get('admin/manage-parking', 'manageParking')->name('manageparking');
    Route::get('admin/edit-parking/{id}', 'editParking')->name('edit.parking');
    Route::put('admin/update-parking/{id}',  'updateParking')->name('updateParking');
    Route::get('admin/delete-parking/{id}',  'deleteParking')->name('delete.parking');
});

Route::controller(YoutubeController::class)->group(function(){
    Route::get('admin/youtube','youtube');
    Route::post('admin/saveYoutubeUrl', 'saveYoutubeUrl')->name('saveYoutubeUrl');
    Route::get('admin/manage-youtube', 'manageYoutube')->name('manageYoutube');
    Route::get('admin/edit-youtube/{id}',  'editYouTube')->name('edityoutube');
    Route::post('admin/update-youtube/{id}',  'updateYouTube')->name('updateyoutube');
    Route::get('admin/delete-youtube/{id}',  'deleteYouTube')->name('deleteyoutube');
});

// Sebak information route
Route::controller(SebakController::class)->group(function(){
    Route::get('admin/manage-sebak','managesebak');
    Route::get('admin/add-sebak','addsebak');
    Route::post('admin/save-sebak', 'saveSebak')->name('saveSebak');
    Route::get('admin/delete-sebak/{sebak_id}', 'deletSebak')->name('deletSebak');
    Route::get('admin/edit-sebak/{sebak_id}','editSebak')->name('editSebak');
    Route::put('admin/update-sebak/{id}','update')->name('updateSebak');


    Route::get('admin/manage-seba','manageSeba')->name('manageSeba');
    Route::get('admin/add-seba','addSeba');
    Route::post('admin/save-seba', 'saveSeba')->name('saveSeba');
    Route::delete('admin/delete-seba/{id}', 'deleteSeba')->name('deleteSeba');
    Route::get('admin/edit-seba/{id}','editSeba')->name('editSeba');
    Route::put('admin/update-seba/{id}','updateSeba')->name('updateSeba');

    Route::get('admin/manage-sebayat','manageSebayat')->name('manageSebayat');
    Route::get('admin/add-sebayat','addSebayat');
    Route::post('admin/save-sebayat', 'saveSebayat')->name('saveSebayat');
    Route::delete('admin/delete-sebayat/{id}', 'deleteSebayat')->name('deleteSebayat');
    Route::get('admin/edit-sebayat/{id}','editSebayat')->name('editSebayat');
    Route::put('admin/update-sebayat/{id}','updateSebayat')->name('updateSebayat');
});
// Temple rituals route
Route::controller(TempleRitualController::class)->group(function(){
    Route::get('admin/manage-temple-niti','manageritual');
    Route::get('admin/add-temple-ritual','addritual');
    Route::post('admin/save-ritual', 'saveRitual')->name('saveRitual');
    Route::get('admin/delete-ritual/{ritual_id}', 'deletRitual')->name('deletRitual');
    Route::get('admin/edit-ritual/{id}','editRitual')->name('editRitual');
    Route::put('admin/update-ritual/{id}','update')->name('updateRitual');
});

Route::controller(DeityController::class)->group(function(){
    Route::get('admin/manage-deity','manageDeity')->name('manageDeity');
    Route::get('admin/add-deity','addDeity');
    Route::post('admin/save-deity', 'saveDeity')->name('saveDeity');
    Route::delete('admin/delete-deity/{id}', 'deletDeity')->name('deletDeity');
    Route::get('admin/edit-deity/{id}','editDeity')->name('editDeity');
    Route::put('admin/update-deity/{id}','updateDeity')->name('updateDeity');
});

// admin routes
Route::prefix('admin')->middleware(['auth', 'checkUserRole:admin'])->group(function () {
Route::get('/manage-event', [EventController::class, 'manageevent']);
Route::get('/add-event', [EventController::class, 'addevent'])->name('addevent');
Route::post('/saveEvent', [EventController::class, 'saveEvent'])->name('saveEvent');
Route::get('/view-event/{event_id}', [EventController::class, 'viewevent'])->name('viewevent');
Route::get('/delet-event/{event_id}', [EventController::class, 'updateStatus'])->name('deletevent');
Route::get('/edit-event/{event_id}', [EventController::class, 'editDate'])->name('editDate');
Route::put('/update-event/{event_id}', [EventController::class, 'update'])->name('updateEvent');

});

// user routes
Route::middleware(['auth', 'checkUserRole:user'])->group(function () {
  
    // Route::get('/user/dashboard', 'dashboard')->name('user.dashboard');
    // Route::get('/user/dashboard', [userController::class, 'dashboard']);
    Route::controller(userController::class)->group(function() {
        Route::get('/user/dashboard', 'dashboard')->name('user.dashboard');
        Route::get('/user/sebayatregister', 'sebayatregister')->name('user.sebayatregister');
    });
});
