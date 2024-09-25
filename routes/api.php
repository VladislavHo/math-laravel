<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Mail\User\SendMail;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentController;





Route::get("/users", [UserController::class, 'index']);
Route::post("/users", [UserController::class, 'create']);
Route::get("/appointments-userid", [UserController::class, 'getAppointmentsByUser']);


Route::put("/users/{id}/update", [AppointmentController::class, 'create']);
Route::post("/users/dates", [AppointmentController::class, 'storeDates']);
Route::get("/appointments", [AppointmentController::class, 'index']);



Route::post('/payment/create', [PaymentController::class, 'createPayment'])->name('payment.create');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/home', [PaymentController::class, 'home'])->name('payment.home');
Route::get('/payment/failure', [PaymentController::class, 'failure'])->name('payment.failure');
Route::post('/payment/check', [PaymentController::class, 'checkPayment'])->name('payment.check');

