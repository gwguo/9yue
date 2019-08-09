<?php

namespace App\Http\Controllers\course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    //课程主列表
    public function lists(){
        return view('course.lists');
    }
}
