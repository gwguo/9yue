<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登录显示
    public function index(){
        return view('user.login');
    }
    //注册显示
    public function register(){
        return view('user.register');
    }
}