@extends('admin/layouts/admin')
@section('title','课时列表')
@section('content')
    <link rel="stylesheet" href="{{asset('css/page.css')}}">
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="200">
            <col>
        </colgroup>

        @if($period != null)
            <thead>
            <tr>
                <th>编号</th>
                <th>课时名称</th>
                <th>课时内容</th>
                <th>视频</th>
                <th>直播</th>
                <th>课时状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($period as $k => $v)
                <tr period_id={{$v['period_id']}}>
                    <td>{{$v['period_id']}}</td>
                    <td>{{$v['period_name']}}</td>
                    <td>{{$v['period_desc']}}</td>
                    <td>
                        <video src="/{{$v['period_video']}}"></video></td>
                    <th></th>
                    <td>
                        @if($v['p_audit']==1)
                            审核中
                        @elseif($v['p_audit']==2)
                            授课中
                        @else
                            审核失败
                        @endif
                    </td>
                    <td>
                        @if($v['p_audit']==1)
                            <button class="layui-btn layui-btn-xs ok">审核通过</button>
                            <button class="layui-btn layui-btn-xs no">审核不通过</button>
                        @endif
                        <button class="layui-btn layui-btn-xs del">删除</button>
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
            //审核通过
            $('.ok').click(function() {
                var period_id = $(this).parents('tr').attr('period_id');

                $.post(
                    "/admin/periodcheckok",
                    {period_id:period_id},
                    function(msg){
                        layer.msg(msg.msg,{icon:msg.code,time:1000},function(){
                            if (msg.code == 6) {
                                history.go(0);
                            }
                        });
                    },
                    'json'
                );
            });

            //审核不通过
            $('.no').click(function(){
                var period_id = $(this).parents('tr').attr('period_id');
                location.href="/admin/periodcheckno?period_id="+period_id;
            });

            //锁定
            $('.del').click(function () {
                var period_id = $(this).parents('tr').attr('period_id');
                $.post(
                    "/admin/periodcheckdel",
                    {period_id:period_id},
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