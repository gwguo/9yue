@extends('admin/layouts/admin')
@section('title','用户列表')
@section('content')
    <link rel="stylesheet" href="{{asset('css/page.css')}}">
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="200">
            <col>
        </colgroup>

        @if($userInfo != null)
            <thead>
            <tr>
                <th>编号</th>
                <th>用户名</th>
                <th>用户邮箱</th>
                <th>用户头像</th>
                <th>用户状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($userInfo as $k => $v)
                <tr u_id={{$v['u_id']}}>
                    <td>{{$v['u_id']}}</td>
                    <td>{{$v['u_name']}}</td>
                    <td>{{$v['u_email']}}</td>
                    <td>{{$v['u_img']}}</td>
                    <td>
                        @if($v['u_status']==1)
                            学习中
                        @else
                            已锁定
                        @endif
                    </td>
                    <td>
                        @if($v['u_status']==1)
                            <button class="layui-btn layui-btn-xs del">锁定</button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        @else
            <h1 style="color: #0f9d58"><b>暂无课程上线</b></h1>
        @endif

    </table>
    <script>
        layui.use('layer',function(){
            //锁定
            $('.del').click(function () {
                var u_id = $(this).parents('tr').attr('u_id');
                $.post(
                    "/admin/index/suserdel",
                    {u_id:u_id},
                    function(msg){
                        layer.msg(msg.msg,{icon:msg.code,time:1000},function(){
                            if (msg.code == 6) {
                                history.go(0);
                            }
                        });
                    },
                    'json'
                );
            })


        });
    </script>
@endsection