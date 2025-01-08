<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;

class PagesController extends Controller
{
    public function __construct() {}
    public function login()
    {
        $thanhViens = Footer::all();
        return view('auth.login',compact('thanhViens'));
    }
    public function reg()
    {
        $thanhViens = Footer::all();
        return view('auth.reg' , compact('thanhViens'));
    }
    public function sanpham()
    {
        $thanhViens = Footer::all();
        return view('user.sanpham' , compact('thanhViens'));
    }
    public function giaithuong()
    {
        $thanhViens = Footer::all();
        return view('user.giaithuong' , compact('thanhViens'));
    }
    public function detai()
    {
        $thanhViens = Footer::all();
        return view('user.detai' , compact('thanhViens'));
    }
    public function hoithao()
    {
        $thanhViens = Footer::all();
        return view('user.hoithao' , compact('thanhViens'));
    }
}
