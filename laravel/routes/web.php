<?php

use Illuminate\Support\Facades\Route;

//
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Middleware\isAuth;
use App\Http\Middleware\isNotAuth;
use App\Http\Middleware\isEnrollee;
use App\Http\Middleware\isNotEnrollee;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isAdmissionOfficer;
use App\Http\Middleware\isTeacher;

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

Route::middleware([isNotAuth::class])->group(function () {
    Route::get('/auth', [AuthController::class, 'index']);
    Route::post('/auth/sign-up', [AuthController::class, 'signUp']);
    Route::post('/auth/login', [AuthController::class, 'login']);
});

Route::middleware([isAuth::class])->group(function () {
    Route::get('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::middleware([isEnrollee::class])->group(function () {
        // Абитуриент: Страница создания заявки. Отправленную заявку абитуриент сможет просмотреть здесь (и статус, и содержание).
        Route::get('/app', [AppController::class, 'index']);
        // Абитуриент: Отправка заявки.
        Route::post('/app', [AppController::class, 'send']);
        // Абитуриент: Может удалить свою заявку.
        Route::get('/app/delete', [AppController::class, 'delete']);

        // Абитуриент: Список собеседований по каждой программе.
        Route::get('/interview', [InterviewController::class, 'index']);
        // Абитуриент: Выбор даты собеседования. Если два одинаковых времени - первый преподаватель по алфавиту.
        Route::get('/interview/{program}', [InterviewController::class, 'item']);
        // Абитуриент: Запись на собеседование.
        Route::post('/interview/{program}', [InterviewController::class, 'signUp']);
    });

    Route::middleware([isNotEnrollee::class])->group(function () {
        // Просмотр заявки абитуриента. Доступен администратору, преподавателю и сотруднику примной комиссии.
        Route::get('/app/{application}', [AppController::class, 'item']);
    });

    Route::middleware([isAdmin::class])->group(function () {
        // Администратор: Страница редактирования ролей.
        Route::get('/roles', [RolesController::class, 'index']);
        Route::post('/roles', [RolesController::class, 'update']);

        // Администратор: Список абитуриентов и отчет по каждому. Единая большая таблица.
        // Отсюда администратор может перейти на заявку абитуриента.
        Route::get('/report', [ReportController::class, 'index']);

        // Администратор: Редактирование страницы (пока только главной).
        Route::get('/pages/{page}', [PagesController::class, 'item']);
        Route::post('/pages/{page}', [PagesController::class, 'edit']);
    });


    Route::middleware([isAdmissionOfficer::class])->group(function () {
        // Сотрудник приемной комиссии: Сможет просматривать все заявки абитуриентов и переходить к ним.
        Route::post('/app/list', [AppController::class, 'list']);
        // Сотрудник приемной комиссии: Сможет проверять.
        Route::post('/app/{application}', [AppController::class, 'edit']);
    });

    Route::middleware([isTeacher::class])->group(function () {
        // Преподаватель: Страница редактирования профиля: направления и контактные данные.
        Route::get('/profile', [ProfileController::class, 'index']);
        Route::post('/profile', [ProfileController::class, 'edit']);

        // Преподаватель: Страница с расписанием преподавателя. Список уже добавленных и занятых.
        // На этой же страница форма ТОЛЬКО для добавления нового интервала.
        Route::get('/schedule', [ScheduleController::class, 'index']);
        // Преподаватель: Добавление нового интервала.
        Route::post('/schedule', [ScheduleController::class, 'edit']);
        // Преподаватель: Подробности собеседования.
        Route::get('/schedule/{schedule}', [ScheduleController::class, 'item']);
        // Преподаватель: Редактирование собеседования.
        Route::post('/schedule/{schedule}', [ScheduleController::class, 'editItem']);
    });
});
