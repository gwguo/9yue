<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\IndexUserModel;

class IndexUserController extends Controller
{
    //用户列表
    public function suserlist()
    {
        $userInfo = IndexUserModel::get()->toArray();
        return view('admin/index/userlist',['userInfo'=>$userInfo]);
    }

    //用户锁定
    public function suserdel( Request $request )
    {
        $u_id = $request->post('u_id');
        $res = IndexUserModel::where(['u_id'=>$u_id])->update(['u_status'=>2]);
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
