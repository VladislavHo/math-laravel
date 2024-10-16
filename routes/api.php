<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\SendXlsxFileController;
// use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AnalyticsController;
// use App\Http\Controllers\

// use App\Http\Controllers\





Route::get("/users", [UserController::class, 'index']);
Route::post("/users", [UserController::class, 'create']);
Route::get("/appointments-userid", [UserController::class, 'getAppointmentsByUser']);


Route::put("/users/{id}/update", [AppointmentController::class, 'create']);


Route::post("/users/dates", [AppointmentController::class, 'storeDates']);
Route::get("/appointments", [AppointmentController::class, 'index']);


Route::post("/sendmessage", [TelegramController::class, 'sendMessageToUser']);
Route::post("/checktelegram", [TelegramController::class, 'checkTelegram']);


Route::post('/payment/create', [PaymentController::class, 'createPayment'])->name('payment.create');
Route::post('/payment/create-stripe', [PaymentController::class, 'createPaymentStripe'])->name('payment.createStripe');
Route::post('/payment/checked-stripe', [PaymentController::class, 'checkedPaymentStripe'])->name('payment.checkedStripe');

Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/successStripe', [PaymentController::class, 'successStripe'])->name('payment.successStripe');
Route::get('/payment/home', [PaymentController::class, 'home'])->name('payment.home');
Route::get('/payment/failure', [PaymentController::class, 'failure'])->name('payment.failure');
Route::post('/payment/check', [PaymentController::class, 'checkPayment'])->name('payment.check');




Route::get("/users/send_xlsx", [SendXlsxFileController::class, 'sendUsersXlsx']);



Route::post("/analytics/article", [AnalyticsController::class, 'checekArticle']);
Route::post("/analytics/questionnaire", [AnalyticsController::class, 'checekQuestionnaire']);
Route::post("/analytics/is_pay", [AnalyticsController::class, 'checekIsPay']);
Route::post("/analytics/calendar", [AnalyticsController::class, 'checekCalendar']);