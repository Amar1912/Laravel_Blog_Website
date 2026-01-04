<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminsecController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Public homepage (blogs visible)
Route::get('/', [AdminController::class, 'homepage'])->name('home.homepage');

// Public blog details page
Route::get('/post_details/{id}', [AdminController::class, 'post_details'])
    ->name('home.post_details');

// Login redirect handler
Route::get('/home', [AdminController::class, 'index'])->name('home');

Route::get('/create_post', [AdminController::class,'create_post'])->name('home.create_post');
Route::post('/user_post', [AdminController::class,'user_post'])->name('home.user_post');
/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
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

    // ADMIN: register new users
    Route::get('/admin/register', [AdminController::class, 'showRegister'])
        ->name('admin.register')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::post('/admin/register', [AdminController::class, 'register'])
        ->name('admin.register.store')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    // ADMIN POSTS
    Route::get('/add_post', [AdminsecController::class,'add_post'])
        ->name('admin.add_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::post('/add_post', [AdminsecController::class,'store'])
        ->name('admin.add_post.store')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::get('/show_post', [AdminsecController::class,'show_post'])
        ->name('admin.show_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::delete('/delete_post/{id}', [AdminsecController::class,'delete_post'])
        ->name('admin.delete_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::get('/edit_post/{id}', [AdminsecController::class,'edit_post'])
        ->name('admin.edit_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::put('/edit_post/{id}', [AdminsecController::class,'update_post'])
        ->name('admin.update_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);
});
