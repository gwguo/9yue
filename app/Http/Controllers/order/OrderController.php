<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller{

    //提交订单
    public function order(){
        //获取用户信息 $user_id= Cache::get('u_id');
        $user_id =1;

        $name= request()->name;
        $tel= request()->tel;
        $city= request()->city;
        $detail= request()->detail;
        $price= request()->price;


        //获取课程id
        $cid= request()->cid;

        //开启事务
        DB::beginTransaction();

        //捕获异常
        try{

            //获取订单号
            $orderno=$this->getOrderNo();
            $now=time();
           //订单表
            $order=DB::table('course_order')->insertGetId(
                [
                    'order_no'=>$orderno,
                    'order_price'=>$price,
                    'c_id'=>$cid,
                    'u_id'=>$user_id,
                    'c_time'=>$now
                ]
            );
            if(!$order){
                 throw new \Exception('订单写入失败');
            }
            $order_id=$order;



            //查询商品表
            $c_img=DB::table('course')->where('c_id',$cid)->value('c_img');
            $c_name=DB::table('course')->where('c_id',$cid)->value('c_name');

            //写入详情表   名字  图片    订单id  用户id
            $order_detail=DB::table('order_detail')->insertGetId(['c_name'=>$c_name,'c_img'=>$c_img,'order_id'=>$order_id,'c_price'=>$price,'c_id'=>$cid,'u_id'=>$user_id]);
            if(!$order_detail){
                throw new \Exception('订单详情写入失败');
            }


            //收获地址表
            $address= DB::table('order_address')->insertGetId(['a_name'=>$name,'a_tel'=>$tel,'a_detail'=>$detail,'city'=>$city,'order_id'=>$order_id,'u_id'=>$user_id]);
            if(!$address){
               throw new \Exception('订单地址写入失败');
            }

            //下单成功
            DB::commit();
            echo('success');
        }catch(\Exception $e){
            DB::rollBack();
            no($e->getMessage());

        }
//        echo("<script>alert('下单成功'),location.href='/information/information'</script>");


    }

    //获取订单号
    public function getOrderNo(){
        //规则年月日时分秒  +加用户id  +  四位随即数
        return time().rand('1111','9999');
    }

}