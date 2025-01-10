<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\CanBo;

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
    public function qltacgia()
    {
        $sinhViens = SinhVien::select('id', 'ten_sinh_vien as ten', 'email', 'dien_thoai', 'gioi_tinh', 'ma_don_vi', 'trang_thai', 'created_at')
            ->with('donVi')
            ->get();
        $canBos = CanBo::select('id', 'ten_can_bo as ten', 'email', 'dien_thoai', 'gioi_tinh', 'ma_don_vi', 'trang_thai', 'created_at')
            ->with('donVi')
            ->get();

        $authors = $sinhViens->merge($canBos)->sortBy('created_at');
        return view('admin.qltacgia', compact('authors'));
    }
    public function qlbaiviet()
    {
        return view('admin.qlbaiviet');
    }public function qldetai()
    {
        return view('admin.qldetai');
    }public function qldanhmuc()
    {
        return view('admin.qldanhmuc');
    }
}
