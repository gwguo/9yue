<?php

namespace App\Http\Controllers\course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CourseController extends Controller
{
    //课程主列表
    public function lists(Request $request){
        $c_name = $request->c_name??'';
        $where[] = ['status',1];
        //搜索
        if ($c_name){
            $where[] = ['c_name','like',"%$c_name%"];
        }
        //课程数据
        $course = DB::table('course')->where($where)->get();
        //分类数据
        $course_type = DB::table('course_type')->get()->toArray();
        foreach($course_type as $v){
            $v->son = $course;
        }
        return view('course.lists',compact('course','course_type'));
    }
    //课程详情
    public function coursecont(Request $request){
        //接收课程IDc_id
        $c_id = $request->c_id??'';
        if ($c_id==''){
            echo '请选择课时';die;
        }
        //课程章节数据
        $course_section = DB::table('course_section')->where('c_id',$c_id)->get();
        //授课老师
        $t_id = DB::table('course')->where('c_id',$c_id)->value('t_id');
        $teacher = DB::table('teacher')->where('t_id',$t_id)->first();
        //课程公告
        $c_notice = DB::table('course')->where('c_id',$c_id)->value('c_notice');
        return view('course.coursecont',compact('course_section','teacher','c_notice'));
    }
    //课程小节详情
    public function coursecont1(Request $request){
        $section_id = $request->section_id??'';
        //取出用户ID
        $u_id = isset($_SESSION['u_id']);
        $u_id = '1';
        //章节数据
        $section = DB::table('course_section')->where('section_id',$section_id)->first();
        //章节下的小结数据
        $course_son_section = DB::table('course_son_section')->where('section_id',$section->section_id)->get()->toArray();
        foreach ($course_son_section as $v){
            //小结下的课时数据
            $v->son = DB::table('course_period')->where('son_id',$v->son_id)->get();
        }
        //授课老师
        $t_id = DB::table('course')->where('c_id',$section->c_id)->value('t_id');
        $teacher = DB::table('teacher')->where('t_id',$t_id)->first();
        return view('course.coursecont1',compact('teacher','section','course_son_section','u_id'));
    }
    //用户评论，打分
    public function content_comment(Request $request){
        //取出用户ID
        $u_id = isset($_SESSION['u_id']);
        $u_id = '1';
        $l_content = $request->l_content??'';
        $score = $request->score??'';
        $c_id = $request->c_id??'';
        if ($l_content!=''){

        }
    }
    //用户问答
    public function questions(Request $request){
        //取出用户ID
        $u_id = isset($_SESSION['u_id']);
        $u_id = '1';
        $content = $request->content??'';
        $title = $request->title??'';
        $c_id = $request->c_id??'';
        if ($content!=''){

        }
    }
}
