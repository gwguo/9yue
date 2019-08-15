<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
class LoginController extends Controller
{
    //登录显示
    public function index(){
        return view('user.login');
    }
    //登录执行
    public function logindo(Request $request){
        $name=$request->name;
        $u_pwd=$request->u_pwd;
        $pwd=md5($u_pwd);
        $res=UserModel::where('u_email','=',$name)->orwhere('u_name','=',$name)->first();
        if(empty($res)){
            echo 3;
        }else if($res['u_pwd']==$pwd){
            $code1= cache::put('user',$name,3600);
            echo 1;
        }else{
            echo 2;
        }
    }

    //注册显示
    public function register(){
        return view('user.register');
    }
    //邮箱
    public function getcode(Request $request){
        $email=$request->u_email;
        $code = mt_rand(11111,99999);

        $code1= cache::put('code',$code,3600);

        Mail::send('email.welcome', ['code' => $code], function($message)use($email)
        {
            $code = mt_rand(11111,99999);
            $code1= cache::put('code',$code,3600);
//            dd($code1);die;
            $res=$message->to($email)->subject('你的验证码是'.$code.'但1小时失效');

        });

    }
    //注册执行
    public function registerdo(Request $request){
        $u_email=$request->u_email;
        $u_name=$request->u_name;
        $u_pwd=$request->u_pwd;
        $u_code=$request->u_code;
        $code=cache::get('code');
        if($u_code!=$code){
            echo 3;exit;
        }
        $u_pwds=md5($u_pwd);

        $data=[
            'u_email'=>$u_email,
            'u_name'=>$u_name,
            'u_pwd'=>$u_pwds,
            'c_time'=>time()
        ];
        $arr=UserModel::where('u_email','=',$u_email)->first();
        if($arr){
            echo 4;exit;
        }
        $arr2=UserModel::where('u_name','=',$u_name)->first();
        if($arr2){
            echo 5;exit;
        }
        $res=UserModel::insert($data);
       if($res){
           echo 1;
       }else{
           echo 2;
       }
    }

    //忘记密码
    public function forgetpwd(){
        return view('user.forgetpwd');
    }
    //忘记密码
    public function getpwdcode(Request $request){
        $email=$request->u_email;

        $address = "http://dong.wdxwq.top/user/findpwd";
        Mail::raw("找回密码地址".$address, function($message)use($email)
        {
//            dd($code1);die;
            $res=$message->to($email)->subject('找回密码');

        });
    }
    //修改密码
    public function findpwd(){
        return view('user.findpwd');
    }
    //找回密码
    public function findpwddo(Request $request){
        $name=$request->name;
        $u_pwd=$request->u_pwd;
        $pwds=md5($u_pwd);
        $res=UserModel::where('u_email','=',$name)->first();
        $res2=UserModel::where('u_name','=',$name)->first();
        if(!$res=="" || $res2==""){
            echo 3;exit;
        }
        $arr=UserModel::where('u_email','=',$name)->update(['u_pwd'=>$pwds]);
        $arr2=UserModel::where('u_name','=',$name)->update(['u_pwd'=>$pwds]);
        if($arr || $arr2){
            echo 1;
        }else{
            echo 2;exit;
        }
    }

}