<?php

namespace App\Http\Controllers\send;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use App\Model\sendEmail;
class sendEmailController extends Controller
{
    //发送邮箱
    public function sendEmail(){
        $user = sendEmail::where('status',1)->get();
        if ($user){
            foreach ($user as $v){
                $u_email = $v->send_email;
                $send = mt_rand(100000,999999);
                Mail::send(
                //必须用一视图   作为发送内容
                    'email.sendEmail',
                    //发送的随机数
                    ['content'=>$send],
                    function ($message)use($u_email,$send){
                        //发送邮件和标题
                        $res = $message->to($u_email)->subject('修改密码');
                        if ($res){
                            $update = ['status'=>0,'send_time'=>time()];
                            sendEmail::where('send_email',$u_email)->update($update);
                            Redis::set('yzm_'.$u_email,$send);
                            Redis::expire('yzm'.$u_email,300);
                        }else{
                            echo json_encode(['font'=>'发送失败','code'=>2]);
                        }
                    }
                );
            }
        }
    }
}
