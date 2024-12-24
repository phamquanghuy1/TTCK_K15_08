<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(){}
    public function login(){
        return view('auth.login');
    }
    public function xulylogin(Request $request){
        $email = $request->email;
        $password = $request->password;
        $status = Auth::attempt(['email'=>$email,'password'=>$password]);
        if($status){
            if(Auth::user()->role == 'admin'){
                return redirect('/admin');
            }
            return redirect('/user/index');
        }
        return back()->with('error','Tài khoản hoặc mật khẩu không đúng');
    }
    public function reg(){
        return view('auth.reg');
    }
    public function xulyreg(){

    }
}
