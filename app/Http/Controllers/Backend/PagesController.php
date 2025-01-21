<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;
use App\Models\DanhMuc;
use App\Models\DeTai;

class PagesController extends Controller
{
    public function __construct() {}
    public function login()
    {
        $thanhViens = Footer::all();
        $categories = DanhMuc::all();
        return view('auth.login', compact('thanhViens', 'categories'));
    }
    public function reg()
    {
        $categories = DanhMuc::all();
        $thanhViens = Footer::all();
        return view('auth.reg', compact('thanhViens', 'categories'));
    }
    public function sanpham()
    {
        $categories = DanhMuc::all();
        $thanhViens = Footer::all();
        return view('user.sanpham', compact('thanhViens', 'categories'));
    }
    public function giaithuong()
    {
        $categories = DanhMuc::all();
        $thanhViens = Footer::all();
        return view('user.giaithuong', compact('thanhViens', 'categories'));
    }
    public function detai(Request $request)
    {
        $query = DeTai::query();

        if ($request->has('search_title')) {
            $query->where('ten_de_tai', 'LIKE', '%' . $request->search_title . '%');
        }

        if ($request->has('search_year')) {
            $query->whereYear('created_at', $request->search_year);
        }

        $deTais = $query->where('trang_thai', 'activate')
            ->orderBy('tu_ngay', 'desc')
            ->paginate(10)
            ->withQueryString();
        $categories = DanhMuc::all();
        $thanhViens = Footer::all();
        return view('user.detai', compact('thanhViens', 'categories', 'deTais'));
    }
    public function hoithao()
    {
        $categories = DanhMuc::all();
        $thanhViens = Footer::all();
        return view('user.hoithao', compact('thanhViens', 'categories'));
    }
}
