<?php

use App\Models\Programs;
use App\Models\Departments;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Pm\PMDepartmentController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\AdminDashboardController;



// Home and Dashboard
Route::get('/', function () {
    return view('welcome');
});

// Features
Route::get('/features', function () {
    return view('features');
})->name('features');

Route::get('/policy', function () {
    $policy = file_get_contents(resource_path('markdown/policy.md'));
    $policy = Str::markdown($policy); // Convert markdown to HTML
    return view('policy', compact('policy'));
})->name('policy');

Route::get('/terms', function () {
    $terms = file_get_contents(resource_path('markdown/terms.md'));
    $terms = Str::markdown($terms); // Convert markdown to HTML
    return view('terms', compact('terms'));
})->name('terms');


Route::get('/dashboard', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect('/login');
    }

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('program-manager')) {
        return redirect()->route('pm.dashboard');
    } elseif ($user->hasRole('support')) {
        return redirect()->route('care.dashboard');
    }

    // Fallback (optional)
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', '2fa', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Roles
    Route::resource('roles', RoleController::class);
    Route::get('/roles/export/pdf', [RoleController::class, 'exportPDF'])->name('roles.export.pdf');

    // Permissions
    Route::resource('permissions', PermissionController::class)->except(['show']);
    Route::get('/permissions/export/pdf', [PermissionController::class, 'exportPDF'])->name('permissions.export.pdf');

    // Users
    Route::resource('users', UserController::class);
    Route::get('/users/export/pdf', [UserController::class, 'exportPDF'])->name('users.export.pdf');

    // Departments
    Route::resource('departments', DepartmentController::class);
    Route::get('/departments/export/pdf', [DepartmentController::class, 'exportPDF'])->name('departments.export.pdf');

    // Programs
    Route::resource('programs', ProgramController::class);
    Route::get('/programs/export/pdf', [ProgramController::class, 'exportPDF'])->name('programs.export.pdf');

    Route::post('/notifications/read', [NotificationController::class, 'markAllAsRead'])->name('notifications.read');

    Route::post('/users/{user}/toggle-2fa', [SettingsController::class, 'toggle2FA'])->name('users.toggle2fa');


    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/settings/general', action: [SettingsController::class, 'general'])->name('settings.general');
    Route::put('/settings/general', [SettingsController::class, 'updateGeneral'])->name('settings.general.update');
    Route::post('/settings', [SettingsController::class, 'store'])->name('settings.store');
    Route::get('/settings/appearance', [SettingsController::class, 'appearance'])->name('settings.appearance');
    Route::put('/settings/appearance', [SettingsController::class, 'updateAppearance'])->name('settings.appearance.update');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

Route::middleware(['auth', '2fa', 'role:program-manager'])->prefix('pm')->name('pm.')->group(function () {
    Route::get('/dashboard', fn () => view('pm.dashboard'))->name('dashboard');

    // Programs
    Route::resource('programs', ProgramController::class);

    // Departments
    Route::resource('departments', controller: PMDepartmentController::class);

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});


Route::middleware(['auth', '2fa', 'role:support'])->prefix('care')->name('care.')->group(function () {
    Route::get('/dashboard', fn () => view('care.dashboard'))->name('dashboard');
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
    Alert::success('Welcome!', 'SweetAlert is working!');
    return view('welcome');
});


require __DIR__.'/auth.php';
