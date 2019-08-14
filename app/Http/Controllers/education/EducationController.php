<?php

namespace App\Http\Controllers\education;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EducationController extends Controller
{
    //首页
    public function index(){
       return view('education.index');
    }
}
