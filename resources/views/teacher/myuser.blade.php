<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>个人信息</title>
    <link rel="stylesheet" type="text/css" href="/css/css.css"/>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
</head>
<body>
<div id="pageAll">
    <div class="page ">
        <!-- 上传广告页面样式 -->
        <div class="banneradd bor">
            <div class="baTop">
                <span>完善个人信息</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    姓名：<input type="text" value="{{$arr->t_name}}" name="t_name" class="input1">
                </div>
                <div class="bbD">
                    邮箱：<input type="text" value="{{$arr->email}}" name="email" class="input1">
                </div>
                <div class="bbD">
                    性别：<input type="radio" name="sex" value="0">男
                    <input type="radio" name="sex" value="1">女
                </div>
                <div class="bbD">
                    年龄：<input type="text" name="age" class="input1"/>
                </div>
                <div class="bbD">
                    所教科目：<input type="text" name="t_subjects" class="input1"/>
                </div>
                <div class="bbD">
                    个人风格：<input type="text" name="t_style" class="input1">
                </div>
                <div class="bbD">
                    个人简介：<textarea name="t_desc" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="bbD">
                    上传头像：
                    <input type="file" name="file" id="file"/>
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
<script src="/js/ajaxfileupload.js"></script>
<script>
    $('#sub').click(function () {
        var data = {};
        data.t_name = $("input[name='t_name']").val();
        data.email = $("input[name='email']").val();
        data.sex = $("input[name='sex']:checked").val();
        data.t_desc = $("textarea[name='t_desc']").val();
        data.t_style = $("input[name='t_style']").val();
        data.age = $("input[name='age']").val();
        data.t_subjects = $("input[name='t_subjects']").val();
        status = 2;
        if (data.t_name == '') {
            alert('教师名称不能为空');
            return false;
        }
        if (data.email == '') {
            alert('教师邮箱不能为空');
            return false;
        }
        if (data.sex == '') {
            alert('教师性别不能为空');
            return false;
        }
        if (data.age == '') {
            alert('教师年龄不能为空');
            return false;
        }
        if (data.t_subjects == '') {
            alert('教师所教科目不能为空');
            return false;
        }
        if (data.t_style == '') {
            alert('教师个人风格不能为空');
            return false;
        }
        if (data.t_desc == '') {
            alert('教师个人简介不能为空');
            return false;
        }
        $.ajaxFileUpload({
            type: 'post',
            url: '/teacher/userupload',
            secureuri: false,
            fileElementId: 'file',
            dataType: 'json',
            success: function (msg) {
                if (msg.code == 0) {
                    data.img = msg.img;
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        data: data,
                        url: '/teacher/myusers',
                        success: function (mag) {
                            if (mag.code == 1) {
                                alert(mag.msg);
                                window.top.location.href = "/teacher/index";
                            }else {
                                alert(mag.msg);
                            }
                        }
                    });
                } else {
                    alert("添加失败");
                }
            }
        });
    });
    $('.btn_no').click(function () {
        window.top.location.href = "/teacher/index";
    });
</script>