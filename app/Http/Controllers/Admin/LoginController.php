<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AdminModel;

class LoginController extends Controller
{
    //登陆
    public function adminLogin( Request $request )
    {
        if( $request -> isMethod('post')){
            $data = $request -> post();
            //dd($data);
            $adming_info = AdminModel::where(['admin_name'=>$data['admin_name']])->first();
            if( empty($adming_info) ){
                return [
                    'msg'=>'账号密码不匹配',
                    'code'=>5
                ];
            }else{
                $adming_info = collect($adming_info)->toArray();
                if( $adming_info['admin_pwd'] == md5($data['admin_pwd']) ){
                    $session_info = [
                        'session_admin_name'=>$adming_info['admin_name'],
                        'session_admin_pwd'=>$adming_info['admin_pwd']
                    ];
                    $request -> session()-> put('session_admin_info',$session_info);
                    return [
                        'msg'=>'登陆成功',
                        'code'=>6
                    ];
                }else{
                    return [
                        'msg'=>'账号密码不匹配',
                        'code'=>5
                    ];
                }
            }

        }else{
            return view('admin/login/login');
        }
    }

    //退出
    public function adminLogout( Request $request )
    {
        $request -> session() -> put('session_admin_info',null);
        return [
            'msg'=>'退出成功',
            'code' => 6
        ];
    }

    public function test()
    {
//        $data = session('session_admin_info');
//        dd($data);
    }
}
