<!doctype html>
<html><!-- InstanceBegin template="/Templates/dwt.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta charset="utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>谋刻职业教育在线测评与学习平台</title>
    <link rel="stylesheet" href="/css/course.css"/>
    <link rel="stylesheet" href="/css/tab.css" media="screen">
    <script src="/js/jquery-1.8.0.min.js"></script>
    <script src="/js/jquery.tabs.js"></script>
    <script src="/js/mine.js"></script>
    <!-- InstanceEndEditable -->
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->

</head>

<body>

@include('public/top')
<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
    <div class="courseleft">
	<span class="select">
      <input type="text" value="请输入关键字" class="pingjia_con"/>
      <a href="#" class="sellink"></a>
    </span>
        <ul class="courseul">
            <li class="curr" style="border-radius:3px 3px 0 0;background:#fb5e55;"><h3 style="color:#fff;"><a href="#" class="whitea">全部课程</a></h3>
            <li>
                <h4>财会金融</h4>
                <ul class="sortul">
                    <li class="course_curr"><a href="#">会计从业证</a></li>
                    <li><a href="#">初级会计职称</a></li>
                    <li><a href="#">中级会计职称</a></li>
                    <li><a href="#">会计高级职称</a></li>
                    <li><a href="#">注册会计师</a></li>
                    <li><a href="#">经济师</a></li>
                </ul>
                <div class="clearh"></div>
            </li>
            <li>
                <h4>计算机</h4>
                <ul class="sortul">
                    <li><a href="#">C语言</a></li>
                    <li><a href="#">JAVA</a></li>
                    <li><a href="#">.NET</a></li>
                    <li><a href="#">PHP</a></li>

                </ul>
                <div class="clearh"></div>
            </li>
        </ul>
        <div style="height:20px;border-radius:0 0 5px 5px; background:#fff;box-shadow:0 2px 4px rgba(0, 0, 0, 0.1)"></div>
    </div>
    <div class="courseright">
        <div class="clearh"></div>
        <ul class="courseulr">
            @foreach($course as $k=>$v)
            <li>
                <div class="courselist">

                    <a href="/information/coursecont?id={{$v->c_id}}" target="_blank"><img style="border-radius:3px 3px 0 0;" width="240" src="{{$v->c_img}}" title="{{$v->c_name}}"></a>
                    <p class="courTit"><a href="/information/coursecont?id={{$v->c_id}}" target="_blank">{{$v->c_name}}</a></p>
                    <div class="gray">
                        <span>30课时 600分钟</span>
                        <span class="sp1">1255555人学习</span>
                        <div style="clear:both"></div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="clearh"></div>
</div>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>
@include('public/down')