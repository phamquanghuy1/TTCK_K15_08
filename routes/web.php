<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    return view('index');
});
Route::get("/login",function(){
    return view('auth/login');
});
Route::get("/reg",function(){
    return view('auth/reg');
});

