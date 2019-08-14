<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>新密码</title>
    <link rel="stylesheet" type="text/css" href="/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="/css/page.css"/>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/public.js"></script>
</head>
<body>

<!-- 登录页面头部 -->
<div class="logHead">
    <img src="/img/logLOGO.png"/>
</div>
<!-- 登录页面头部结束 -->

<!-- 登录body -->
<div class="logDiv">
    <img class="logBanner" src="/img/logBanner.png"/>
    <div class="logGet">
        <!-- 头部提示信息 -->
        <div class="logD logDtip">
            <p class="p1">新密码</p>
        </div>
        <!-- 输入框 -->
        <div class="lgD">
            <img class="img1" src="/img/logName.png"/><input type="password"
                                                             placeholder="请输入新的密码" name="pwd"/>
        </div>
        <div class="lgD">
            <img class="img1" src="/img/logName.png"/><input type="password"
                                                             placeholder="请再次确认新的密码" name="pwd2"/>
        </div>
        <div class="logC">
            <button id="btns">确 定</button>
        </div>
    </div>
</div>
<!-- 登录body  end -->

<!-- 登录页面底部 -->
<div class="logFoot">
    <p class="p1">版权所有：南京设易网络科技有限公司</p>
    <p class="p2">南京设易网络科技有限公司 登记序号：苏ICP备11003578号-2</p>
</div>
<!-- 登录页面底部end -->
</body>
</html>
<script>
    $(function () {
        $('#btns').click(function () {
            var pwd = $("input[name='pwd']").val();
            var pwd2 = $("input[name='pwd2']").val();
            if (pwd == '') {
                alert('新的密码不能为空');
                return false;
            }
            if (pwd2 == '') {
                alert('确定新的密码不能为空');
                return false;
            }
            $.ajax({
                type: 'post',
                data: {pwd: pwd, pwd2: pwd2},
                url: '/teacher/newpwds',
                dataType: 'json',
                success: function (msg) {
                    if (msg.code == 1) {
                        alert(msg.msg);
                        window.top.location.href = "/teacher/login";
                    } else {
                        alert(msg.msg);
                    }
                }
            });
        });
    });
</script>