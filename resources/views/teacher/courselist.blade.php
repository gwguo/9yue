<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>课程展示</title>
    <link rel="stylesheet" type="text/css" href="/css/css.css"/>
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
</head>

<body>
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="/img/coin02.png"/><span>&nbsp;&nbsp;&nbsp;&nbsp;课程展示</span>
        </div>
    </div>

    <div class="page">
        <!-- banner页面样式 -->
        <div class="connoisseur">
            <!-- banner 表格 显示 -->
            <div class="conShow">
                <table border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="66px" class="tdColor tdC">课程id</td>
                        <td width="260px" class="tdColor">所属分类</td>
                        <td width="260px" class="tdColor">课程名称</td>
                        <td width="275px" class="tdColor">是否收费</td>
                        <td width="275px" class="tdColor">课程价格</td>
                        <td width="275px" class="tdColor">课程介绍</td>
                        <td width="290px" class="tdColor">课时数量</td>
                        <td width="290px" class="tdColor">课程类型</td>
                        <td width="290px" class="tdColor">添加时间</td>
                        <td width="290px" class="tdColor">添加教师</td>
                        <td width="130px" class="tdColor">审核状态</td>
                        <td width="130px" class="tdColor">操作</td>
                    </tr>
                    @foreach($arr as $k=>$v)
                        <tr>
                            <td>{{$v->c_id}}</td>
                            <td>{{$v->course_name}}</td>
                            <td>{{$v->c_name}}</td>
                            @if($v->free==0)
                                <td>免费</td>
                            @elseif($v->free==1)
                                <td>付费</td>
                            @endif
                            <td>{{$v->c_price}}</td>
                            <td>{{$v->c_notice}}</td>
                            <td>{{$v->period_num}}</td>
                            @if($v->excellent_course==0)
                                <td>普通</td>
                            @elseif($v->excellent_course==1)
                                <td>精品</td>
                            @endif
                            <td>{{date('Y-m-d H:i:s',$v->c_time)}}</td>
                            <td>{{$data->t_name}}</td>
                            @if($v->audit==1)
                                <td>未审核</td>
                            @elseif($v->audit==0)
                                <td>审核通过</td>
                            @elseif($v->audit==2)
                                <td>审核不通过</td>
                            @endif
                            <td>
                                <a href="/teacher/courseup?id={{$v->c_id}}">
                                    <img class="operation" src="/img/update.png">
                                </a>
                                <img class="operation delban" src="/img/delete.png" id="{{$v->c_id}}">
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="paging">{{$arr->links()}}</div>
            </div>
            <!-- banner 表格 显示 end-->
        </div>
        <!-- banner页面样式end -->
    </div>

</div>
</body>
</html>
<script>
    $(document).ready(function () {
        $('.delban').click(function () {
            var data = {};
            var _this = $(this);
            var id = _this.attr('id');
            data.id = id;
            var url = '/teacher/coursedel';
            $.ajax({
                type: 'post',
                data: data,
                url: url,
                dataType: 'json',
                success: function (msg) {
                    if (msg.code == 1) {
                        alert(msg.msg);
                        window.location.reload();
                    } else if (msg.code == 0) {
                        alert(msg.msg);
                    }
                }
            });
        });
    });
</script>