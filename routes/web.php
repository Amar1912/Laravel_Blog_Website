<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminsecController; // Corrected namespace casing and imported AdminsecController

// Public homepage route (named 'home.homepage').
// We use this route as the post-login landing page for ALL authenticated users (admins and normal users).
// This ensures consistent UX: after login the user sees the public homepage and the header shows a Logout button
// while hiding the Login/Register links.
Route::get('/', [App\Http\Controllers\AdminController::class, 'homepage'])->name('home.homepage');


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

    // Admin-only: Add Post page
    // Use the real controller (AdminsecController) and protect with the IsAdmin middleware
    Route::get('/add_post', [AdminsecController::class,'add_post'])
        ->name('admin.add_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    // Admin-only: store new post (handles POST from Add Post form)
    Route::post('/add_post', [AdminsecController::class,'store'])
        ->name('admin.add_post.store')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

        Route::get('/show_post', [AdminsecController::class,'show_post'])->name('admin.show_post')->middleware(\App\Http\Middleware\IsAdmin::class);    
});
