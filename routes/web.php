<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CareSupportController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\ProgramManagerController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PermissionController;
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

Route::middleware(['auth', '2fa', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');

    // Roles
    Route::resource('roles', RoleController::class);

    // Permissions
    Route::resource('permissions', PermissionController::class)->except(['show']);

    // Users
    Route::resource('users', UserController::class);

    // Departments
    Route::resource('departments', DepartmentController::class);

    // Programs
    Route::resource('programs', ProgramController::class);

    Route::post('/notifications/read', [NotificationController::class, 'markAllAsRead'])->name('notifications.read');

    Route::post('/users/{user}/toggle-2fa', [SettingController::class, 'toggle2FA'])->name('users.toggle2fa');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});


    // routes/web.php
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');


// 2FA Setup and Verification Routes
Route::middleware('auth')->group(function () {
    // Show the 2FA setup form
    Route::get('/2fa/setup', [TwoFactorController::class, 'show2FASetup'])->name('2fa.setup');

    // Submit the code to verify and enable 2FA
    Route::post('/2fa/verify', [TwoFactorController::class, 'verify2FACode'])->name('2fa.verify.code');

    // Show the 2FA prompt view (after login if 2FA is required)
    Route::get('/2fa/verify', function () {
        return view('auth.2fa-verify');
    })->name('2fa.verify');
});





Route::get('/test-alert', function () {
    \RealRashid\SweetAlert\Facades\Alert::success('Welcome!', 'SweetAlert is working!');
    return view('welcome');
});


require __DIR__.'/auth.php';
