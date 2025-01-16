<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaiBaoKhoaHoc;

class AdminController extends Controller
{
    public function __construct() {}
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function qluser()
    {
        return view('admin.qluser');
    }
    public function qldetai()
    {
    }
    public function qldanhmuc()
    {
        return view('admin.qldanhmuc');
    }
}
