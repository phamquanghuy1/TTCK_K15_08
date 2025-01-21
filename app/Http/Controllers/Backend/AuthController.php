<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct() {}
    public function xulylogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // Check if user exists and is active
        $user = User::where('email', $request->email)->first();
        if ($user && $user->trang_thai !== 'activate') {
            return back()->with('error', 'Tài khoản của bạn đã bị vô hiệu hóa, vui lòng liên hệ quản trị viên');
        }
        $status = Auth::attempt($credentials);
        if ($status) {
            if (Auth::user()->phan_quyen == 'user') {
                return redirect('/user')->with('success', 'Đăng nhập thành công');
            }
            return redirect('/admin/dashboard')->with('success', 'Đăng nhập thành công');
        }
        return back()->with('error', 'Email hoặc mật khẩu không đúng');
    }
    public function xulyreg(request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tel' => 'required|regex:/^0[0-9]{9}$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ], [
            'name.required' => 'Vui lòng nhập tên',
            'tel.required' => 'Vui lòng nhập SĐT',
            'tel.regex' => 'Vui lòng nhập SĐT đúng định dạng',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.confirmed' => 'Mật khẩu không khớp',
        ]);
        $user = new User();
        $user->ten_nguoi_dung = $request->name;
        $user->so_dien_thoai = $request->tel;
        $user->email = $request->email;
        $user->mat_khau = bcrypt($request->password);
        $user->save();
        return redirect('/login')->with('success', 'Đăng ký thành công');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
