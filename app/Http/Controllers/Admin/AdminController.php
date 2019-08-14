<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AdminModel;

class AdminController extends Controller
{
    //后台首页
    public function adminIndex()
    {
//        $checklogin = $this->checkLogin();
//        if(!$checklogin){
//            return redirect('/admin/adminlogin');
//        }
        return view('admin/layouts/admin');
    }

    //管理员添加
    public function adminuseradd( Request $request )
    {
//        $checklogin = $this->checkLogin();
//        if(!$checklogin){
//            return redirect('/admin/adminlogin');
//        }
        if( $request -> isMethod('post')){
            $data = $request->post();
            $admin_name = $data['admin_name'];
            $admin_pwd = $data['admin_pwd'];
            $re_pwd = $data['re_pwd'];
            if(empty($admin_name)){
                return [
                    'msg'=>'管理员昵称不能为空',
                    'code'=> 5
                ];
            }
            if(empty($admin_pwd)){
                return [
                    'msg'=>'管理员密码不能为空',
                    'code'=> 5
                ];
            }
            if(empty($re_pwd)){
                return [
                    'msg'=>'重复密码不能为空',
                    'code'=> 5
                ];
            }elseif($admin_pwd != $re_pwd){
                return [
                    'msg'=>'重复密码必须与重复密码一致',
                    'code'=> 5
                ];
            }

            //验证唯一
            $admin_info = AdminModel::where(['admin_name'=>$admin_name,'admin_status'=>1])->first();
            if(!empty($admin_info)){
                return [
                    'msg'=>'用户重复，请更换',
                    'code'=> 5
                ];
            }
            unset($data['re_pwd']);
            $data['admin_pwd'] = md5($data['admin_pwd']);
            $res = AdminModel::insert($data);
            if($res){
                return [
                    'msg'=>'添加管理员成功',
                    'code'=> 6
                ];
            }else{
                return [
                    'msg'=>'添加管理员失败',
                    'code'=> 5
                ];
            }
        }else{
            return view('admin/adminuser/useradd');
        }
    }

    //管理员列表
    public function adminuserlist()
    {
//        $checklogin = $this->checkLogin();
//        if(!$checklogin){
//            return redirect('/admin/adminlogin');
//        }
        $admin_user = AdminModel::where(['admin_status'=>1])->get()->toArray();
        return view('admin/adminuser/userlist',['admin_user'=>$admin_user]);
    }

    //管理员删除
    public function adminuserdel( Request $request )
    {
//        $checklogin = $this->checkLogin();
//        if(!$checklogin){
//            return redirect('/admin/adminlogin');
//        }
        $admin_id = $request->post('admin_id');
        $res = AdminModel::where(['admin_id'=>$admin_id])->update(['admin_status'=>2]);
        if( $res ){
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

    //管理员修改
    public function adminedit( Request $request )
    {
        if($request->isMethod('post')){
            $data = $request->post();
            $admin_id = $data['admin_id'];
            $admin_name = $data['admin_name'];
            $admin_pwd = $data['admin_pwd'];
            if(empty($admin_name)){
                return [
                    'msg'=>'管理员昵称不能为空',
                    'code'=> 5
                ];
            }
            if(empty($admin_pwd)){
                return [
                    'msg'=>'管理员密码不能为空',
                    'code'=> 5
                ];
            }
            $where = [
                ['admin_id','!=',$admin_id],
                ['admin_name','=',$admin_name],
                ['admin_status','=',1]
            ];
            $admin_info = AdminModel::where($where)->first();
            if(!empty($admin_info)){
                return [
                    'msg'=>'用户重复，请更换',
                    'code'=> 5
                ];
            }
            $res = AdminModel::where(['admin_id'=>$admin_id])->update($data);
            if($res){
                return [
                    'msg'=>'修改管理员成功',
                    'code'=> 6
                ];
            }else{
                return [
                    'msg'=>'修改管理员失败',
                    'code'=> 5
                ];
            }

        }else{
            $admin_id = $request->post('admin_id');
            $admin_user_info = AdminModel::where(['admin_id'=>$admin_id])->first();
            return view('admin/adminuser/useredit',['admin_user_info'=>$admin_user_info]);
        }
    }

    //判断登陆状态
    public function checkLogin()
    {
        $session_admin_info = session('session_admin_info');
        if( empty($session_admin_info)){
            return false;
        }else{
            return true;
        }
    }
}
