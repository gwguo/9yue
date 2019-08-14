<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\CourseTypeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\TeacherModel;
use App\Model\Admin\CourseModel;

class TeacherController extends Controller
{
    //教师列表页
    public function teacherList()
    {
        $teacher_info = TeacherModel::orderBy('t_id','desc')->get();
        if( !empty($teacher_info) ){
            $teacher_info = $teacher_info->toArray();
        }
        return view('admin/teacher/teacherlist',['teacher_info'=>$teacher_info]);
    }

    //教师审核通过
    public function teachercheckok( Request $request )
    {
        $t_id = $request->post('t_id');
        //dd($t_id);
        $res = TeacherModel::where(['t_id'=>$t_id])->update(['audit'=>1,'audit_reason'=>null]);
        if($res){
            return [
                'msg'=>'审核通过成功',
                'code'=> 6
            ];
        }else{
            return [
                'msg'=>'审核通过失败',
                'code'=> 5
            ];
        }
    }

    //教师审核不通过
    public function teachercheckno( Request $request )
    {
        if( $request -> isMethod('post') ){
            $data = $request->post();
            //dd($data);
            $t_id = $data['t_id'];
            $audit_reason = $data['audit_reason'];
            $update_res = TeacherModel::where(['t_id'=>$t_id])->update(['audit_reason'=>$audit_reason]);
            if($update_res){
                return [
                    'msg'=>'审核原因提交成功',
                    'code'=> 6
                ];
            }else{
                return [
                    'msg'=>'审核原因提交失败',
                    'code'=> 5
                ];
            }
        }else{
            $t_id = $request->post('t_id');
            //dd($t_id);
            return view('admin/teacher/teachercheckno',['t_id'=>$t_id]);
        }

    }

    //课程分类添加
    public function coursecateadd( Request $request )
    {
        if( $request->isMethod('post')){
            $data = $request->post();
            $res = CourseTypeModel::insert($data);
            if($res){
                return [
                    'msg'=>'课程分类添加成功',
                    'code'=>6
                ];
            }else{
                return [
                    'msg'=>'课程分类添加失败',
                    'code'=> 5
                ];
            }
        }else{
            return view('admin/teacher/coursecateadd');
        }
    }

    //课程分类列表
    public function coursecatelist()
    {
        $coursecate_info = CourseTypeModel::where(['course_status'=>1])->get();
        if( !empty($coursecate_info) ){
            $coursecate_info = $coursecate_info->toArray();
        }
        return view('admin/teacher/coursecatelist',['coursecate_info'=>$coursecate_info]);
    }

    //课程分类删除
    public function coursecatedel( Request $request )
    {
        $course_id = $request->post('course_id');

        $advisory_info = CourseModel::where(['course_id'=>$course_id])->get();
        if(empty($advisory_info)){
            return [
                'msg'=>'该分类下有课程，不可以直接删除该分类',
                'code'=> 5
            ];
        }
        $res = CourseTypeModel::where(['course_id'=>$course_id])->update(['course_status'=>2]);
        if($res){
            return [
                'msg'=>'删除成功',
                'code'=> 6
            ];
        }else{
            return [
                'msg'=>'删除失败',
                'code'=> 5
            ];
        }
    }

    //课程分类修改
    public function coursecateedit( Request $request )
    {
        if( $request->isMethod('post')){
            $data = $request->post();
            $res = CourseTypeModel::where(['course_id'=>$data['course_id']])->update(['course_name'=>$data['course_name']]);
            if($res){
                return [
                    'msg'=>'课程分类修改成功',
                    'code'=>6
                ];
            }else{
                return [
                    'msg'=>'课程分类修改失败',
                    'code'=> 5
                ];
            }
        }else{
            $course_id = $request->post('course_id');
            $course_name = CourseTypeModel::where(['course_id'=>$course_id])->value('course_name');
            //dd($a_cate_name);
            return view('admin/teacher/coursecateedit',['course_id'=>$course_id,'course_name'=>$course_name]);
        }
    }

    //课程列表
    public function courselist()
    {
        $course = CourseModel::join('course_type','course.course_id','=','course_type.course_id')
            ->where(['course.is_del'=>0])->get();

        if(!empty($course)){
            $course = $course->toArray();
            //dd($course);
        }
        return view('admin/teacher/courselist',['course'=>$course]);
    }

}
