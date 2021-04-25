<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Route::any('/user_register',[App\Http\Controllers\HomeController::class, 'user_register']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/booking',[App\Http\Controllers\HomeController::class, 'book'])->name('book');
Route::any('/booking-form/{id?}/{day?}/{action?}',[App\Http\Controllers\HomeController::class, 'booking_form']);
Route::get('/booking_admin',[App\Http\Controllers\HomeController::class, 'booking_admin'])->name('bookingAdmin');
Route::get('/users_admin',[App\Http\Controllers\HomeController::class, 'users_admin'])->name('usersAdmin');
Route::any('/booking_admin/delete/{id?}',[App\Http\Controllers\HomeController::class, 'booking_delete']);
Route::any('/booking_admin/edit/{id?}',[App\Http\Controllers\HomeController::class, 'booking_edit']);
Route::any('/users_admin/delete/{id?}',[App\Http\Controllers\HomeController::class, 'user_delete']);
