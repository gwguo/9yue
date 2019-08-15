@extends('admin/layouts/admin')
@section('title','课程分类列表')
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
            <th>课程分类名称</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @if($coursecate_info != '')
            @foreach($coursecate_info as $k => $v)
                <tr course_id={{$v['course_id']}}>
                    <td>{{$v['course_id']}}</td>
                    <td>{{$v['course_name']}}</td>
                    <td>
                        <button class="layui-btn layui-btn-xs del">删除</button>
                        <button class="layui-btn layui-btn-xs edit">修改</button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <script>
        layui.use('layer',function(){
            //审核通过
            $('.del').click(function() {
                var course_id = $(this).parents('tr').attr('course_id');
                $.post(
                    "/admin/coursecatedel",
                    {course_id:course_id},
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

            //
            $('.edit').click(function(){
                var course_id = $(this).parents('tr').attr('course_id');

                location.href="/admin/coursecateedit?course_id="+course_id;
            });



        });
    </script>
@endsection