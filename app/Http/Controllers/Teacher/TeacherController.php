<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TeacherModel;
class TeacherController extends Controller{
    public function login(){
        return view('teacher.login');
    }
    public function logindo(Request $request){
        $t_name=$request->input('t_name');
        $t_pwd=$request->input('t_pwd');
        $arr=TeacherModel::where('t_name',$t_name)->first();
        if($arr){
            if($t_pwd==$arr['t_pwd']){
                session(['teacher_id'=>$arr['t_id']]);
            }else{
                return json_encode(['code'=>0,'msg'=>'用户名或密码不正确']);
            }
        }else{
            return json_encode(['code'=>0,'msg'=>'没有此用户']);
        }
    }
}