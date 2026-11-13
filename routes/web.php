<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeddingSettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Wedding Invitation Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [InvitationController::class, 'preview'])->name('home');
Route::get('/preview', [InvitationController::class, 'preview'])->name('invitation.preview');
Route::get('/invite/{slug}', [InvitationController::class, 'show'])->name('invitation.show');
Route::post('/invite/{slug}/rsvp', [InvitationController::class, 'rsvp'])->name('invitation.rsvp');
Route::post('/invite/{slug}/wish', [InvitationController::class, 'wish'])->name('invitation.wish');

/*
|--------------------------------------------------------------------------
| Authenticated Admin Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Guest Management
    Route::get('/guests', [GuestController::class, 'index'])->name('guests.index');
    Route::post('/guests', [GuestController::class, 'store'])->name('guests.store');
    Route::post('/guests/bulk', [GuestController::class, 'bulkStore'])->name('guests.bulk');
    Route::put('/guests/{guest}', [GuestController::class, 'update'])->name('guests.update');
    Route::delete('/guests/{guest}', [GuestController::class, 'destroy'])->name('guests.destroy');

    // Wedding Settings
    Route::get('/settings', [WeddingSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [WeddingSettingController::class, 'update'])->name('settings.update');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
