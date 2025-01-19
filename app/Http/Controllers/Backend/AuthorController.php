<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\SinhVien;
use App\Models\CanBo;
use App\Models\DonVi;

class AuthorController extends Controller
{
    public function __construct() {}
    public function qltacgia(Request $request)
    {
        $donVis = DonVi::all();
        $search = $request->get('search', '');
        $status = $request->get('status', '');

        $sinhViens = SinhVien::select(
            'id',
            'trang_thai',
            'ten_sinh_vien as ten',
            'email',
            'dien_thoai',
            'gioi_tinh',
            'ma_don_vi',
            'created_at'
        )
            ->with('donVi')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('ten_sinh_vien', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%");
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('trang_thai', $status);
            })
            ->get();

        $canBos = CanBo::select(
            'id',
            'trang_thai',
            'ten_can_bo as ten',
            'email',
            'dien_thoai',
            'gioi_tinh',
            'ma_don_vi',
            'created_at'
        )
            ->with('donVi')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('ten_can_bo', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%");
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('trang_thai', $status);
            })
            ->get();

        $merged = $sinhViens->concat($canBos)->sortBy('created_at');
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $currentItems = $merged->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $authors = new LengthAwarePaginator(
            $currentItems,
            $merged->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        return view('admin.qltacgia', compact('authors', 'donVis', 'search', 'status'));
    }
    
    public function addAuthor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Nam,Nữ',
            'email' => 'required|string|email|max:255|unique:sinh_viens,email|unique:can_bos,email',
            'tel' => 'required|string|max:15',
            'role' => 'required|in:SinhVien,CanBo',
            'don_vi' => 'required|exists:don_vis,id',
            'status' => 'required|in:activate,deactivate',
        ]);
        $data = [
            'ten_sinh_vien' => $request->name,  // For student
            'ten_can_bo' => $request->name,     // For staff
            'trang_thai' => $request->status,
            'gioi_tinh' => $request->gender,
            'dien_thoai' => $request->tel,
            'email' => $request->email,
            'ma_don_vi' => $request->don_vi,
        ];

        if ($request->role === 'SinhVien') {
            SinhVien::create([
                ...$data,
                'ten_sinh_vien' => $data['ten_sinh_vien']
            ]);
        } else if ($request->role === 'CanBo') {
            CanBo::create([
                ...$data,
                'ten_can_bo' => $data['ten_can_bo']
            ]);
        }
        return redirect()->back()->with('success', 'Thêm tác giả thành công');
    }
    public function updateStatus(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'status' => 'required|in:activate,deactivate',
        ]);

        $author = SinhVien::where('email', $request->email)->first() ?? CanBo::where('email', $request->email)->first();

        if ($author) {
            $author->trang_thai = $request->status;
            $author->save();
            return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
        }

        return redirect()->back()->with('error', 'Không tìm thấy tác giả');
    }
    public function deleteAuthor(Request $request)
    {
        $id = $request->id;

        // Try to find and delete in SinhVien
        if ($author = SinhVien::find($id)) {
            $author->delete();
            return redirect()->back()->with('success', 'Xóa tác giả thành công');
        }

        // Try to find and delete in CanBo
        if ($author = CanBo::find($id)) {
            $author->delete();
            return redirect()->back()->with('success', 'Xóa tác giả thành công');
        }

        return redirect()->back()->with('error', 'Không tìm thấy tác giả');
    }
}
