<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>课时修改</title>
    <link rel="stylesheet" type="text/css" href="/css/css.css"/>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
</head>
<body>
<div id="pageAll">
    <div class="page ">
        <!-- 上传广告页面样式 -->
        <div class="banneradd bor">
            <div class="baTop">
                <span>课时修改</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    所属小节：<select name="son_id" id="son_id">
                        @foreach($arr as $k=>$v)
                            <option value="{{$v['son_id']}}" selected>{{$v['son_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="bbD">
                    课时名称：<input type="text" name="period_name" value="{{$data->period_name}}" class="input1"/>
                </div>
                <div class="bbD">
                    课时介绍：<textarea name="period_desc" id="" value="{{$data->period_desc}}" cols="30"
                                   rows="10"></textarea>
                </div>
                <div class="bbD">
                    修改视频：
                    <input type="file" name="file" id="file"/>
                    <video controls width=300 height="170" src="{{asset($data->period_video)}}"></video>
                </div>
                <div class="bbD">
                    <p class="bbDP">
                        <input type="hidden" name="period_id" id="period_id" value="{{$data['period_id']}}">
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
        data.son_id = $("#son_id").find('option:selected').val();
        data.period_id = $('#period_id').val();
        data.period_name = $("input[name='period_name']").val();
        data.period_desc = $("textarea[name='period_desc']").val();
        status = 2;
        if (data.son_id == '') {
            alert('所属小节不能为空');
            return false;
        }
        if (data.period_name == '') {
            alert('课时名字不能为空');
            return false;
        }
        if (data.period_desc == '') {
            alert('课时介绍不能为空');
            return false;
        }
        $.ajaxFileUpload({
            type: 'post',
            url: '/teacher/videoupload',
            secureuri: false,
            fileElementId: 'file',
            dataType: 'json',
            success: function (msg) {
                if (msg.code == 0) {
                    data.period_video = msg.img;
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        data: data,
                        url: '/teacher/periodupdo',
                        success: function (mag) {
                            if (mag.code == 1) {
                                alert(mag.msg);
                                window.location.href = "/teacher/periodlist";
                            } else {
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
        window.top.location.href = "/teacher/periodlist";
    });
</script>