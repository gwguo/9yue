<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>作业修改</title>
    <link rel="stylesheet" type="text/css" href="/css/css.css"/>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
</head>
<body>
<div id="pageAll">
    <div class="page ">
        <!-- 上传广告页面样式 -->
        <div class="banneradd bor">
            <div class="baTop">
                <span>作业修改</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    所属课时：<select name="period_id" id="period_id">
                        @foreach($arr as $k=>$v)
                            <option value="{{$v['period_id']}}" selected>{{$v['period_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="bbD">
                    作业名称：<input type="text" name="work_name" value="{{$data->work_name}}" class="input1"/>
                </div>
                <div class="bbD">
                    作业介绍：<textarea name="work_desc" id="" value="{{$data->work_desc}}" cols="30" rows="10"></textarea>
                </div>
                <div class="bbD">
                    <p class="bbDP">
                        <input type="hidden" name="work_id" id="work_id" value="{{$data['work_id']}}">
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
        data.period_id = $("#period_id").find('option:selected').val();
        data.work_id = $('#work_id').val();
        data.work_name = $("input[name='work_name']").val();
        data.work_desc = $("textarea[name='work_desc']").val();
        status = 2;
        if (data.period_id == '') {
            alert('所属课时不能为空');
            return false;
        }
        if (data.work_name == '') {
            alert('作业名字不能为空');
            return false;
        }
        if (data.work_desc == '') {
            alert('作业介绍不能为空');
            return false;
        }
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: data,
            url: '/teacher/workupdo',
            success: function (mag) {
                if (mag.code == 1) {
                    alert(mag.msg);
                    window.location.href = "/teacher/worklist";
                } else {
                    alert(mag.msg);
                }
            }
        });
    });
    $('.btn_no').click(function () {
        window.top.location.href = "/teacher/worklist";
    });
</script>