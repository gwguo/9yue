@extends('admin/layouts/admin')
@section('title','课时审核不通过原因')
@section('content')
    <form class="layui-form layui-form-pane" action="" enctype="multipart/form-data">
        <input type="hidden" name="period_id" value="{{$period_id}}">
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">审核不通过原因</label>
            <div class="layui-input-block">
                <textarea name="p_audit_reason" placeholder="请输入未通过原因" class="layui-textarea"></textarea>
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
                                location.href="/admin/teacher/periodlist";
                            }
                        });
                    }
                );
                return false;
            });
        });
    </script>
@endsection