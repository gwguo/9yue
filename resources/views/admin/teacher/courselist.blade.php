@extends('admin/layouts/admin')
@section('title','课程列表')
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
            <th>课程名称</th>
            <th>课程所属分类</th>
            <th>课程价格</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @if($course != '')
            @foreach($course as $k => $v)
                <tr c_id={{$v['c_id']}}>
                    <td>{{$v['c_id']}}</td>
                    <td>{{$v['c_name']}}</td>
                    <td>{{$v['course_name']}}</td>
                    <td>{{$v['c_price']}}</td>
                    <td>
                        @if($v['audit']==2)
                            <button class="layui-btn layui-btn-xs ok">审核通过</button>
                            <button class="layui-btn layui-btn-xs no">审核不通过</button>
                        @else
                            授课中
                        @endif
                            <button class="layui-btn layui-btn-xs del">锁定</button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <script>
        layui.use('layer',function(){
            //审核通过
            $('.ok').click(function() {
                var t_id = $(this).parents('tr').attr('t_id');

                $.post(
                    "/admin/teachercheckok",
                    {t_id:t_id},
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
                var t_id = $(this).parents('tr').attr('t_id');
                location.href="/admin/teachercheckno?t_id="+t_id;
            });

            //锁定


        });
    </script>
@endsection