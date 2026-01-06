<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminsecController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
<<<<<<< HEAD

// Public homepage (blogs visible)
Route::get('/', [AdminController::class, 'homepage'])->name('home.homepage');

// Public blog details page
Route::get('/post_details/{id}', [AdminController::class, 'post_details'])
    ->name('home.post_details');

// Login redirect handler
Route::get('/home', [AdminController::class, 'index'])->name('home');

Route::get('/create_post', [AdminController::class,'create_post'])->name('home.create_post');
Route::post('/user_post', [AdminController::class,'user_post'])->name('home.user_post');
=======
Route::get('/', [AdminController::class, 'homepage'])
    ->name('home.homepage');

Route::get('/postDetails/{id}', [AdminController::class, 'postDetails'])
    ->name('post.details');

>>>>>>> today-broken-backup
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

<<<<<<< HEAD
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
=======
    // Login redirect
    Route::get('/home', [AdminController::class, 'index'])->name('home');

    /*
    |--------------------------------------------------------------------------
    | USER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::get('/create_post', [AdminController::class, 'create_post'])
        ->name('create_post');

    Route::post('/create_post', [AdminController::class, 'store_post'])
        ->name('create_post.store');

    Route::get('/my_posts', [AdminController::class, 'my_posts'])
        ->name('user.my_posts');

    Route::delete('/user/delete_post/{id}', [AdminController::class, 'delete_post'])
        ->name('user.delete_post');

    Route::get('/user/edit_post/{id}', [AdminController::class, 'edit_post'])
        ->name('user.edit_post');

    Route::put('/user/update_post/{id}', [AdminController::class, 'update_post'])
        ->name('user.update_post');


    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::get('/add_post', [AdminsecController::class, 'add_post'])
        ->name('admin.add_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::post('/add_post', [AdminsecController::class, 'store'])
        ->name('admin.add_post.store')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::get('/show_post', [AdminsecController::class, 'show_post'])
        ->name('admin.show_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::delete('/delete_post/{id}', [AdminsecController::class, 'delete_post'])
        ->name('admin.delete_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    // ✅ ADD THESE
    Route::get('/edit_post/{id}', [AdminsecController::class, 'edit_post'])
        ->name('admin.edit_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::put('/edit_post/{id}', [AdminsecController::class, 'update_post'])
        ->name('admin.update_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    // APPROVE / REJECT
    Route::put('/admin/approve_post/{id}', [AdminsecController::class, 'approve_post'])
        ->name('admin.approve_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

    Route::put('/admin/reject_post/{id}', [AdminsecController::class, 'reject_post'])
        ->name('admin.reject_post')
        ->middleware(\App\Http\Middleware\IsAdmin::class);

>>>>>>> today-broken-backup
});
