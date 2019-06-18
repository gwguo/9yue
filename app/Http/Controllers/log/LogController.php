<?php

namespace App\Http\Controllers\log;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

use App\Model\UserModel;
class LogController extends Controller
{
    public function redisC(){
        $a = 'abc';
        Redis::set('a',$a);
        $c = Redis::get('a');
        echo $c;
    }
    public function reg(Request $request){
        $data = $request->input();
        unset($data['password_confirm']);
        $uid = UserModel::insertGetId($data);
        if($uid){
            echo json_encode(['font'=>'注册成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'注册失败','code'=>2]);
        }
    }
    //登录
    public function login(Request $request){
        $account = $request->account;
        $pwd = $request->password;
        $user = UserModel::where('account',$account)->first();
        if ($user){
            if ($pwd=$user->password){
                echo json_encode(['font'=>'登录成功','code'=>1]);
            }else{
                echo json_encode(['font'=>'登录失败','code'=>2]);
            }
        }else{
            echo '登录失败';
        }
    }
    //修改密码
    public function password(Request $request){
        $username = $request->username;
        $pwd1 = $request->pwd;//原密码
        $pwd2 = $request->pwd;//新密码
        $pwd = $request->pwd;//确认新密码
        if ($pwd2!=$pwd){
            echo '新密码不一致';
        }
        $user = UserModel::where('username',$username)->first();
        if ($user){
            $res = UserModel::where('username',$username)->update(['pwd'=>$pwd]);
            dd($res);
        }else{
            echo '没有此用户';
        }
    }
}
