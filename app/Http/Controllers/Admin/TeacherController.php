<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\CourseTypeModel;
use App\Model\Admin\SectionModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\TeacherModel;
use App\Model\Admin\CourseModel;
use App\Model\Admin\PeriodModel;

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
            //dd($course_id);
            $course_name = CourseTypeModel::where(['course_id'=>$course_id])->value('course_name');
            //dd($a_cate_name);
            return view('admin/teacher/coursecateedit',['course_id'=>$course_id,'course_name'=>$course_name]);
        }
    }

    //课程列表
    public function courselist()
    {
        $course = CourseModel::join('course_type','course.course_id','=','course_type.course_id')
            ->where(['course.is_del'=>0])->get()->toArray();
        //var_dump($course);die;
//        if(!empty($course)){
//            $course = $course->toArray();
//            //dd($course);
//        }
        return view('admin/teacher/courselist',['course'=>$course]);
    }

    //课程审核通过
    public function coursecheckok( Request $request )
    {
        $c_id = $request->post('c_id');
        //dd($t_id);
        $res = CourseModel::where(['c_id'=>$c_id])->update(['audit'=>2,'audit_reason'=>null]);
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

    //课程审核不通过
    public function coursecheckno( Request $request )
    {
        if( $request -> isMethod('post') ){
            $data = $request->post();
            //dd($data);
            $c_id = $data['c_id'];
            $audit_reason = $data['audit_reason'];
            $update_res = CourseModel::where(['c_id'=>$c_id])->update(['audit_reason'=>$audit_reason,'audit'=>3]);
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
            $c_id = $request->post('c_id');
            return view('admin/teacher/coursecheckno',['c_id'=>$c_id]);
        }
    }

    //课程删除
    public function coursecheckdel( Request $request )
    {
        $c_id = $request->post('c_id');
        $course_info = SectionModel::where(['c_id'=>$c_id])->get();
        if(empty($course_info)){
            return [
                'msg'=>'该课程下有内容，不可以直接删除',
                'code'=> 5
            ];
        }
        $res = CourseModel::where(['c_id'=>$c_id])->update(['is_del'=>1]);
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

    //章节列表
    public function sectionlist()
    {
        $section = SectionModel::join('course','course.c_id','=','course_section.c_id')
            ->where(['course_section.sis_del'=>0])->get()->toArray();
        //dd($section);
        return view('admin/teacher/sectionlist',['section'=>$section]);
    }

    //章节审核通过
    public function sectioncheckok( Request $request )
    {
        $section_id = $request->post('section_id');
        //dd($t_id);
        $res = SectionModel::where(['section_id'=>$section_id])->update(['c_audit'=>2,'c_audit_reason'=>null]);
        //dd($res);
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

    //章节审核不通过
    public function sectioncheckno( Request $request )
    {
        if( $request -> isMethod('post') ){
            $data = $request->post();
            //dd($data);
            $section_id = $data['section_id'];
            $audit_reason = $data['c_audit_reason'];
            $update_res = SectionModel::where(['section_id'=>$section_id])->update(['c_audit_reason'=>$audit_reason,'c_audit'=>3]);
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
            $section_id = $request->post('section_id');
            return view('admin/teacher/sectioncheckno',['section_id'=>$section_id]);
        }
    }

    //章节删除
    public function sectioncheckdel( Request $request )
    {
        $section_id = $request->post('section_id');
        $res = SectionModel::where(['section_id'=>$section_id])->update(['sis_del'=>1]);
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

    //课时列表
    public function periodlist()
    {
        $period = PeriodModel::where(['course_period.pis_del'=>0])->get()->toArray();
        //dd($section);
        return view('admin/teacher/period',['period'=>$period]);
    }

    //课时审核通过
    public function periodcheckok( Request $request )
    {
        $period_id = $request->post('period_id');
        //dd($t_id);
        $res = PeriodModel::where(['period_id'=>$period_id])->update(['p_audit'=>2,'p_audit_reason'=>null]);
        //dd($res);
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

    //课时审核不通过
    public function periodcheckno( Request $request )
    {
        if( $request -> isMethod('post') ){
            $data = $request->post();
            //dd($data);
            $period_id = $data['period_id'];
            $audit_reason = $data['p_audit_reason'];
            $update_res = PeriodModel::where(['period_id'=>$period_id])->update(['p_audit_reason'=>$audit_reason,'p_audit'=>3]);
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
            $period_id = $request->post('period_id');
            return view('admin/teacher/periodcheckno',['period_id'=>$period_id]);
        }
    }

    //课时删除
    public function periodcheckdel( Request $request )
    {
        $period_id = $request->post('period_id');
        $res = PeriodModel::where(['period_id'=>$period_id])->update(['pis_del'=>1]);
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



}
