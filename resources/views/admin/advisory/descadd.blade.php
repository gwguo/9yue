@extends('admin/layouts/admin')
@section('title','资讯分类')
@section('content')
    <script src="/admin/ueditor/ueditor.config.js"></script>
    <script src="/admin/ueditor/ueditor.all.min.js"></script>
    <script src="/admin/ueditor/lang/zh-cn/zh-cn.js"></script>
    <form class="layui-form layui-form-pane" action="" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label class="layui-form-label">资讯标题</label>
            <div class="layui-input-inline">
                <input type="text" name="a_name" required  lay-verify="required" placeholder="请输入资讯标题" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">资讯内容</label>
            <div class="layui-input-inline">
                <script id="editor" type="text/plain" name="a_desc"></script>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">资讯分类</label>
            <div class="layui-input-inline">
                <select name="a_cate_id" lay-verify="required">
                    @foreach($a_cate_info as $k => $v)
                        <option value="{{$v['a_cate_id']}}">{{$v['a_cate_name']}}</option>
                    @endforeach
                </select>
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
        var ue=UE.getEditor('editor',{
            initialFrameWidth:600,
            initialFrameHeight:320,
            toolbars: [[
                'fullscreen', 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                'customstyle', 'paragraph', 'fontfamily', 'fontsize']]
        });
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
                                location.href="/admin/advisory/catelist";
                            }
                        });
                    }
                );
                return false;
            });
        });
    </script>
@endsection