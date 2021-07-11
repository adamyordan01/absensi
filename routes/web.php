<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RankAndGroupController;
use App\Http\Controllers\SignaturePadController;
use App\Http\Controllers\UserController;

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

// Route::get('signaturepad', [SignaturePadController::class, 'index'])->name('signaturepad.index');
// Route::post('signaturepad-upload', [SignaturePadController::class, 'upload'])->name('signaturepad.upload');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->middleware('can:isPegawai')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('/rank-and-group', RankAndGroupController::class)->middleware('can:isAdmin');

    Route::resource('/division', DivisionController::class)->middleware('can:isAdmin');

    Route::get('/user/index', [UserController::class, 'index'])->middleware('can:isAdmin')->name('user.index');
    Route::delete('/user/delete/{user}', [UserController::class, 'destroy'])->middleware('can:isAdmin')->name('user.destroy');
    Route::patch('/user/{user}', [UserController::class, 'update'])->name('user.update');

    Route::get('/password', [PasswordController::class, 'edit'])->name('password');
    Route::patch('password-update', [PasswordController::class, 'update'])->name('password-update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile-update', [ProfileController::class, 'update'])->name('profile-update');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::get('/attendance-in', [AttendanceController::class, 'index'])->middleware('can:isPegawai')->name('attendance-in');
    Route::get('/attendance-out', [AttendanceController::class, 'attendanceOut'])->middleware('can:isPegawai')->name('attendance-out');

    Route::get('/attendance-report', [AttendanceController::class, 'attendanceReport'])->middleware('can:isPegawai')->name('attendance-report');
    Route::get('/attendance-report/pdf/{daterange}', [AttendanceController::class, 'attendanceReportPdf'])->middleware('can:isPegawai')->name('attendance-report-pdf');
    Route::get('/attendance-report-user/print/{daterange}', [AttendanceController::class, 'attendanceUserPrint'])->middleware('can:isPegawai')->name('attendance-user-print');

    Route::get('/attendance-report-admin', [AttendanceController::class, 'attendanceReportAdmin'])->name('attendance-report-admin');
    Route::get('/attendance-report-admin/pdf/{daterange}', [AttendanceController::class, 'attendanceReportAdminPdf'])->name('attendance-report-admin-pdf');
    Route::get('/attendance-report-admin/print/{daterange}', [AttendanceController::class, 'attendancePrint'])->name('attendance-print');

    Route::post('/attendance-in', [AttendanceController::class, 'store'])->middleware('can:isPegawai')->name('attendance-in-store');
    Route::post('/attendance-out', [AttendanceController::class, 'updateAttendanceOut'])->middleware('can:isPegawai')->name('attendance-out-store');

    Route::get('/annotation', [AttendanceController::class, 'annotation'])->name('annotation');
    Route::get('/annotation/create', [AttendanceController::class, 'annotationCreate'])->name('annotation.create');
    Route::post('/annotation/store', [AttendanceController::class, 'annotationStore'])->name('annotation.store');

    // Kepala Kantor
    Route::get('/leave', [LeaveController::class, 'index'])->name('leave.index');
    Route::any('/leave/{leave}', [LeaveController::class, 'update'])->name('leave.update');

    // Jabatan 01072021
    Route::get('/position', [PositionController::class, 'index'])->name('position.index');
    Route::post('/position/store', [PositionController::class, 'store'])->name('position.store');
    Route::patch('/position/{position}', [PositionController::class, 'update'])->name('position.update');
    Route::delete('/position/delete/{position}', [PositionController::class, 'destroy'])->name('position.destroy');
    
});