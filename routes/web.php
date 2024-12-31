<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\PagesController;
use App\Http\Controllers\Backend\UserController;
use App\Models\Article;

//home
Route::get('/', function () {
    $articles = Article::with('creator:id,name')->get();
    return view('index', compact('articles'));
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
    Route::get("/user",[UserController::class,'user'])->name('user.index');
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

//users
Route::get("/dktacgia",[UserController::class,'dktacgia']);
Route::get("/dkdetai",[UserController::class,'dkdetai']);

