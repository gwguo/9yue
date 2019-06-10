<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Model\UserModel;
use Illuminate\Support\Facades\Redis;
class UserController extends Controller
{
    public function adddo(){
//        phpinfo();die;
        $data = [
            'username'=>'zhangsan',
            'pwd'=>'123'
        ];
        $data = '123';
        Redis::set('abc',$data);
        $data = Redis::get('abc');
        dd($data);
        $uid = UserModel::insertGetId($data);
        dd($uid);
    }
}
