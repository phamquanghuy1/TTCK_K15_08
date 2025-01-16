<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\backend\ArticleController;
use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\PagesController;
use App\Http\Controllers\Backend\TopicController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\TopicCategoryController;
use App\Models\Footer;
use App\Models\DanhMuc;

//home
Route::get('/', function () {
    $categories = DanhMuc::all();
    $thanhViens = Footer::all();
    return view('index', compact('thanhViens', 'categories'));
});

//admin
Route::group(['middleware' => 'admin'], function () {
    //dashoard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/qluser', [AdminController::class, 'qluser'])->name('admin.qluser');

    //ql tac gia
    Route::get('/admin/qltacgia', [AuthorController::class, 'qltacgia'])->name('admin.qltacgia');
    Route::post('/admin/updateAuthor', [AuthorController::class, 'updateStatus'])->name('update_tac_gia');
    Route::post('/admin/addAuthor', [AuthorController::class, 'addAuthor'])->name('add_tac_gia');
    Route::post('/admin/deleteAuthor', [AuthorController::class, 'deleteAuthor'])->name('delete_tac_gia');

    //ql bai viet
    Route::get('/admin/qlbaiviet', [ArticleController::class, 'qlbaiviet'])->name('admin.qlbaiviet');
    Route::get('/api/search-authors', [ArticleController::class, 'searchAuthors']);
    Route::get('/api/search-topics', [ArticleController::class, 'searchTopics']);
    Route::post('/admin/addArticle', [ArticleController::class, 'addArticle'])->name('add_bai_viet');
    Route::post('/update-article-status', [ArticleController::class, 'updateStatus'])->name('update_article_status');    Route::post('/admin/delete-article/{id}', [ArticleController::class, 'destroy'])->name('delete_article');
    Route::get('/admin/articles/{id}', [ArticleController::class, 'getArticle'])->name('get_article');
    Route::post('/admin/articles/update', [ArticleController::class, 'updateArticle'])->name('update_article');

    //ql de tai
    Route::get('/admin/qldetai', [TopicController::class, 'index'])->name('admin.qldetai');
    Route::get('/admin/qldetai', [TopicController::class, 'index'])->name('admin.qldetai');
    Route::get('/admin/topics/{id}', [TopicController::class, 'getTopic'])->name('get_topic');
    Route::post('/admin/topics/add', [TopicController::class, 'addTopic'])->name('add_topic');
    Route::post('/admin/topics/update', [TopicController::class, 'updateTopic'])->name('update_topic');
    Route::post('/admin/topics/delete/{id}', [TopicController::class, 'deleteTopic'])->name('delete_topic');
    Route::post('/admin/update-topic-status/{id}', [TopicController::class, 'updateStatus'])->name('update_topic_status');

    //ql danh muc de tai
    Route::get('/admin/qldanhmuc', [TopicCategoryController::class, 'index'])->name('admin.qlloaidetai');
    Route::get('/admin/qlloaidetai', [TopicCategoryController::class, 'index'])->name('admin.qlloaidetai');
    Route::post('/admin/add-loai-de-tai', [TopicCategoryController::class, 'store'])->name('add_loai_de_tai');
    Route::post('/admin/update-loai-de-tai', [TopicCategoryController::class, 'update'])->name('update_loai_de_tai');
    Route::post('/admin/delete-loai-de-tai/{id}', [TopicCategoryController::class, 'destroy'])->name('delete_loai_de_tai');
});

//user
Route::group(['middleware' => 'user'], function () {
    Route::get("/user", [UserController::class, 'user'])->name('user.index');
});

//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Athuentication
Route::get("/login", [PagesController::class, 'login']);
Route::post("/login", [AuthController::class, 'xulylogin'])->name('login');

Route::get("/reg", [PagesController::class, 'reg']);
Route::post("/reg", [AuthController::class, 'xulyreg'])->name('reg');

//pages
Route::get("/sanpham", [PagesController::class, 'sanpham']);
Route::get("/giaithuong", [PagesController::class, 'giaithuong']);
Route::get("/detai", [PagesController::class, 'detai']);
Route::get("/hoithao", [PagesController::class, 'hoithao']);

//users
Route::get("/dktacgia", [UserController::class, 'dktacgia']);
Route::get("/dkdetai", [UserController::class, 'dkdetai']);
