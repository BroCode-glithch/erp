<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CareSupportController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\ProgramManagerController;
use App\Http\Controllers\Admin\NotificationController;

// Home and Dashboard
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Profile Routes
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');

    // Roles
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);

    // Users
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    // Departments
    Route::resource('departments', \App\Http\Controllers\Admin\DepartmentController::class);

    // Programs
    Route::resource('programs', \App\Http\Controllers\Admin\ProgramController::class);

    // Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'store'])->name('settings.store');

    // Reports
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
});


Route::middleware('auth')->group(function () {
    Route::get('2fa/setup', [TwoFactorController::class, 'show2FASetup'])->name('2fa.setup');
    Route::post('2fa/verify', [TwoFactorController::class, 'verify2FA'])->name('verify2fa');
});


Route::middleware(['auth', 'role:program-manager'])->prefix('pm')->name('pm.')->group(function () {
    Route::get('/dashboard', [ProgramManagerController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:care-support'])->prefix('care')->name('care.')->group(function () {
    Route::get('/dashboard', [CareSupportController::class, 'index'])->name('dashboard');
});


// routes/web.php
Route::post('/notifications/read', [NotificationController::class, 'markAllAsRead'])->name('admin.notifications.read');
// routes/web.php
Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');




Route::get('/test-alert', function () {
    \RealRashid\SweetAlert\Facades\Alert::success('Welcome!', 'SweetAlert is working!');
    return view('welcome');
});


require __DIR__.'/auth.php';
