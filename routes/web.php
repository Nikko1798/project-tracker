<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
     if (auth()->check()) {
        // User is logged in → redirect to dashboard
        return redirect()->route('dashboard');
    } else {
        // User is not logged in → redirect to login
        return redirect()->route('login');
    }
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
require __DIR__.'/PisApi.php';
