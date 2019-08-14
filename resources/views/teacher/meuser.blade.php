<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>个人中心</title>
    <link rel="stylesheet" type="text/css" href="/css/css.css"/>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
</head>
<body>
<div id="pageAll">
    <div class="page ">
        <!-- 上传广告页面样式 -->
        <div class="banneradd bor">
            <div class="baTop">
                <span>个人中心</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    姓名：<td>{{$arr->t_name}}</td>
                </div>
                <div class="bbD">
                    邮箱：<td>{{$arr->email}}</td>
                </div>
                <div class="bbD">
                    性别：@if($arr->sex==0)
                        <td>男</td>
                    @elseif($arr->sex==1)
                        <td>女</td>
                    @endif
                </div>
                <div class="bbD">
                    年龄：<td>{{$arr->age}}</td>
                </div>
                <div class="bbD">
                    所教科目：<td>{{$arr->t_subjects}}</td>
                </div>
                <div class="bbD">
                    个人风格：<td>{{$arr->t_style}}</td>
                </div>
                <div class="bbD">
                    个人简介：<td>{{$arr->t_desc}}</td>
                </div>
                <div class="bbD">
                    个人头像：<td><img src=".{{$arr->img}}" alt="" style="width: 100px;height: 100px;"></td>
                </div>
                <div class="bbD">
                    审核状态：@if($arr->audit==1)
                        <td>未审核</td>
                    @elseif($arr->audit==0)
                        <td>审核通过</td>
                    @elseif($arr->audit==2)
                        <td>审核不通过</td>
                    @endif
                </div>
            </div>
        </div>
        <!-- 上传广告页面样式end -->
    </div>
</div>
</body>
</html>