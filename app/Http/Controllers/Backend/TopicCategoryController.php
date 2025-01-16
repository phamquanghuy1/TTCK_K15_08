<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanhMuc;

class TopicCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $loaiDeTais = DanhMuc::when($search, function ($query) use ($search) {
            $query->where('ten_danh_muc', 'LIKE', "%{$search}%");
        })->paginate(10);

        return view('admin.qlloaidetai', compact('loaiDeTais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_danh_muc' => 'required|string|max:255',
        ]);

        DanhMuc::create([
            'ten_danh_muc' => $request->ten_danh_muc,
        ]);

        return redirect()->route('admin.qlloaidetai')->with('success', 'Thêm loại đề tài thành công');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:danh_mucs,id',
            'ten_danh_muc' => 'required|string|max:255',
        ]);

        $danhMuc = DanhMuc::find($request->id);
        $danhMuc->ten_danh_muc = $request->ten_danh_muc;
        $danhMuc->save();

        return redirect()->route('admin.qlloaidetai')->with('success', 'Cập nhật loại đề tài thành công');
    }

    public function destroy($id)
    {
        DanhMuc::destroy($id);
        return redirect()->route('admin.qlloaidetai')->with('success', 'Xóa loại đề tài thành công');
    }
}
