<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;
use App\Models\DanhMuc;

class PagesController extends Controller
{
    public function __construct() {}
    public function login()
    {
        $thanhViens = Footer::all();
        $categories = DanhMuc::all();
        return view('auth.login',compact('thanhViens','categories'));
    }
    public function reg()
    {
        $categories = DanhMuc::all();
        $thanhViens = Footer::all();
        return view('auth.reg' , compact('thanhViens','categories'));
    }
    public function sanpham()
    {
        $categories = DanhMuc::all();
        $thanhViens = Footer::all();
        return view('user.sanpham' , compact('thanhViens','categories'));
    }
    public function giaithuong()
    {
        $categories = DanhMuc::all();
        $thanhViens = Footer::all();
        return view('user.giaithuong' , compact('thanhViens','categories'));
    }
    public function detai()
    {
        $categories = DanhMuc::all();
        $thanhViens = Footer::all();
        return view('user.detai' , compact('thanhViens','categories'));
    }
    public function hoithao()
    {
        $categories = DanhMuc::all();
        $thanhViens = Footer::all();
        return view('user.hoithao' , compact('thanhViens','categories'));
    }
}
