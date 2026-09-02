<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Client
    Route::get('/client/dashboard', function () {
        return view('client.dashboard');
    })->middleware('role:client')->name('client.dashboard');

    // Dashboard Freelance
    Route::get('/freelance/dashboard', function () {
        return view('freelance.dashboard');
    })->middleware('role:freelance')->name('freelance.dashboard');

    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('role:admin')->name('admin.dashboard');

});

require __DIR__.'/auth.php';