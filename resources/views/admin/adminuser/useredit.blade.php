@extends('admin/layouts/admin')
@section('title','管理员信息修改')
@section('content')
    <form class="layui-form layui-form-pane" action="" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">管理员昵称</label>
            <div class="layui-input-inline">
                <input type="text" name="admin_name" required  lay-verify="required" placeholder="请输入管理员昵称" autocomplete="off" class="layui-input" value="{{$admin_user_info->admin_name}}">
                <input type="hidden" name="admin_id" value="{{$admin_user_info->admin_id}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-inline">
                <input type="password" name="admin_pwd" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input" value="{{$admin_user_info->admin_pwd}}">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

    <script>
        //加载模块
        layui.use(['form','upload','layer'], function(){
            var form = layui.form;
            var layer = layui.layer;

            //监听提交
            form.on('submit(formDemo)', function(data){
                // alert(11);
                $.post(
                    "",
                    data.field,
                    function(msg) {
                        layer.msg(msg.msg,{icon:msg.code,time:2000},function() {
                            if (msg.code == 6) {
                                location.href="/admin/adminuserlist";
                            }
                        });
                    }
                );
                return false;
            });
        });
    </script>
@endsection