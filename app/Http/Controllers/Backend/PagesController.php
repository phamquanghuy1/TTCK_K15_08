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
        return view('user.sanpham');
    }
    public function giaithuong()
    {
        return view('user.giaithuong');
    }
    public function detai()
    {
        return view('user.detai');
    }
    public function hoithao()
    {
        return view('user.hoithao');
    }
}
