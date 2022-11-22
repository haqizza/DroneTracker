<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\DroneController;
use App\Http\Controllers\LegendController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
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

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/registerproccess', [UserController::class, 'registerproccess'])->name('register.proccess');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/loginproccess', [UserController::class, 'loginproccess'])->name('login.proccess');
Route::get('/setcookie', [AppController::class, 'setcookie']);
Route::get('/getcookie', [UserController::class, 'cookiecheck']);
Route::middleware('auth')->group(function () {
    Route::get('/', [AppController::class, 'dashboard'])->name('dashboard');
    Route::get('/flightcode', [AppController::class, 'flightcode'])->name('dashboard.flightcode');
    Route::prefix('setting')->group(function () {
        Route::get('/', [AppController::class, 'setting'])->name('setting');
        Route::post('/update', [AppController::class, 'update'])->name('setting.update');
    });
    Route::prefix('management')->group(function () {
        Route::prefix('drones')->group(function () {
            Route::get('/', [DroneController::class, 'index'])->name('management.drone');
            Route::post('/store', [DroneController::class, 'store'])->name('management.drone.store');
            Route::get('/edit/{drone}', [DroneController::class, 'edit'])->name('management.drone.edit');
            Route::post('/update/{drone}', [DroneController::class, 'update'])->name('management.drone.update');
            Route::get('/show/{drone}', [DroneController::class, 'show'])->name('management.drone.show');
            Route::get('/delete/{drone}', [DroneController::class, 'destroy'])->name('management.drone.destroy');
        });
        Route::prefix('users')->group(function () {
            Route::get('/', [UserManagementController::class, 'index'])->name('management.user');
            Route::post('/store', [UserManagementController::class, 'store'])->name('management.user.store');
            Route::get('/edit/{user}', [UserManagementController::class, 'edit'])->name('management.user.edit');
            Route::post('/update/{user}', [UserManagementController::class, 'update'])->name('management.user.update');
            Route::get('/delete/{user}', [UserManagementController::class, 'destroy'])->name('management.user.destroy');
        });
        Route::prefix('/securities')->group(function () {
            Route::get('/', [SecurityController::class, 'index'])->name('management.security');
            Route::post('/store', [SecurityController::class, 'store'])->name('management.security.store');
            Route::get('/edit/{security}', [SecurityController::class, 'edit'])->name('management.security.edit');
            Route::post('/update/{security}', [SecurityController::class, 'update'])->name('management.security.update');
            Route::get('/delete/{security}', [SecurityController::class, 'destroy'])->name('management.security.destroy');
        });
        Route::prefix('/legends')->group(function () {
            Route::get('/', [LegendController::class, 'index'])->name('management.legend');
            Route::post('/store', [LegendController::class, 'store'])->name('management.legend.store');
            Route::get('/edit/{legend}', [LegendController::class, 'edit'])->name('management.legend.edit');
            Route::post('/update/{legend}', [LegendController::class, 'update'])->name('management.legend.update');
            Route::get('/delete/{legend}', [LegendController::class, 'destroy'])->name('management.legend.destroy');
        });
    });
    Route::prefix('report')->group(function () {
        Route::get('/drone', [ReportController::class, 'drone'])->name('report.drone');
    });
    Route::prefix('user')->group(function () {
        Route::get('/setting', [UserController::class, 'setting'])->name('user.setting');
        Route::get('/edit', [UserController::class, 'meEdit'])->name('user.edit');
        Route::post('/update', [UserController::class, 'meUpdate'])->name('user.update');
        Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
    });
    Route::prefix('logs')->group(function () {
        Route::get('/user', [LogsController::class, 'user'])->name('logs.user');
        Route::prefix('drone')->group(function () {
            Route::get('/', [LogsController::class, 'drone'])->name('logs.drone');
            Route::get('/{drone}', [LogsController::class, 'alldrone']);
            Route::get('/flight/{drone}/{code}', [LogsController::class, 'fcode']);
        });
        Route::get('/security', [LogsController::class, 'security'])->name('logs.security');
    });
});
