<!doctype html>
<html><!-- InstanceBegin template="/Templates/dwt.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta charset="utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>谋刻职业教育在线测评与学习平台</title>

    <link rel="stylesheet" href="/css/article.css">
    <script src="/js/jquery-1.8.0.min.js"></script>
    <script src="/js/mine.js"></script>
    <!-- InstanceEndEditable -->
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->

</head>

<body>
@include('public/top')
<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
    <div class="coursepic">
        <h3 class="righttit">全部资讯</h3>
        <div class="clearh"></div>
        <span class="bread">
            @foreach($desc as $k=>$v)
    <a class="ask_link" href="/information/information">全部资讯</a>&nbsp;/&nbsp;<a class="ask_link" href="/information/information">热门资讯</a>&nbsp;/&nbsp;{{$v->a_name}}
            @endforeach
        </span>

    </div>
    <div class="clearh"></div>
    @foreach($desc as $k=>$v)
    <div class="coursetext">

	<span class="articletitle">
        <h2>{{$v->a_name}}</h2>
        <p class="gray">{{$v->c_time}}</p>
    </span>
      <p class="coutex">{{$v->a_desc}}</p>
        <div class="clearh" style="height:30px;"></div>
        <span class="pagejump">
    	<a class="pagebtn lpage" title="上一篇" href="#">上一篇</a>
        <a class="pagebtn npage" title="下一篇" href="#">下一篇</a>
    </span>

    </div>
    @endforeach

    <div class="courightext">
        <div class="ctext">
            <div class="cr1">
                <h3 class="righttit">热门资讯</h3>
                <div class="gonggao">
                    @foreach($ahot as $k=>$v)
                        <ul class="hotask">
                            <li><a class="ask_link" href="/information/articlelist?id={{$v->a_id}}"><strong>●</strong>{{$v->a_name}}</a></li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="ctext">
            <div class="cr1">
                <h3 class="righttit">推荐课程</h3>
                <div class="teacher">
                    @foreach( $course as $k=>$v)
                        <div class="teapic">
                            <a href="/information/courselist"  target="_blank"><img src="{{$v->c_img}}" height="60" title="财经法规与财经职业道德"></a>
                            <h3 class="courh3"><a href="/information/courselist" class="ask_link" target="_blank">{{$v->c_name}}</a></h3>
                        </div>
                        <div class="clearh"></div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>



    <div class="clearh"></div>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>
@include('public/down')