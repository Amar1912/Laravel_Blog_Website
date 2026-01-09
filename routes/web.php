<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminsecController;

/*
|--------------------------------------------------------------------------
| PUBLIC / USER ROUTES
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [AdminController::class, 'homepage'])
    ->name('home.homepage');

// Post details
Route::get('/post_details/{id}', [AdminController::class, 'post_details'])
    ->name('home.post_details');

// Login redirect
Route::get('/home', [AdminController::class, 'index'])
    ->name('home');

// Create post (user)
Route::get('/create_post', [AdminController::class, 'create_post'])
    ->name('home.create_post');

// Store user post
Route::post('/user_post', [AdminController::class, 'user_post'])
    ->name('home.user_post');

// My posts
Route::get('/my_posts', [AdminController::class, 'my_posts'])
    ->name('home.my_posts');

// ✅ USER EDIT / UPDATE / DELETE (NO COLLISION)
Route::get('/user/edit_post/{id}', [AdminController::class, 'edit_post'])
    ->name('home.edit_post');

Route::post('/user/update_post/{id}', [AdminController::class, 'update_post'])
    ->name('home.update_post');

Route::delete('/user/delete_post/{id}', [AdminController::class, 'delete_post'])
    ->name('home.delete_post');


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

    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')
      ->middleware(\App\Http\Middleware\IsNormalUser::class);


    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index')
      ->middleware(\App\Http\Middleware\IsAdmin::class);

    /*
    |--------------------------------------------------------------------------
    | ADMIN USER REGISTER
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/register', [AdminController::class, 'showRegister'])
        ->name('admin.register')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::post('/admin/register', [AdminController::class, 'register'])
        ->name('admin.register.store')
        ->middleware(\App\Http\Middleware\IsAdmin::class);


    /*
    |--------------------------------------------------------------------------
    | ADMIN POSTS (ADMIN ONLY)
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/add_post', [AdminsecController::class, 'add_post'])
        ->name('admin.add_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::post('/admin/add_post', [AdminsecController::class, 'store'])
        ->name('admin.add_post.store')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::get('/admin/show_post', [AdminsecController::class, 'show_post'])
        ->name('admin.show_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::get('/admin/edit_post/{id}', [AdminsecController::class, 'edit_post'])
        ->name('admin.edit_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::put('/admin/edit_post/{id}', [AdminsecController::class, 'update_post'])
        ->name('admin.update_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::delete('/admin/delete_post/{id}', [AdminsecController::class, 'delete_post'])
        ->name('admin.delete_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::put('/admin/approve_post/{id}', [AdminsecController::class, 'approve_post'])
        ->name('admin.approve_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::put('/admin/reject_post/{id}', [AdminsecController::class, 'reject_post'])
        ->name('admin.reject_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);
});
