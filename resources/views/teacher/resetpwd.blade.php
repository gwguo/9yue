<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>修改密码</title>
    <link rel="stylesheet" type="text/css" href="/css/css.css"/>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
</head>
<body>
<div id="pageAll">
    <div class="page ">
        <!-- 上传广告页面样式 -->
        <div class="banneradd bor">
            <div class="baTop">
                <span>修改密码</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    原密码：<input type="password" name="t_pwd" class="input1"/>
                </div>
                <div class="bbD">
                    新密码：<input type="password" name="pwd" class="input1"/>
                </div>
                <div class="bbD">
                    新密码：<input type="password" name="pwd2" class="input1"/>
                </div>
                <div class="bbD">
                    <p class="bbDP">
                        <button class="btn_ok btn_yes" href="#" id="sub">提交</button>
                        <a class="btn_ok btn_no">取消</a>
                    </p>
                </div>
            </div>
        </div>
        <!-- 上传广告页面样式end -->
    </div>
</div>
</body>
</html>
<script src="/js/jquery.js"></script>
<script>
    $(function () {
        $('#sub').click(function () {
            var t_pwd = $("input[name='t_pwd']").val();
            var pwd = $("input[name='pwd']").val();
            var pwd2 = $("input[name='pwd2']").val();
            if (t_pwd == '') {
                alert('原密码不能为空');
                return false;
            }
            if (pwd == '') {
                alert('新密码不能为空');
                return false;
            }
            if (pwd2 == '') {
                alert('确认新密码不能为空');
                return false;
            }
            $.ajax({
                type: 'post',
                data: {t_pwd: t_pwd, pwd: pwd, pwd2: pwd2},
                url: '/teacher/resetpwds',
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
        $('.btn_no').click(function () {
            window.top.location.href = "/teacher/index";
        });
    });
</script>