@extends('admin/layouts/admin')
@section('title','管理员列表')
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
        <th>管理员昵称</th>
        <th>管理员状态</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($admin_user as $k => $v)
        <tr admin_id={{$v['admin_id']}}>
            <td>{{$v['admin_id']}}</td>
            <td>{{$v['admin_name']}}</td>
            <td>使用中</td>
            <td>
                <button class="layui-btn layui-btn-xs edit">编辑</button>
                <button class="layui-btn layui-btn-xs del">删除</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
    layui.use('layer',function(){
        //删除
        $('.del').click(function() {
            var admin_id = $(this).parents('tr').attr('admin_id');
            var btn = $(this);
            $.post(
                "/admin/adminuserdel",
                {admin_id:admin_id},
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
            var admin_id = $(this).parents('tr').attr('admin_id');
            location.href="/admin/adminedit?admin_id="+admin_id;
        });



    });
</script>
@endsection