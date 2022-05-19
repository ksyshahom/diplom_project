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

// [F][+] Главная страница.
Route::get('/', [MainController::class, 'index']);

// [F][+] Только НЕ авторизованные пользователи.
Route::middleware([isNotAuth::class])->group(function () {
    // [F][+] Авторизация и регистрация.
    Route::get('/auth', [AuthController::class, 'index']);
    Route::post('/auth/sign-up', [AuthController::class, 'signUp']);
    Route::post('/auth/login', [AuthController::class, 'login']);
});

// [][+] Только авторизованные пользователи.
Route::middleware([isAuth::class])->group(function () {
    // [+] Выход из личного кабинета.
    Route::get('/auth/logout', [AuthController::class, 'logout']);

    // [F][+] Главная страница личного кабинета.
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // [F][] Абитуриент.
    Route::middleware([isEnrollee::class])->group(function () {
        // [F][+] Абитуриент: Страница создания заявки.
        // [+] Отправленную заявку абитуриент сможет просмотреть здесь ([+] и статус, [+] и содержание).
        // [+] Повторная отправка заявки происходит также на этой странице.
        Route::get('/app', [AppController::class, 'index']);
        // [+] Абитуриент: Отправка заявки.
        Route::post('/app', [AppController::class, 'send']);
        // [+] Абитуриент: Может удалить свою заявку.
        Route::get('/app/delete', [AppController::class, 'delete']);

        // [F][+] Абитуриент: Список собеседований по каждой программе.
        Route::get('/interview', [InterviewController::class, 'index']);
        // [F][+] Абитуриент: Выбор даты собеседования. Если два одинаковых времени - первый преподаватель по алфавиту.
        // [+] Тут происходит выбор часового пояса.
        Route::get('/interview/{program}', [InterviewController::class, 'item']);
        // [+] Абитуриент: Запись на собеседование.
        Route::post('/interview/{program}', [InterviewController::class, 'signUp']);
        // [+] Абитуриент: Отменить запись на собеседование.
        Route::get('/interview/{program}/cancel', [InterviewController::class, 'cancel']);
    });

    // [F][+] Администратор.
    Route::middleware([isAdmin::class])->group(function () {
        // [F][+] Администратор: Страница редактирования ролей.
        Route::get('/roles', [RolesController::class, 'index']);
        Route::post('/roles', [RolesController::class, 'update']);

        // [F][+] Администратор: Редактирование страницы (пока только главной).
        Route::get('/pages/{page}', [PagesController::class, 'item']);
        Route::post('/pages/{page}', [PagesController::class, 'edit']);

        // [F][+] Администратор: Список абитуриентов и отчет по каждому. Единая большая таблица.
        // [+] Отсюда администратор может перейти на заявку абитуриента.
        Route::get('/report', [ReportController::class, 'index']);
    });

    // [][+] Сотрудник приемной комиссии.
    Route::middleware([isAdmissionOfficer::class])->group(function () {
        // [][+] Сотрудник приемной комиссии: Сможет просматривать заявки всех абитуриентов и переходить к ним.
        Route::get('/app/list', [AppController::class, 'appList']);
        // [+] Сотрудник приемной комиссии: Сможет редактировать заявки (POST).
        Route::post('/app/list', [AppController::class, 'edit']);
    });

    // [][+] Преподаватель.
    Route::middleware([isTeacher::class])->group(function () {
        // [][+] Преподаватель: Страница редактирования профиля: направления и контактные данные.
        Route::get('/profile', [ProfileController::class, 'index']);
        Route::post('/profile', [ProfileController::class, 'edit']);

        // [][+] Преподаватель: Страница с расписанием преподавателя. Список уже добавленных и занятых.
        // [+] На этой же страница форма ТОЛЬКО для добавления нового интервала.
        Route::get('/schedule', [ScheduleController::class, 'index']);
        // [+] Преподаватель: Добавление нового интервала.
        Route::post('/schedule', [ScheduleController::class, 'add']);
        // [][+] Преподаватель: Подробности собеседования.
        Route::get('/schedule/{schedule}', [ScheduleController::class, 'item']);
        // [+] Преподаватель: Редактирование собеседования.
        Route::post('/schedule/{schedule}', [ScheduleController::class, 'editItem']);
    });

    // [F][+] Все, кроме абитуриента.
    Route::middleware([isNotEnrollee::class])->group(function () {
        // [F][+] Просмотр заявки абитуриента. Доступен администратору, преподавателю и сотруднику примной комиссии.
        Route::get('/app/{application}', [AppController::class, 'item']);
    });
});
