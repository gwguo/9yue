<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>章节修改</title>
    <link rel="stylesheet" type="text/css" href="/css/css.css"/>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
</head>
<body>
<div id="pageAll">
    <div class="page ">
        <!-- 上传广告页面样式 -->
        <div class="banneradd bor">
            <div class="baTop">
                <span>章节修改</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    所属课程：<select name="c_id" id="c_id">
                        @foreach($arr as $k=>$v)
                            <option value="{{$v['c_id']}}" selected>{{$v['c_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="bbD">
                    章节名称：<input type="text" name="section_name" value="{{$data->section_name}}" class="input1"/>
                </div>
                <div class="bbD">
                    章节介绍：<textarea name="section_desc" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="bbD">
                    <p class="bbDP">
                        <input type="hidden" name="section_id" id="section_id" value="{{$data['section_id']}}">
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
        data.c_id = $("#c_id").find('option:selected').val();
        data.section_id = $('#section_id').val();
        data.section_name = $("input[name='section_name']").val();
        data.section_desc = $("textarea[name='section_desc']").val();
        status = 2;
        if (data.c_id == '') {
            alert('所属课程不能为空');
            return false;
        }
        if (data.section_name == '') {
            alert('章节名字不能为空');
            return false;
        }
        if (data.section_desc == '') {
            alert('章节介绍不能为空');
            return false;
        }
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: data,
            url: '/teacher/sectionupdo',
            success: function (mag) {
                if (mag.code == 1) {
                    alert(mag.msg);
                    window.location.href = "/teacher/sectionlist";
                } else {
                    alert(mag.msg);
                }
            }
        });
    });
    $('.btn_no').click(function () {
        window.top.location.href = "/teacher/sectionlist";
    });
</script>