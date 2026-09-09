<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\FreelanceMissionController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ClientApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminMissionController;
use App\Http\Controllers\AdminCategoryController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

   Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->hasRole('freelance')) {
        return redirect()->route('freelance.dashboard');
    }

    return redirect()->route('client.dashboard');
})->name('dashboard');

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

    Route::get('/admin/users', [AdminUserController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.users.index');
    Route::get('/admin/missions', [AdminMissionController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.missions.index');
    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.users.destroy');
    Route::get('/admin/categories', [AdminCategoryController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.categories.index');
    Route::get('/admin/categories/create', [AdminCategoryController::class, 'create'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.categories.create');

Route::post('/admin/categories', [AdminCategoryController::class, 'store'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.categories.store');
    Route::get('/admin/categories/{category}/edit', [AdminCategoryController::class, 'edit'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.categories.edit');

Route::put('/admin/categories/{category}', [AdminCategoryController::class, 'update'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.categories.update');

Route::delete('/admin/categories/{category}', [AdminCategoryController::class, 'destroy'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.categories.destroy');

    // Dashboard Freelance
    Route::get('/freelance/dashboard', [DashboardController::class, 'freelance'])
        ->middleware('role:freelance')
        ->name('freelance.dashboard');

    // Dashboard Admin
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
        ->middleware('role:admin')
        ->name('admin.dashboard');
});

Route::post('/notifications/{notification}/read', function ($notification) {
    $notification = auth()->user()->notifications()
        ->where('id', $notification)
        ->firstOrFail();

    $notification->markAsRead();

    return back();
})->middleware('auth')->name('notifications.read');
require __DIR__.'/auth.php';