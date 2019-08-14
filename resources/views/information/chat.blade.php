<!doctype html>
<html><!-- InstanceBegin template="/Templates/dwt.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta charset="utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>谋刻职业教育在线测评与学习平台</title>
    <link rel="stylesheet" href="/css/course.css"/>

    <script src="/js/jquery-1.8.0.min.js"></script>
    <link rel="stylesheet" href="/css/tab.css" media="screen">
    <script src="/js/jquery.tabs.js"></script>
    <script src="/js/mine.js"></script>

    <!-- InstanceEndEditable -->
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->

    {{--<link rel="stylesheet" href="/css/article.css">--}}

</head>











<body>
@include('public/top')

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont" style="background: none #fff;border-radius: 0px;box-shadow: 0 0px 0px rgba(0, 0, 0, 0);" >
    <div >
        {{--<h3 class="righttit">全部资讯</h3>--}}
        <span class="bread nob">
        <a class="fombtn" href="/information/information">全部资讯</a>
        <a class="fombtn" href="/information/information">热门资讯</a>
        <a class="fombtn" href="/information/teacherlist">考试指导</a>
        <a class="fombtn" href="articlelist.html">精彩活动</a>
		</span>
    </div>
    <h3 class="righttit" style="padding-left:50px;">优秀考试指导老师</h3>
    @foreach($db as $k=>$v)
        <div class="coursepic tecti">
            <div class="teaimg">
                <a href="teacher.html" target="_blank"><img src="{{$v->img}}" width="150"></a>
            </div>
            <div class="teachtext">
                <h3><a href="teacher.html" target="_blank" class="teatt">{{$v->t_name}}</a>&nbsp;&nbsp;<strong>会计基础、会计电算化讲师</strong></h3>
                <textarea name="text" id="" cols="120" rows="5" placeholder="请输出你想要老师帮你解答的内容"></textarea>
            </div>
            <div>
                 <span class="bread nob">
                    <a class="fombtn" href="/information/chatdo">提交</a>
                </span>
            </div>
            <div class="clearh"></div>
        </div>
    @endforeach



</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>

<div class="style">

    {{--https://user.qzone.qq.com/2032692274?source=namecardhoverqzone--}}
</div>
@include('public/down')


<script>
    $(function () {
        // alert(1);
    })
</script>
