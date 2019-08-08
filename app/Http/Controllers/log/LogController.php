<?php

namespace App\Http\Controllers\log;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

use App\Model\UserModel;
use App\Model\sendEmail;
class LogController extends Controller
{
    //注册
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
                $str =  str_random(10);                                  //随机字符串
                $token = $user['id'].$str;                          //token值
                $redis_token_key = 'token_'.$user['id'];  //token键名
                //将token存入Redis
                Redis::set($redis_token_key,$token);
                //token过期时间为1周
                Redis::expire($redis_token_key,60*60*24*7);
                echo json_encode(['font'=>'登录成功','code'=>1,'data'=>$user->id,'token'=>$token]);
            }else{
                echo json_encode(['font'=>'登录失败','code'=>2]);
            }
        }else{
            echo '登录失败';
        }
    }
    //个人中心
    public function index(Request $request){
        $token1 = $request->token;
        $uid = $request->uid;
        $token = Redis::get('token_'.$uid);//获取token
        $num = Redis::incr('num');//设置进入页面的次数  防刷页面
        if ($num>50){
            //如果用户一直刷新50次  设置$num过期时间为5分钟清零
            Redis::expire('num',300);
            echo json_encode(['code'=>3,'font'=>'非法登录']);
            die;
        }
        //当用户进入页面  防刷数量过2分钟清零
        Redis::expire('num',120);
        //判断token是否一致
        if ($token==$token1){
            $user = UserModel::where('id',$uid)->first();
            if ($user){
                //返回数据 
                echo json_encode([
                    'code'=>1,
                    'account'=>$user->account,
                    'email'=>$user->email,
                ]);
            }else{
                echo json_encode(['code'=>3]);
            }
        }else{
            echo json_encode(['code'=>2]);
        }
    }
    //修改密码
    public function password(Request $request){
        $email = $request->email;
        $pwd1 = $request->password;//新密码
        $pwd2 = $request->password_confirm;//确认新密码
        if ($pwd1!=$pwd2){
            echo json_encode(['code'=>2,'font'=>'新密码不一致']);
            die;
        }
        $user = UserModel::where('email',$email)->first();
        if ($user){
            $res = UserModel::where('email',$email)->update(['password'=>$pwd1]);
            if ($res){
                echo json_encode(['code'=>1,'font'=>'成功']);
            }else{
                echo json_encode(['code'=>2,'font'=>'修改密码失败']);
            }
        }else{
            echo json_encode(['code'=>2,'font'=>'邮箱错误']);
        }
    }
    //找回密码
    public function sendEmail(Request $request){
        $email = $request->email;
        $user = UserModel::where('email',$email)->first();
        if($user){
            $sendEmail = sendEmail::where('send_email',$email)->first();
            if($sendEmail){
                $update = [
                    'status'=>1
                ];
                sendEmail::where('send_email',$email)->update($update);
            }else{
                $data = [
                    'send_email'=>$email,
                    'add_time'=>time(),
                    'status'=>1
                ];
                sendEmail::insertGetId($data);
            }
            echo json_encode(['code'=>1,'font'=>'邮箱以发送，请耐心']);
        }else{
            echo json_encode(['code'=>2,'font'=>'错误邮箱']);
        }
    }
    //判断验证码
    public function code(){
        $code = request()->input('code');
        if (!$code){
            echo json_encode(['code'=>2,'font'=>'请填写验证码']);
            exit;
        }
        $email = request()->email;
        $zym = Redis::get('yzm_'.$email);
        if ($code == $zym){
            echo json_encode(['code'=>1,'font'=>'正确']);
        }else{
            echo json_encode(['code'=>2,'font'=>'验证码错误']);
        }
    }
}
