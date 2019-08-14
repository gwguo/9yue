<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;
use App\Model\BackModel;
use App\Model\homeworkModel;
use App\Model\WordModel;
use App\Model\ReplyModel;
use App\Model\StudyModel;
use App\Model\LeaveModel;
use Illuminate\Support\Facades\Cache;
class UserController extends Controller
{
    //个人中心首页
        public function userindex(Request $request)
        {
//            $bool = Cache::forget('user');
//            var_dump($bool);die;
            $res = $code1 = cache::get('user');
            if (empty($res)) {
                echo '<script>alert("请先登录");window.location.href="/user/login";</script>';
                exit;
            } else {


                $data = UserModel::where('u_name', $res)->orwhere('u_email', $res)->first();
                $arr=[
                    'u_id'=>$data['u_id'],
                    'collect'=>2,
                ];
                $arr=StudyModel::join('course','course.c_id','=','user_study.c_id')->where($arr)->get();

                    return view('user.mecourse', ['data' => $data,'arr'=>$arr]);
                }
        }
        //退出
    public function exitadd(){
        $bool = Cache::forget('user');
        if($bool){
            echo '<script>alert("退出成功");window.location.href="/user/login";</script>';
            exit;
        }else{
            echo '<script>alert("退出失败");window.location.href="/user/userindex";</script>';
            exit;
        }
    }
        //修改密码页面
    public function updatepwd($id){
          $res=UserModel::where('u_id','=',$id)->first();
            return view('user.updatepwd',['res'=>$res]);
    }
    //修改密码
    public function updpwddo(Request $request){
            $uid=$request->uid;
            $u_pwd=$request->u_pwd;
            $pwd=$request->pwd;
            $pwds=md5($pwd);
            $res=UserModel::where('u_id','=',$uid)->first();
            if($res->u_pwd!=$pwds){
                echo 2;exit;
            }
            $u_pwds=md5($u_pwd);
            $arr=UserModel::where('u_id','=',$uid)->update(['u_pwd'=>$u_pwds]);
            if($arr){
                Cache::forget('user');
                echo 1;
            }else{
                echo 3;
            }


    }
    //修改信息页面
    public function mesetting($id){
        $res=UserModel::where('u_id','=',$id)->first();
        return view('user.mesetting',['res'=>$res]);
    }
    //图片上传
    public function updmeset(Request $request){

        $file = $_FILES['file'];
        $path = $file['tmp_name'];
        $newpath = "./uploads/" . $file['name'];
        $res=move_uploaded_file($path, $newpath);
        cache::put('img',$newpath);
        if ($res) {
            echo 1;
        } else {
         echo 2;
        }

    }
    //修改信息执行
    public function updateme(Request $request){
            $uid=$request->uid;
            $u_email=$request->u_email;
            $u_name=$request->u_name;
            $u_code=$request->u_code;

            $code=cache::get('code');
            if($u_code!=$code){
                echo 3;exit;
            }
            $file=cache::get('img');
            $data=[
                'u_email'=>$u_email,
                'u_name'=>$u_name,
                'u_img'=>$file
            ];
            $res=UserModel::where('u_id','=',$uid)->update($data);
            if($res){
                echo 1;
            }else{
                echo 2;
            }



    }

    //我的笔记
    public function meword(){
        $ress=WordModel::get();
        $res = $code1 = cache::get('user');
        $data = UserModel::where('u_name', $res)->first();

        $data2 = UserModel::where('u_email', $res)->first();
        if($data == "") {
            return view('user.meword', ['data' => $data2,'res'=>$ress]);
        }else if($data2==""){
            return view('user.meword', ['data' => $data,'res'=>$ress]);
        }

    }
    //添加笔记
    public function writeword(){

            return view('user.writeword');
    }


    //添加笔记执行
    public function worddo(Request $request){
            $name=$request->name;
            $word=$request->word;
            $data=[
                'w_title'=>$name,
                'w_content'=>$word,
                'c_time'=>time()
            ];
            $res=WordModel::insert($data);
            if($res){
                echo 1;
            }else{
                echo 2;
            }
    }
    //我的题库
    public function training(){
            $res = $code1 = cache::get('user');
            $data = UserModel::where('u_name', $res)->first();
            $data2 = UserModel::where('u_email', $res)->first();
             $arr=BackModel::get();
            if($data == "") {
                return view('user/training', ['data' => $data2,'arr'=>$arr]);
            }else if($data2==""){
                return view('user/training', ['data' => $data,'arr'=>$arr]);
            }
    }
    //我都问答
    public function myask(){
            $arr=LeaveModel::join('user','user.u_id','=','leave_words.u_id')->where('status','=',1)->get()->toArray();
            $arr2=ReplyModel::join('teacher','reply.t_id','=','teacher.t_id')->get();
        $res = $code1 = cache::get('user');
        $data = UserModel::where('u_name', $res)->first();
        $data2 = UserModel::where('u_email', $res)->first();
        if($data == "") {
            return view('user/myask', ['data' => $data2,'arr'=>$arr,'arr2'=>$arr2]);
        }else if($data2==""){
            return view('user/myask', ['data' => $data,'arr'=>$arr,'arr2'=>$arr2]);
        }

    }
    //提问题
    public function getcontent(Request $request){
            $content=$request->content;
            $uid=$request->uid;
            $data=[
                'u_id'=>$uid,
                'l_contents'=>$content,
                'c_time'=>time(),
                'status'=>1,
            ];
            $res=LeaveModel::insert($data);
            if($res){
                echo 1;
            }else{
                echo 2;
            }

    }
    //回复答案
    public function putcontent(Request $request){
        $content=$request->content;
        $con=$request->con;
        $data=[
            'work_reply'=>$content,
            'u_time'=>time(),
        ];

        $res=BackModel::where('work_id','=',$con)->update($data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }

    }
    //我的作业
    public function myhomework(){
        $res = $code1 = cache::get('user');
        $data = UserModel::where('u_name', $res)->first();

        $arr=BackModel::get();
        $data2 = UserModel::where('u_email', $res)->first();
        if($data == "") {
            return view('user/myhomework', ['data' => $data2,'arr'=>$arr]);
        }else if($data2==""){
            return view('user/myhomework', ['data' => $data,'arr'=>$arr]);
        }

    }
}