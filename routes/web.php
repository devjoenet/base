<?php

declare(strict_types=1);

use App\Http\Controllers\CurrentTeamController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\TwoFactorAuthenticationController;
use App\Http\Controllers\TeamController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Team Management
    Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
    Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
    Route::put('/current-team', [CurrentTeamController::class, 'update'])->name('current-team.update');

    Route::redirect('/settings', '/settings/profile');

    Route::prefix('settings')->group(function () {
        Route::get('profile', [ProfileController::class, 'edit'])->name('settings.profile');
        Route::patch('profile', [ProfileController::class, 'update'])->name('settings.profile.update');
        Route::delete('profile', [ProfileController::class, 'destroy'])->name('settings.profile.destroy');

        Route::get('password', [PasswordController::class, 'edit'])->name('settings.password');
        Route::put('password', [PasswordController::class, 'update'])->name('settings.password.update');

        Route::get('appearance', function () {
            return Inertia::render('settings/Appearance');
        })->name('settings.appearance');

        Route::get('two-factor', [TwoFactorAuthenticationController::class, 'edit'])->name('settings.two-factor');
        Route::post('two-factor', [TwoFactorAuthenticationController::class, 'store'])->name('settings.two-factor.store');
        Route::delete('two-factor', [TwoFactorAuthenticationController::class, 'destroy'])->name('settings.two-factor.destroy');
    });
});

require __DIR__.'/settings.php';
