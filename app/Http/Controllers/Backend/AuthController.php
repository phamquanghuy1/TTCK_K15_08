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
        $email = $request->email;
        $password = $request->password;
        $status = Auth::attempt(['email' => $email, 'password' => $password]);
        if ($status) {
            if (Auth::user()->role == 'admin') {
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
