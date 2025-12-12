<?php

declare(strict_types=1);

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

    // User Management Routes (Protected by permission)
    Route::group(['middleware' => ['can:manage users']], function () {
        Route::resource('users', UserController::class);
    });

    Route::group(['middleware' => ['can:manage roles']], function () {
        Route::resource('roles', RoleController::class);
    });
});

require __DIR__.'/settings.php';
