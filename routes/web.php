<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\PagesController;

//home
Route::get('/', function () {
    return view('index');
});

//admin
Route::group(['middleware'=>'admin'],function(){
    Route::get('/admin',function(){
        return view('admin.index');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

//user
Route::group(['middleware'=>'user'],function(){
    Route::get('/user',function(){
        return view('user.index');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

//Athuentication
Route::get("/login",[PagesController::class,'login']);
Route::post("/login",[AuthController::class,'xulylogin']);

Route::get("/reg",[PagesController::class,'reg']);
Route::post("/reg",[AuthController::class,'xulyreg']);

//pages
Route::get("/sanpham",[PagesController::class,'sanpham']);
Route::get("/giaithuong",[PagesController::class,'giaithuong']);
Route::get("/detai",[PagesController::class,'detai']);
Route::get("/hoithao",[PagesController::class,'hoithao']);
Route::get("/dktacgia",[PagesController::class,'dktacgia']);
Route::get("/dkdetai",[PagesController::class,'dkdetai']);

