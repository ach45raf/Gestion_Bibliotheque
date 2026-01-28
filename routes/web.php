<?php

use Illuminate\Support\Facades\Route;

/* ===== AUTH CONTROLLER ===== */
use App\Http\Controllers\AuthController;

/* ===== PUBLIC CONTROLLERS ===== */
use App\Http\Controllers\LivreController;
use App\Http\Controllers\ReservationController;

/* ===== ADMIN CONTROLLERS ===== */
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLivreController;
use App\Http\Controllers\Admin\AdminCategorieController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\AdminUserController;

/* ===== USER CONTROLLERS ===== */
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserReservationController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])
    ->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
    ->name('password.email');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Public Routes (Visiteur)
|--------------------------------------------------------------------------
*/
Route::get('/', [LivreController::class, 'home'])->name('home');

Route::get('/livres', [LivreController::class, 'index'])->name('livres.index');
Route::get('/livres/{livre}', [LivreController::class, 'show'])->name('livres.show');

Route::view('/contact', 'contact')->name('contact');

/*
|--------------------------------------------------------------------------
| User Routes (middleware: user)
|--------------------------------------------------------------------------
*/
Route::prefix('user')
    ->middleware('user')
    ->group(function () {

        Route::get('/dashboard', [UserController::class, 'dashboard'])
            ->name('user.dashboard');

        Route::put('/profile', [UserController::class, 'updateProfile'])
            ->name('user.profile.update');

        Route::post('/reservations', [ReservationController::class, 'store'])
            ->name('user.reservations.store');

        Route::get('/reservations', [UserReservationController::class, 'index'])
            ->name('user.reservations.index');

        Route::delete('/reservations/{reservation}', [UserReservationController::class, 'destroy'])
            ->name('user.reservations.cancel');
    });

/*
|--------------------------------------------------------------------------
| Admin Routes (middleware: admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');

        Route::resource('livres', AdminLivreController::class)
            ->except(['show'])
            ->names('admin.livres');

        Route::resource('categories', AdminCategorieController::class)
            ->parameters(['categories' => 'categorie'])
            ->names('admin.categories');

        Route::resource('reservations', AdminReservationController::class)
            ->only(['index', 'update'])
            ->names('admin.reservations');

        Route::resource('users', AdminUserController::class)
            ->except(['create', 'store', 'show'])
            ->names('admin.users');
    });
