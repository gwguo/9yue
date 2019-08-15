<?php

namespace App\Http\Controllers\information;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class InformationController extends Controller
{
    //咨询内容
    public function information(){
        //查询咨讯数据库
        $article= DB::table('advisory')->paginate(4);

        $where=[
            'a_hot'=>1,
        ];

        //热门咨询
        $ahot= DB::table('advisory')->where($where)->orderBy('c_time','desc')->limit(6)->get();

        //推荐课程
        $course = DB::table('course')->orderBy('c_number','desc')->select('c_name','c_img')->paginate(3);

        return view("information/article",compact('article','ahot','course'));
    }

    //咨询内容
    public function articlelist(Request $request){
        $a_id=$request->id;
       $where =[
           'a_id'=>$a_id
       ];
       $wherehot =[
           'a_hot'=>1
       ] ;

        $ahot= DB::table('advisory')->where($wherehot)->orderBy('c_time','desc')->limit(6)->get();

        $desc = DB::table('advisory')->where($where)->get();
        $desc = collect($desc)->toArray();
//        dump($desc);die;
        //推荐课程
        $course = DB::table('course')->orderBy('c_number','desc')->select('c_name','c_img')->paginate(3);



        return view('information/articlelist',compact('desc','ahot','course'));
    }

    //考试指导老师
    public function teacherlist(){
        $teacher = DB::table('teacher')->get();
        return view('/information/teacherlist',compact("teacher"));
    }

    //指导窗口
    public function chat(){
        //获取老师id
        $t_id=\request()->id;

        //查询
        $db= DB::table('teacher')->where('t_id',$t_id)->get();

        return view('information.chat',compact('db'));
    }

    //请教内容
    public function chatdo(){
        $test= \request()->text;
        dump($test);die;
    }


    //课程列表
    public function courselist(){
        $course= DB::table('course')->get();

        return view('/course/course',compact('course'));
    }

    //课程详情
    public function coursecont(){
        //获取id
        $id=\request()->id;
        $course= DB::table('course')->where('c_id',$id)->get()->toArray();


        return view('/course/buycoursecont',compact('course'));
    }

    //购买课程
    public function buycoursecont(){
        $id=\request()->id;

//        dump($id);die;
//        $model=DB::table('course')->where('c_id',$id)->get()->toArray();
        $model=DB::table('course')->where('c_id',$id)->first();
        $model=collect($model)->toArray();


        return view("/order/order",compact('model'));

//
//        if($id==''){
//            echo("<script>alert('不好意思，至少需要选择一项课程')</script>");
//        }
//
//        if(!empty($user_id)){
//
//            $order_model=DB::table('course_order');
//            //开启事务
//            DB::beginTransaction();
//
//        }else{
//            echo("<script>alert('不好意思，请您先登录'),location.href='/login/login'</script>");
//        }
//        dump($id);die;
    }



}
