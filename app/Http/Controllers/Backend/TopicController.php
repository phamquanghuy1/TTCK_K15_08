<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeTai;
use App\Models\DanhMuc;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        $danhMucs = DanhMuc::all();
        $query = DeTai::query();

        if ($request->filled('search')) {
            $query->where('ten_de_tai', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('trang_thai', $request->status);
        }

        $deTais = $query->paginate(6);

        return view('admin.qldetai', compact('deTais', 'danhMucs'));
    }

    public function getTopic($id)
    {
        $deTai = DeTai::find($id);
        return response()->json($deTai);
    }

    public function addTopic(Request $request)
    {
        $request->validate([
            'ten_de_tai' => 'required|string|max:255',
            'kinh_phi' => 'required|numeric',
            'noi_dung_nghien_cuu' => 'required|string',
            'tu_ngay' => 'required|date',
            'den_ngay' => 'required|date',
            'ma_danh_muc' => 'required|exists:danh_mucs,id',
        ]);

        DeTai::create($request->all());

        return redirect()->route('admin.qldetai')->with('success', 'Đề tài đã được thêm thành công.');
    }

    public function updateTopic(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:de_tais,id',
            'ten_de_tai' => 'required|string|max:255',
            'kinh_phi' => 'required|numeric',
            'noi_dung_nghien_cuu' => 'required|string',
            'tu_ngay' => 'required|date',
            'den_ngay' => 'required|date',
            'ma_danh_muc' => 'required|exists:danh_mucs,id',
        ]);

        $deTai = DeTai::find($request->id);
        $deTai->update($request->all());

        return redirect()->route('admin.qldetai')->with('success', 'Đề tài đã được cập nhật thành công.');
    }

    public function deleteTopic($id)
    {
        DeTai::destroy($id);
        return redirect()->route('admin.qldetai')->with('success', 'Đề tài đã được xóa thành công.');
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:activate,deactivate',
        ]);

        $deTai = DeTai::find($id);
        if ($deTai) {
            $deTai->trang_thai = $request->status;
            $deTai->save();
            return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
        }

        return redirect()->back()->with('error', 'Không tìm thấy đề tài');
    }
}
