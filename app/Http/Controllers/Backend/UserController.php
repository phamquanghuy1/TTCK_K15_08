<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class UserController extends Controller
{
    public function __construct() {}

    public function user()
    {
        $articles = Article::with('creator:id,name')->get();
        return view('user.index', compact('articles'));
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
