<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>教师登录</title>
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
            <p class="p1">教师登录</p>
        </div>
        <!-- 输入框 -->
        <div class="lgD">
            <img class="img1" src="/img/logName.png"/><input type="text"
                                                             placeholder="请输入用户名" name="t_name"/>
        </div>
        <div class="lgD">
            <img class="img1" src="/img/logPwd.png"/><input type="password"
                                                            placeholder="请输入用户密码" name="t_pwd"/>
        </div>
        <div class="logC">
            <button id="btn">登 录</button>
        </div>
        <div class="logC">
            <a id="btns">还没有账号，去注册？</a><br>
            <a id="btnss">忘记密码，去找回？</a>
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
        $('#btn').click(function () {
            var t_name = $("input[name='t_name']").val();
            var t_pwd = $("input[name='t_pwd']").val();
            if (t_name == '') {
                alert('教师名称不能为空');
                return false;
            }
            if (t_pwd == '') {
                alert('密码不能为空');
                return false;
            }
            $.ajax({
                type: 'post',
                data: {t_name: t_name, t_pwd: t_pwd},
                url: '/teacher/logindo',
                dataType: 'json',
                success: function (msg) {
                    if (msg.code == 1) {
                        alert(msg.msg);
                        window.top.location.href = "/teacher/index";
                    } else {
                        alert(msg.msg);
                    }
                }
            });
        });
        $('#btns').click(function () {
            window.top.location.href = "/teacher/reg";
        });
        $('#btnss').click(function () {
            window.top.location.href = "/teacher/forgetpwd";
        });
    });
</script>