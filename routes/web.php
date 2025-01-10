<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\AdminController;
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
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/qluser',[AdminController::class,'qluser'])->name('admin.qluser');
    Route::get('/admin/qltacgia',[AdminController::class,'qltacgia'])->name('admin.qltacgia');
    Route::get('/admin/qlbaiviet',[AdminController::class,'qlbaiviet'])->name('admin.qlbaiviet');
    Route::get('/admin/qldetai',[AdminController::class,'qldetai'])->name('admin.qldetai');
    Route::get('/admin/qldanhmuc',[AdminController::class,'qldanhmuc'])->name('admin.qldanhmuc');
});

//user
Route::group(['middleware'=>'user'],function(){
    Route::get("/user",[UserController::class,'user'])->name('user.index');
});

//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Athuentication
Route::get("/login",[PagesController::class,'login']);
Route::post("/login",[AuthController::class,'xulylogin'])->name('login');

Route::get("/reg",[PagesController::class,'reg']);
Route::post("/reg",[AuthController::class,'xulyreg'])->name('reg');

//pages
Route::get("/sanpham",[PagesController::class,'sanpham']);
Route::get("/giaithuong",[PagesController::class,'giaithuong']);
Route::get("/detai",[PagesController::class,'detai']);
Route::get("/hoithao",[PagesController::class,'hoithao']);

//users
Route::get("/dktacgia",[UserController::class,'dktacgia']);
Route::get("/dkdetai",[UserController::class,'dkdetai']);

