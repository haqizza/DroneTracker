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

Route::get('/', [AppController::class, 'dashboard'])->name('dashboard');
Route::get('/predict', [AppController::class, 'predict'])->name('predict');
Route::get('/predict/set-photo', [AppController::class, 'setPhoto'])->name('setPhoto');
