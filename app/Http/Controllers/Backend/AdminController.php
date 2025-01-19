<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function __construct() {}
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function qluser()
    {
        return view('admin.qluser');
    }
}
