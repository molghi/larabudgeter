<?php

use App\Http\Controllers\EntryController;
use App\Http\Controllers\PlannerController;
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
Route::get('/users/logout', [UserController::class, 'logout'])->name('user.logout')->middleware('auth');

// Show user dashboard
Route::get('/dashboard', [UserController::class, 'show_dashboard'])->middleware('auth');


// Create entry
Route::post('/entries', [EntryController::class, 'store'])->name('entry.create')->middleware('auth');

// Delete entry
Route::delete('/entries/{id}', [EntryController::class, 'destroy'])->name('entry.delete')->middleware('auth');

// Edit entry (show form to edit)
Route::get('/dashboard/edit/{id}', [EntryController::class, 'edit'])->name('entry.edit')->middleware('auth');

// Edit entry (save edited)
Route::put('/entries/{id}', [EntryController::class, 'update'])->name('entry.update')->middleware('auth');

// Change observed period in dashboard
Route::get('/dashboard/period/{id}', [EntryController::class, 'show_period'])->middleware('auth');


// Edit planner entry
Route::get('/planner/edit/{id}', [PlannerController::class, 'edit'])->middleware('auth');

// Store new expense in Planner
Route::post('/planner/entries', [PlannerController::class, 'store'])->middleware('auth')->name('expense.create');

// Set user balance
Route::post('/user/balance', [UserController::class, 'set_balance'])->middleware('auth')->name('balance.set');

// Update entry
Route::put('/planner/edit/{id}', [PlannerController::class, 'update'])->name('expense.update')->middleware('auth');

// Delete entry
Route::get('/planner/delete/{id}', [PlannerController::class, 'destroy'])->middleware('auth');

// Add entry
Route::get('/planner/add', [PlannerController::class, 'create'])->middleware('auth');

// Route::get('/planner', [UserController::class, 'show_planner'])->middleware('auth');
Route::get('/planner', [PlannerController::class, 'index'])->middleware('auth');