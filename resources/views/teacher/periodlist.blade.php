<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>课时展示</title>
    <link rel="stylesheet" type="text/css" href="/css/css.css"/>
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
</head>

<body>
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="/img/coin02.png"/><span>&nbsp;&nbsp;&nbsp;&nbsp;课时展示</span>
        </div>
    </div>

    <div class="page">
        <!-- banner页面样式 -->
        <div class="connoisseur">
            <!-- banner 表格 显示 -->
            <div class="conShow">
                <table border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="66px" class="tdColor tdC">课时id</td>
                        <td width="260px" class="tdColor">课时名称</td>
                        <td width="275px" class="tdColor">课时介绍</td>
                        <td width="275px" class="tdColor">所属小节</td>
                        <td width="275px" class="tdColor">课时视频</td>
                        <td width="290px" class="tdColor">添加时间</td>
                        <td width="290px" class="tdColor">添加教师</td>
                        <td width="130px" class="tdColor">审核状态</td>
                        <td width="130px" class="tdColor">操作</td>
                    </tr>
                    @foreach($data as $k=>$v)
                        <tr>
                            <td>{{$v->period_id}}</td>
                            <td>{{$v->period_name}}</td>
                            <td>{{$v->period_desc}}</td>
                            <td>{{$v->son_name}}</td>
                            <td>
                                <video controls width=300 height="170" src="{{asset($v->period_video)}}"></video>
                            </td>
                            <td>{{date('Y-m-d H:i:s',$v->c_time)}}</td>
                            <td>{{$arr->t_name}}</td>
                            @if($v->status==1)
                                <td>未审核</td>
                            @elseif($v->status==0)
                                <td>审核通过</td>
                            @elseif($v->status==2)
                                <td>审核不通过</td>
                            @endif
                            <td>
                                <a href="/teacher/periodup?period_id={{$v->period_id}}">
                                    <img class="operation" src="/img/update.png">
                                </a>
                                <img class="operation delban" src="/img/delete.png" period_id="{{$v->period_id}}">
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="paging">{{$data->links()}}</div>
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
            var period_id = _this.attr('period_id');
            data.period_id = period_id;
            var url = '/teacher/perioddel';
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