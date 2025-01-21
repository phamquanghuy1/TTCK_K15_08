<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DonVi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('donVi');

        if ($request->filled('search')) {
            $query->where('ten_nguoi_dung', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('trang_thai', $request->status);
        }

        $users = $query->paginate(5);
        $donVis = DonVi::all();

        return view('admin.qluser', compact('users', 'donVis'));
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'ten_nguoi_dung' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'so_dien_thoai' => 'required|string',
            'ma_don_vi' => 'required|exists:don_vis,id',
            'chuc_vu' => 'required|string',
            'phan_quyen' => 'required',
            'mat_khau' => 'required|string',
        ]);

        $user = new User();
        $user->ten_nguoi_dung = $request->ten_nguoi_dung;
        $user->email = $request->email;
        $user->so_dien_thoai = $request->so_dien_thoai;
        $user->ma_don_vi = $request->ma_don_vi;
        $user->chuc_vu = $request->chuc_vu;
        $user->phan_quyen = $request->phan_quyen;
        $user->mat_khau = Hash::make($request->mat_khau);

        $user->save();

        return redirect()->route('admin.qluser')->with('success', 'User added successfully.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $donVis = DonVi::all();

        return view('admin.edituser', compact('user', 'donVis'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'ten_nguoi_dung' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'so_dien_thoai' => 'required|string',
            'ma_don_vi' => 'required|exists:don_vis,id',
            'chuc_vu' => 'required|string',
            'phan_quyen' => 'required',
            'mat_khau' => 'nullable|string',
        ]);

        $user = User::findOrFail($id);
        $user->ten_nguoi_dung = $request->ten_nguoi_dung;
        $user->email = $request->email;
        $user->so_dien_thoai = $request->so_dien_thoai;
        $user->ma_don_vi = $request->ma_don_vi;
        $user->chuc_vu = $request->chuc_vu;
        $user->phan_quyen = $request->phan_quyen;

        if ($request->filled('mat_khau')) {
            $user->mat_khau = Hash::make($request->mat_khau);
        }
        $user->save();

        return redirect()->route('admin.qluser')->with('success', 'Thêm thành viên thành công');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.qluser')->with('success', 'Xóa thành công');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:activate,deactivate',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->trang_thai = $request->status;
        $user->save();

        return redirect()->route('admin.qluser')->with('success', 'Sửa thành công');
    }

    public function getUser($id)
    {
        $user = User::with('donVi')->findOrFail($id);
        return response()->json($user);
    }
}
