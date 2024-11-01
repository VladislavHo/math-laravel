<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TelegramController;

use App\Http\Controllers\AnalyticsController;






Route::get("/users", [UserController::class, 'index']);
Route::post("/user", [UserController::class, 'create']);
Route::put("/user/{id}/update", [UserController::class, 'update']);


Route::put("/user/{id}/update/appointment", [AppointmentController::class, 'create']);


Route::get("/appointments-userid", [UserController::class, 'getAppointmentsByUser']);




Route::post("/users/dates", [AppointmentController::class, 'storeDates']);
Route::get("/appointments", [AppointmentController::class, 'index']);


Route::post("/sendmessage", [TelegramController::class, 'sendMessageToUser']);
Route::post("/checktelegram", [TelegramController::class, 'checkTelegram']);

Route::post("/analytics/questionnaire", [AnalyticsController::class, 'checekQuestionnaire']);
Route::post("/analytics/is_pay", [AnalyticsController::class, 'checekIsPay']);
Route::post("/analytics/calendar", [AnalyticsController::class, 'checekCalendar']);