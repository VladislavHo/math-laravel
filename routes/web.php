<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;


Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');

