@extends('admin/layouts/admin')
@section('title','课程分类修改')
@section('content')
    <form class="layui-form layui-form-pane" action="" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">课程分类</label>
            <div class="layui-input-inline">
                <input type="text" name="course_name" value="{{$course_name}}" required  lay-verify="required" placeholder="请输入课程分类" autocomplete="off" class="layui-input">
                <input type="hidden" name="course_id" value="{{$course_id}}">
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
        layui.use(['form','layer'], function(){
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
                                location.href="/admin/coursecatelist";
                            }
                        });
                    }
                );
                return false;
            });
        });
    </script>
@endsection