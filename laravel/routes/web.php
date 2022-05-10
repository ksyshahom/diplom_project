<?php

use Illuminate\Support\Facades\Route;
//
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\InterviewController;

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

Route::get('/', [MainController::class, 'index']);

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/sign-up', [AuthController::class, 'signUp']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/app', [AppController::class, 'index']);
Route::post('/app', [AppController::class, 'send']);

Route::get('/interview', [InterviewController::class, 'index']);
Route::get('/interview/{program}', [InterviewController::class, 'program']);
Route::post('/interview/{program}', [InterviewController::class, 'signUp']);
