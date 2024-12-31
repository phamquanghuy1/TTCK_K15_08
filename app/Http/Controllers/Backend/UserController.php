<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class UserController extends Controller
{
    public function __construct() {}

    public function user(Request $request)
    {
        $query = Article::with('creator:id,name');
        $categories = Category::all(['id', 'name']);
        if ($request->filled('tenDeTai')) {
            $query->where('title', 'like', '%' . $request->tenDeTai . '%');
        }
        if ($request->filled('khoaDonVi')) {
            $query->where('classification', 'like', '%' . $request->khoaDonVi . '%');
        }
        if ($request->filled('danhMucDeTai')) {
            $query->where('category_id', $request->danhMucDeTai);
        }
        if ($request->filled('namXuatBan')) {
            $query->whereYear('publication_date', $request->namXuatBan);
        }
        if ($request->filled('tacGia')) {
            $query->whereHas('creator', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->tacGia . '%');
            });
        }

        $articles = $query->get();
        $showNoResults = $request->hasAny(['tenDeTai', 'khoaDonVi', 'danhMucDeTai', 'namXuatBan', 'tacGia']) && $articles->isEmpty();
        return view('user.index', compact('articles','categories','showNoResults'));
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
