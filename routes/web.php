<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;

Route::get('/', function () {
    return view('index');
});
Route::get("/login",[AuthController::class,'login']);
Route::get("/reg",[AuthController::class,'reg']);
