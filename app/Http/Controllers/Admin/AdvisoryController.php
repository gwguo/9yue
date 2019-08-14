<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\AdvisoryModel;
use App\Model\Admin\AdvisoryCateModel;

class AdvisoryController extends Controller
{
    //资讯分类
    public function cateadd( Request $request )
    {
        if( $request->isMethod('post')){
            $data = $request->post();
            $res = AdvisoryCateModel::insert($data);
            if($res){
                return [
                    'msg'=>'资讯分类添加成功',
                    'code'=>6
                ];
            }else{
                return [
                    'msg'=>'资讯分类添加失败',
                    'code'=> 5
                ];
            }
        }else{
            return view('admin/advisory/advisorycate');
        }
    }

    //资讯分类列表
   public function catelist( Request $request )
   {
       $cate_info = AdvisoryCateModel::get();
       if(!empty($cate_info)){
           $cate_info = $cate_info->toArray();
       }
       return view('admin/advisory/advisorycatelist',['cate_info'=>$cate_info]);
   }

   //资讯分类删除
    public function catedel( Request $request )
    {
        $a_cate_id = $request->post('a_cate_id');

        $advisory_info = AdvisoryModel::where(['a_cate_id'=>$a_cate_id])->get();
        if(empty($advisory_info)){
            return [
                'msg'=>'该分类下有文章，不可以直接删除该分类',
                'code'=> 5
            ];
        }
        $res = AdvisoryCateModel::where(['a_cate_id'=>$a_cate_id])->update(['status'=>2]);
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

    //资讯分类修改
    public function cateedit( Request $request )
    {
        if( $request->isMethod('post')){
            $data = $request->post();
            $res = AdvisoryCateModel::where(['a_cate_id'=>$data['a_cate_id']])->update(['a_cate_name'=>$data['a_cate_name']]);
            if($res){
                return [
                    'msg'=>'资讯分类修改成功',
                    'code'=>6
                ];
            }else{
                return [
                    'msg'=>'资讯分类修改失败',
                    'code'=> 5
                ];
            }
        }else{
            $a_cate_id = $request->post('a_cate_id');
            $a_cate_name = AdvisoryCateModel::where(['a_cate_id'=>$a_cate_id])->value('a_cate_name');
            //dd($a_cate_name);
            return view('admin/advisory/advisoryedit',['a_cate_id'=>$a_cate_id,'a_cate_name'=>$a_cate_name]);
        }
    }

    //资讯内容添加
    public function descadd( Request $request )
    {
        if( $request->isMethod('post')){
            $data = $request->post();
            $res = AdvisoryModel::insert($data);
            if($res){
                return [
                    'msg'=>'资讯内容添加成功',
                    'code'=>6
                ];
            }else{
                return [
                    'msg'=>'资讯内容添加失败',
                    'code'=> 5
                ];
            }
        }else{
            $a_cate_info = AdvisoryCateModel::get()->toArray();
            return view('admin/advisory/descadd',['a_cate_info'=>$a_cate_info]);
        }
    }

    //资讯内容列表
    public function desclist()
    {
        $advisory_info = AdvisoryModel::join('advisory_cate','advisory_cate.a_cate_id','=','advisory.a_cate_id')->get();
        //dd($advisory_info);
        if(!empty($advisory_info)){
            $advisory_info = $advisory_info->toArray();
        }
        return view('admin/advisory/desclist',['advisory_info'=>$advisory_info]);
    }

    //资讯内容删除
    public function descdel( Request $request )
    {
        $a_id = $request->post('a_id');
        $res = AdvisoryModel::where(['a_id'=>$a_id])->update(['status'=>2]);
        if($res){
            return [
                'msg'=>'资讯分类删除成功',
                'code'=>6
            ];
        }else{
            return [
                'msg'=>'资讯分类删除失败',
                'code'=> 5
            ];
        }
    }

    //资讯内容修改
    public function descedit( Request $request )
    {
        if( $request->isMethod('post')){
            $data = $request->post();
            $res = AdvisoryModel::where(['a_id'=>$data['a_id']])->update($data);
            if($res){
                return [
                    'msg'=>'资讯内容修改成功',
                    'code'=>6
                ];
            }else{
                return [
                    'msg'=>'资讯内容修改失败',
                    'code'=> 5
                ];
            }
        }else{
            $a_id = $request->post('a_id');
            $desc_info = AdvisoryModel::where(['a_id'=>$a_id])->first()->toArray();
            //dd($a_cate_name);
            $a_cate_info = AdvisoryCateModel::get()->toArray();
            return view('admin/advisory/descedit',['a_id'=>$a_id,'desc_info'=>$desc_info,'a_cate_info'=>$a_cate_info]);
        }
    }

}
