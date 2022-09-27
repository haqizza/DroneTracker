<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\DroneController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\ReportController;
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

Route::get('/setting', [AppController::class, 'setting'])->name('setting');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/registerproccess', [UserController::class, 'registerproccess'])->name('register.proccess');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/loginproccess', [UserController::class, 'loginproccess'])->name('login.proccess');
Route::middleware('auth')->group(function () {
    Route::get('/', [AppController::class, 'dashboard'])->name('dashboard');
    Route::prefix('management')->group(function () {
        Route::prefix('drone')->group(function () {
            Route::get('/', [DroneController::class, 'index'])->name('management.drone');
            Route::get('/create', [DroneController::class, 'create'])->name('management.drone.create');
            Route::post('/store', [DroneController::class, 'store'])->name('management.drone.store');
        });
        Route::post('/legends/create', [AppController::class, 'legends'])->name('management.legends.create');
        Route::get('/legends/edit/{legend}', [AppController::class, 'editlegends'])->name('management.legends.edit');
        Route::post('/legends/update/{legend}', [AppController::class, 'updatelegends'])->name('management.legends.update');
        Route::post('/securities/create', [AppController::class, 'security'])->name('management.security.create');
        Route::get('/securities/edit/{security}', [AppController::class, 'editsecurities'])->name('management.security.edit');
        Route::post('/securities/update/{security}', [AppController::class, 'updatesecurities'])->name('management.security.update');
    });
    Route::prefix('report')->group(function () {
        Route::get('/drone', [ReportController::class, 'drone'])->name('report.drone');
    });
    Route::prefix('user')->group(function () {
        Route::get('/setting', [UserController::class, 'setting'])->name('user.setting');
        Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
    });
    Route::prefix('logs')->group(function () {
        Route::get('/user', [LogsController::class, 'user'])->name('logs.user');
    });
});
