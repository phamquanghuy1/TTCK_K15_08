<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaiBaoKhoaHoc;
use App\Models\DanhMuc;
use App\Models\Footer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct() {}
    public function user(Request $request)
    {
        $query = BaiBaoKhoaHoc::with('danhMuc', 'donVi')
        ->where('trang_thai', 'activate');

        if ($request->filled('tenDeTai')) {
            $query->where('tieu_de', 'like', '%' . $request->tenDeTai . '%');
        }

        if ($request->filled('khoaDonVi')) {
            $query->whereHas('donVi', function ($q) use ($request) {
                $q->where('ten_don_vi', 'like', '%' . $request->khoaDonVi . '%');
            });
        }

        if ($request->filled('danhMucDeTai')) {
            $query->where('ma_danh_muc', $request->danhMucDeTai);
        }

        if ($request->filled('namXuatBan')) {
            $query->whereYear('ngay_phat_hanh', $request->namXuatBan);
        }

        if ($request->filled('tacGia')) {
            $query->where('tac_gia', 'like', '%' . $request->tacGia . '%');
        }

        $articles = $query->paginate(5);
        $categories = DanhMuc::all();
        $thanhViens = Footer::all();
        return view('user.index', compact('articles','categories','thanhViens'));
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
