<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\FreelanceMissionController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ClientApplicationController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Client
    Route::get('/client/dashboard', function () {
        return view('client.dashboard');
    })->middleware('role:client')->name('client.dashboard');
    // Missions Client
   Route::resource('/missions', MissionController::class)
    ->middleware('role:client');
    // Missions Freelance
Route::get('/freelance/missions', [FreelanceMissionController::class, 'index'])
    ->middleware('role:freelance')
    ->name('freelance.missions.index');
    
    Route::post('/freelance/missions/{mission}/apply', [ApplicationController::class, 'store'])
    
    ->name('freelance.missions.apply');
    // My Applications Freelance
Route::get('/freelance/applications',
    [ApplicationController::class, 'myApplications'])
    ->middleware('role:freelance')
    ->name('freelance.applications.index');

    Route::get('/client/applications', [ClientApplicationController::class, 'index'])
    ->middleware('role:client')
    ->name('client.applications.index');

    Route::post('/client/applications/{application}/accept', 
    [ClientApplicationController::class, 'accept'])
    ->middleware('role:client')
    ->name('client.applications.accept');

Route::post('/client/applications/{application}/reject', 
    [ClientApplicationController::class, 'reject'])
    ->middleware('role:client')
    ->name('client.applications.reject');

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