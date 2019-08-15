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

        @if($section != null)
            <thead>
            <tr>
                <th>编号</th>
                <th>章节名称</th>
                <th>章节内容</th>
                <th>章节所属课程</th>
                <th>章节状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($section as $k => $v)
                <tr section_id={{$v['section_id']}}>
                    <td>{{$v['section_id']}}</td>
                    <td>{{$v['section_name']}}</td>
                    <td>{{$v['section_desc']}}</td>
                    <td>{{$v['c_name']}}</td>
                    <td>
                        @if($v['c_audit']==1)
                            审核中
                        @elseif($v['c_audit']==2)
                            授课中
                        @else
                            审核失败
                        @endif
                    </td>
                    <td>
                        @if($v['c_audit']==1)
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
                var section_id = $(this).parents('tr').attr('section_id');

                $.post(
                    "/admin/sectioncheckok",
                    {section_id:section_id},
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
                var section_id = $(this).parents('tr').attr('section_id');
                location.href="/admin/sectioncheckno?section_id="+section_id;
            });

            //锁定
            $('.del').click(function () {
                var section_id = $(this).parents('tr').attr('section_id');
                $.post(
                    "/admin/sectioncheckdel",
                    {section_id:section_id},
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