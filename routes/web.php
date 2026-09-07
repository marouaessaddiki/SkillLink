<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\FreelanceMissionController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ClientApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Client
    Route::get('/client/dashboard', [DashboardController::class, 'client'])
        ->middleware('role:client')
        ->name('client.dashboard');

    // Missions Client
    Route::resource('/missions', MissionController::class)
        ->middleware('role:client');

    // Missions Freelance
    Route::get('/freelance/missions', [FreelanceMissionController::class, 'index'])
        ->middleware('role:freelance')
        ->name('freelance.missions.index');
Route::post('/freelance/missions/{mission}/apply', [ApplicationController::class, 'store'])
    ->middleware('role:freelance')
    ->name('freelance.missions.apply');

    // My Applications Freelance
    Route::get('/freelance/applications',
        [ApplicationController::class, 'myApplications'])
        ->middleware('role:freelance')
        ->name('freelance.applications.index');
        Route::post('/freelance/missions/{mission}/complete',
    [FreelanceMissionController::class, 'complete'])
    ->middleware('role:freelance')
    ->name('freelance.missions.complete');

    // Applications Client
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
        Route::post('/client/missions/{mission}/review',
    [ReviewController::class, 'store'])
    ->middleware('role:client')
    ->name('client.missions.review');
    Route::post('/freelance/missions/{mission}/review-client',
    [ReviewController::class, 'reviewClient'])
    ->middleware('role:freelance')
    ->name('freelance.missions.review-client');

    // Dashboard Freelance
    Route::get('/freelance/dashboard', [DashboardController::class, 'freelance'])
        ->middleware('role:freelance')
        ->name('freelance.dashboard');

    // Dashboard Admin
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
        ->middleware('role:admin')
        ->name('admin.dashboard');
});

require __DIR__.'/auth.php';