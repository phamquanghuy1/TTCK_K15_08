<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;

Route::get('/', function () {
    return view('index');
});

Route::group(['middleware'=>'admin'],function(){
    Route::get('/admin',function(){
        return view('admin.index');
    });
});

Route::group(['middleware'=>'user'],function(){
    Route::get('/user',function(){
        return view('user.index');
    });
});

Route::get("/login",[AuthController::class,'login']);
Route::post("/login",[AuthController::class,'xulylogin']);

Route::get("/reg",[AuthController::class,'reg']);
