<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post("/users", [UserController::class, 'create']);

// Route::post('/users', function (Request $request) {
//   $data = $request->json()->all();

//   // Вывод данных в консоль
//   \Log::info('Полученные данные:', $data);

//   return response()->json(['message' => 'Данные успешно получены'], 200);


// });