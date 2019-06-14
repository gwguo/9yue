<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
=======
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
>>>>>>> f0234eba5725fde00f24caff7be491e39776bf8e
}
