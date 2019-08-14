<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>问答</title>
    <link rel="stylesheet" type="text/css" href="/css/css.css"/>
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
</head>

<body>
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="/img/coin02.png"/><span>&nbsp;&nbsp;&nbsp;&nbsp;问答</span>
        </div>
    </div>

    <div class="page">
        <!-- banner页面样式 -->
        <div class="connoisseur">
            <!-- banner 表格 显示 -->
            <div class="conShow">
                <table border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="260px" class="tdColor">问题</td>
                        <td width="275px" class="tdColor">提问用户</td>
                        <td width="275px" class="tdColor">被提问教师</td>
                        <td width="290px" class="tdColor">我的回答</td>
                        <td width="130px" class="tdColor">操作</td>
                    </tr>
                    @foreach($arr as $k=>$v)
                        <tr>
                            <td>{{$v->l_contents}}</td>
                            <td>

                            </td>
                        </tr>
                    @endforeach
                </table>
                {{--<div class="paging">{{$arr->links()}}</div>--}}
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
            var son_id = _this.attr('son_id');
            data.son_id = son_id;
            var url = '/teacher/sondel';
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