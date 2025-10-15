<?php

use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\UserManagementController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::redirect('settings', '/settings/profile');

    Route::get('settings/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('settings/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('settings/password', [PasswordController::class, 'edit'])->name('password.edit');

    Route::put('settings/password', [PasswordController::class, 'update'])
        ->middleware('throttle:6,1')
        ->name('password.update');

    Route::get('settings/appearance', function () {
        return Inertia::render('settings/Appearance');
    })->name('appearance');
});


Route::middleware('auth')->prefix('settings/user-mgmt')->group(function () {
    Route::get('/', [UserManagementController::class, 'index'])->name('user-mgmt.index');
    Route::get('/allUsers', [UserManagementController::class, 'allUsers'])->name('user-mgmt.all-users');
    Route::patch('/resetPassword/{user}', [UserManagementController::class, 'resetPassword'])->name('user-mgmt.resetPassword');
    
});