<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', [App\Http\Controllers\AdminController::class, 'homepage']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // USER DASHBOARD
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware(\App\Http\Middleware\IsNormalUser::class);

    // ADMIN DASHBOARD
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index')->middleware(\App\Http\Middleware\IsAdmin::class);

    // ADMIN: register new users (admin-only)
    Route::get('/admin/register', [App\Http\Controllers\AdminController::class, 'showRegister'])
        ->name('admin.register')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::post('/admin/register', [App\Http\Controllers\AdminController::class, 'register'])
        ->name('admin.register.store')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    // LOGIN REDIRECT HANDLER
    Route::get('/home', [AdminController::class, 'index'])->name('home');
});
