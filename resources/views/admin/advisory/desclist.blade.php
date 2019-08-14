@extends('admin/layouts/admin')
@section('title','资讯内容列表')
@section('content')
    <link rel="stylesheet" href="{{asset('css/page.css')}}">
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="200">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>编号</th>
            <th>资讯标题名称</th>
            <th>资讯分类名称</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @if($advisory_info != '')
            @foreach($advisory_info as $k => $v)
                <tr a_id={{$v['a_id']}}>
                    <td>{{$v['a_id']}}</td>
                    <td>{{$v['a_name']}}</td>
                    <td>{{$v['a_cate_name']}}</td>
                    <td>
                        <button class="layui-btn layui-btn-xs edit">编辑</button>
                        <button class="layui-btn layui-btn-xs del">删除</button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <script>
        layui.use('layer',function(){
            //删除
            $('.del').click(function() {
                var a_id = $(this).parents('tr').attr('a_id');
                var btn = $(this);
                $.post(
                    "/admin/advisory/descdel",
                    {a_id:a_id},
                    function(msg){
                        if (msg.code == 6) {
                            layer.msg(msg.msg,{icon:6,time:1000},function(){
                                btn.parents('tr').remove();
                            });
                        } else{
                            layer.msg(msg.msg,{icon:5,time:1000});
                        }
                    },
                    'json'
                );
            });

            //编辑
            $('.edit').click(function(){
                var a_id = $(this).parents('tr').attr('a_id');
                location.href="/admin/advisory/descedit?a_id="+a_id;
            });
        });
    </script>
@endsection