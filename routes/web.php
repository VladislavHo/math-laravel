<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });


// Route::get('/privacy-policy', function () {
//     return view('index');
// });

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');


