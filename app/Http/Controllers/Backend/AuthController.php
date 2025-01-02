<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct() {}
    public function xulylogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $status = Auth::attempt($credentials);
        if ($status) {
            if (Auth::user()->phan_quyen == 'admin') {
                return redirect('/admin')->with('success', 'Đăng nhập thành công');
            }
            return redirect('/user')->with('success', 'Đăng nhập thành công');
        }
        return back()->with('error', 'Email hoặc mật khẩu không đúng');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function xulyreg() {

    }
}
