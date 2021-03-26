<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AttendanceController;

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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->middleware('can:isPegawai')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('can:isPegawai,isAdmin')->name('home');
    
    Route::get('/attendance-in', [AttendanceController::class, 'index'])->middleware('can:isPegawai')->name('attendance-in');

    Route::post('/attendance-in', [AttendanceController::class, 'store'])->middleware('can:isPegawai')->name('attendance-in-store');
});