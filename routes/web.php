<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Show auth forms
Route::get('/', [UserController::class, 'show_auth_forms'])->name('login');

// User action: sign up
Route::post('/users/signup', [UserController::class, 'signup'])->name('user.signup');

// User action: log in
Route::post('/users/login', [UserController::class, 'login'])->name('user.login');

// User action: log out
Route::get('/users/logout', [UserController::class, 'logout'])->name('user.logout');

// Show user dashboard
Route::get('/dashboard', [UserController::class, 'show_dashboard']);