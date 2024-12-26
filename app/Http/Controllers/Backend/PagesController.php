<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct() {}
    public function login()
    {
        return view('auth.login');
    }
    public function reg()
    {
        return view('auth.reg');
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
    public function dktacgia()
    {
        return view('user.dktacgia');
    }
    public function dkdetai()
    {
        return view('user.dkdetai');
    }

}
