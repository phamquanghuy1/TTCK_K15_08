<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\PagesController;
use App\Http\Controllers\Backend\UserController;
use App\Models\Footer;


//home
Route::get('/', function () {
    $thanhViens = Footer::all();
    return view('index',compact('thanhViens'));
});

//admin
Route::group(['middleware'=>'admin'],function(){
    Route::get('/admin',function(){
        return view('admin.index');
    });
});

//user
Route::group(['middleware'=>'user'],function(){
    Route::get("/user",[UserController::class,'user'])->name('user.index');
});

//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
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

//users
Route::get("/dktacgia",[UserController::class,'dktacgia']);
Route::get("/dkdetai",[UserController::class,'dkdetai']);

