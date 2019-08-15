<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>小节修改</title>
    <link rel="stylesheet" type="text/css" href="/css/css.css"/>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
</head>
<body>
<div id="pageAll">
    <div class="page ">
        <!-- 上传广告页面样式 -->
        <div class="banneradd bor">
            <div class="baTop">
                <span>小节修改</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    所属章节：<select name="section_id" id="section_id">
                        @foreach($arr as $k=>$v)
                            <option value="{{$v['section_id']}}" selected>{{$v['section_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="bbD">
                    小节名称：<input type="text" name="son_name" value="{{$data->son_name}}" class="input1"/>
                </div>
                <div class="bbD">
                    小节介绍：<textarea name="son_desc" id="" value="{{$data->son_desc}}" cols="30" rows="10"></textarea>
                </div>
                <div class="bbD">
                    <p class="bbDP">
                        <input type="hidden" name="son_id" id="son_id" value="{{$data['son_id']}}">
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
        data.section_id = $("#section_id").find('option:selected').val();
        data.son_id = $('#son_id').val();
        data.son_name = $("input[name='son_name']").val();
        data.son_desc = $("textarea[name='son_desc']").val();
        status = 2;
        if (data.section_id == '') {
            alert('所属章节不能为空');
            return false;
        }
        if (data.son_name == '') {
            alert('小节名字不能为空');
            return false;
        }
        if (data.son_desc == '') {
            alert('小节介绍不能为空');
            return false;
        }
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: data,
            url: '/teacher/sonupdo',
            success: function (mag) {
                if (mag.code == 1) {
                    alert(mag.msg);
                    window.location.href = "/teacher/sonlist";
                } else {
                    alert(mag.msg);
                }
            }
        });
    });
    $('.btn_no').click(function () {
        window.top.location.href = "/teacher/sonlist";
    });
</script>