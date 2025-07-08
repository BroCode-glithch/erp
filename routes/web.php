<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\CareSupportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramManagerController;
use Illuminate\Support\Facades\Route;



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

    // Users
    Route::resource('users', UserController::class);

    // Departments
    Route::resource('departments', DepartmentController::class);

    // Programs
    Route::resource('programs', ProgramController::class);

    // routes/web.php
    Route::post('/notifications/read', [NotificationController::class, 'markAllAsRead'])->name('notifications.read');

    // 2FA toggle for users
    Route::post('/users/{user}/toggle-2fa', [SettingController::class, 'toggle2FA'])->name('users.toggle2fa');


    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

    // routes/web.php
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');


Route::middleware('auth')->group(function () {
    Route::get('2fa/setup', [TwoFactorController::class, 'show2FASetup'])->name('2fa.setup');
    Route::post('2fa/verify', [TwoFactorController::class, 'verify2FA'])->name('verify2fa');
});

// 2FA Verification (after login)
Route::get('2fa/verify', function () {
    return view('auth.2fa-verify'); // Make sure this view exists
})->middleware('auth')->name('2fa.verify');

Route::post('2fa/verify', [TwoFactorController::class, 'verify2FACode'])->middleware('auth')->name('2fa.verify.code');



Route::middleware(['auth', '2fa', 'role:program-manager'])->prefix('pm')->name('pm.')->group(function () {
    Route::get('/dashboard', [ProgramManagerController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', '2fa', 'role:care-support'])->prefix('care')->name('care.')->group(function () {
    Route::get('/dashboard', [CareSupportController::class, 'index'])->name('dashboard');
});





Route::get('/test-alert', function () {
    \RealRashid\SweetAlert\Facades\Alert::success('Welcome!', 'SweetAlert is working!');
    return view('welcome');
});


require __DIR__.'/auth.php';
