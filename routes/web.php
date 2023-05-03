<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Auth;
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

/*Route::get('/', function () {
    return view('index');
});*/

Auth::routes();
Route::get('/home', [IndexController::class, 'index']);
Route::get('/', [IndexController::class, 'index']);
Route::get('/agreement',  [IndexController::class, 'agreement'])->name('agreement');//соглашение
Route::get('/profile',  [IndexController::class, 'profile'])->name('profile');//лк
Route::get('/profileEdit',  [IndexController::class, 'profileEdit'])->name('profileEdit');//изменение данных
Route::post('/profileEditAction',  [IndexController::class, 'profileEditAction'])->name('profileEditAction');//кнопка изменения
Route::post('/cancelLesson',  [IndexController::class, 'cancelLesson'])->name('cancelLesson');//отмена записи в лк
Route::post('/reviewAction',  [IndexController::class, 'reviewAction'])->name('reviewAction');//отправка отзыва

Route::get('/adminIndex',  [AdminController::class, 'adminIndex'])->name('adminIndex');//админ панель
Route::get('/lessonAdd',  [AdminController::class, 'lessonAdd'])->name('lessonAdd');//добавить занятие
Route::post('/lessonAddAction',  [AdminController::class, 'lessonAddAction'])->name('lessonAddAction');//кнопка добавления
Route::get('/lessonTable',  [AdminController::class, 'lessonTable'])->name('lessonTable');//таблица занятий
Route::post('/lessonEditAction',  [AdminController::class, 'lessonEditAction'])->name('lessonEditAction');//кнопка изменения
Route::get('/lessonEdit/{id}',  [AdminController::class, 'lessonEdit'])->name('lessonEdit');//изменение занятий
Route::get('/lessonDelete/{id}',  [AdminController::class, 'lessonDelete'])->name('lessonDelete');//удаление занятий

Route::get('/coachTable',  [AdminController::class, 'coachTable'])->name('coachTable');//таблица тренеров
Route::get('/coachAdd',  [AdminController::class, 'coachAdd'])->name('coachAdd'); //добавление тренера
Route::post('/coachAddAction',  [AdminController::class, 'coachAddAction'])->name('coachAddAction'); //кнопка добавить тренера
Route::get('/coachEdit/{id}',  [AdminController::class, 'coachEdit'])->name('coachEdit');// форма изменения данных тренера
Route::post('/coachEditAction',  [AdminController::class, 'coachEditAction'])->name('coachEditAction');//изменить данные тренера
Route::get('/coachDelete/{id}',  [AdminController::class, 'coachDelete'])->name('coachDelete'); //удалить тренера
Route::get('/attendance/export',  [AdminController::class, 'export'])->name('export'); //ексель
Route::match(['get','post'],'/attendance',  [AdminController::class, 'attendance'])->name('attendance');//посещаемость
Route::match(['get','post'],'/ajax-check',  [AdminController::class, 'ajaxCheck'])->name('ajaxCheck');//присутсвие

Route::get('/schedule',  [ScheduleController::class, 'schedule'])->name('schedule');//расписание
Route::post('/ajax-form',  [ScheduleController::class, 'ajaxForm'])->name('ajaxForm');//запрос данных на формирование занятий
Route::post('/eventAction',  [ScheduleController::class, 'eventAction'])->name('eventAction');//записаться на занятие
Route::post('/scheduleAction',  [ScheduleController::class, 'scheduleAction'])->name('scheduleAction');//кнопка добавления расп
Route::get('/scheduleAdd',  [ScheduleController::class, 'scheduleAdd'])->name('scheduleAdd');//добавление расписания
Route::post('/ajaxChange',  [ScheduleController::class, 'scheduleChange'])->name('scheduleChange'); //перемещение занятия (админ)
Route::post('/ajaxDeleteSchedule',  [ScheduleController::class, 'ajaxDeleteSchedule'])->name('ajaxDeleteSchedule'); //удаление
Route::get('/setEmail',  [ScheduleController::class, 'setEmail'])->name('setEmail');//оправление сообщения
Route::get('/requestSent',  [ScheduleController::class, 'requestSent'])->name('requestSent');//запрос по пользователям
Route::get('/requestSentCoach',  [ScheduleController::class, 'requestSentCoach'])->name('requestSentCoach');//запрос по тренерам

Route::get('/chatTable',  [ChatController::class, 'chatTable'])->name('chatTable');//ответить пользователю (админ)
Route::match(['get','post'],'/chat',  [ChatController::class, 'chat'])->name('chat');//форма чата
Route::post('/chatAjax',  [ChatController::class, 'chatAjax'])->name('chatAjax');//отправка данных в чат

