<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>找回密码</title>
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
            <p class="p1">找回密码</p>
        </div>
        <!-- 输入框 -->
        <div class="lgD">
            <img class="img1" src="/img/logName.png"/><input type="text"
                                                             placeholder="请输入已有的用户名" name="t_name"/>
        </div>
        <div class="lgD">
            <img class="img1" src="/img/logPwd.png"/><input style="width: 250px;" type="email"
                                                            placeholder="请输入该用户名绑定的邮箱" name="email"/>
            <button id="btn" style="height: 45px">发送</button>
        </div>
        <div class="lgD">
            <img class="img1" src="/img/logPwd.png"/><input type="text"
                                                            placeholder="请输入验证码" name="code"/>
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
        $('#btn').click(function () {
            var email = $("input[name='email']").val();
            if (email == '') {
                alert('已绑定的邮箱不能为空');
                return false;
            }
            $("#btn").html('60s');
            a_time = setInterval(goTime1, 1000);
            $.ajax({
                type: 'post',
                data: {email: email},
                url: '/teacher/email',
                dataType: 'json',
                success: function (msg) {
                    alert('发送成功');
                }
            });
        });
        $('#btns').click(function () {
            var t_name = $("input[name='t_name']").val();
            var email = $("input[name='email']").val();
            var code = $("input[name='code']").val();
            if (t_name == '') {
                alert('已有的教师名称不能为空');
                return false;
            }
            if (email == '') {
                alert('已绑定的邮箱不能为空');
                return false;
            }
            if (code == '') {
                alert('验证码不能为空');
                return false;
            }
            $.ajax({
                type: 'post',
                data: {t_name: t_name, email: email, code: code},
                url: '/teacher/forgetpwds',
                dataType: 'json',
                success: function (msg) {
                    if (msg.code == 1) {
                        alert(msg.msg);
                        window.top.location.href = "/teacher/newpwd";
                    }  else {
                        alert(msg.msg);
                    }
                }
            });
        });

        function goTime1() {
            var second = parseInt($("#btn").html());
            if (second == 0) {
                clearInterval(a_time);
                $("#btn").html('获取');
                $('#btn').css('pointer-events', 'auto');
            } else {
                var new_second = second - 1;
                $('#btn').html(new_second + 's');
                $('#btn').css('pointer-events', 'none');
            }
        }
    });
</script>