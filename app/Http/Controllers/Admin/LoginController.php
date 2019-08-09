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
                if( $adming_info['admin_pwd'] == $data['admin_pwd']){
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
}
