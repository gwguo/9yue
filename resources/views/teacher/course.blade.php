<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>课程添加</title>
    <link rel="stylesheet" type="text/css" href="/css/css.css"/>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
</head>
<body>
<div id="pageAll">
    <div class="page ">
        <!-- 上传广告页面样式 -->
        <div class="banneradd bor">
            <div class="baTop">
                <span>课程添加</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    所属分类：<select name="course_id" id="course_id">
                        @foreach($arr as $k=>$v)
                            <option value="{{$v['course_id']}}">{{$v['course_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="bbD">
                    课程名称：<input type="text" name="c_name" class="input1"/>
                </div>
                <div class="bbD">
                    是否收费：<input type="radio" name="free" value="0">免费
                    <input type="radio" name="free" value="1">收费
                </div>
                <div class="bbD">
                    课程价格：<input type="text" name="c_price" class="input1"/>
                </div>
                <div class="bbD">
                    课程介绍：<textarea name="c_notice" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="bbD">
                    课时数量：<input type="text" name="period_num" class="input1">
                </div>
                <div class="bbD">
                    课程类型：<input type="radio" name="excellent_course" value="0">普通
                    <input type="radio" name="excellent_course" value="1">精品
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
    $('#sub').click(function () {
        var data = {};
        data.course_id = $("#course_id").find('option:selected').val();
        data.c_name = $("input[name='c_name']").val();
        data.free = $("input[name='free']:checked").val();
        data.c_price = $("input[name='c_price']").val();
        data.c_notice = $("textarea[name='c_notice']").val();
        data.period_num = $("input[name='period_num']").val();
        data.excellent_course = $("input[name='excellent_course']:checked").val();
        status = 2;
        if (data.course_id == '') {
            alert('所属分类不能为空');
            return false;
        }
        if (data.c_name == '') {
            alert('课程名字不能为空');
            return false;
        }
        if (data.free == '') {
            alert('是否收费不能为空');
            return false;
        }
        if (data.c_price == '') {
            alert('课程价格不能为空');
            return false;
        }
        if (data.c_notice == '') {
            alert('课程介绍不能为空');
            return false;
        }
        if (data.period_num == '') {
            alert('课程数量不能为空');
            return false;
        }
        if (data.excellent_course == '') {
            alert('课程类型不能为空');
            return false;
        }
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: data,
            url: '/teacher/courseadd',
            success: function (mag) {
                if (mag.code == 1) {
                    alert(mag.msg);
                    window.location.href = "/teacher/courselist";
                } else {
                    alert(mag.msg);
                }
            }
        });
    });
    $('.btn_no').click(function () {
        window.top.location.href = "/teacher/index";
    });
</script>