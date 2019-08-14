@extends('admin/layouts/admin')
@section('title','教师列表')
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
        <th>教师名称</th>
        <th>教师性别</th>
        <th>教师简介</th>
        <th>教师风格</th>
        <th>教师科目</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @if($teacher_info != '')
        @foreach($teacher_info as $k => $v)
            <tr t_id={{$v['t_id']}}>
                <td>{{$v['t_id']}}</td>
                <td>{{$v['t_name']}}</td>
                <td>{{$v['sex']}}</td>
                <td>{{$v['t_desc']}}</td>
                <td>{{$v['t_style']}}</td>
                <td>{{$v['t_subjects']}}</td>
                <td>
                    @if($v['audit']==2)
                    <button class="layui-btn layui-btn-xs del">审核通过</button>
                    <button class="layui-btn layui-btn-xs edit">审核不通过</button>
                    @else
                        授课中
                    @endif
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
            var t_id = $(this).parents('tr').attr('t_id');
            var btn = $(this);
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
        $('.edit').click(function(){
            var t_id = $(this).parents('tr').attr('t_id');
            location.href="/admin/teachercheckno?t_id="+t_id;
        });



    });
</script>
@endsection