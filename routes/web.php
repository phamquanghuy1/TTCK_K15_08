<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    return view('index');
});

Route::get('/test', function(){
    $user = User::find(1);
    return $user->projects;
});
