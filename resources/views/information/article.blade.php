@include('public/top')
<!doctype html>
<html><!-- InstanceBegin template="/Templates/dwt.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta charset="utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>谋刻职业教育在线测评与学习平台</title>

    <link rel="stylesheet" href="/css/article.css">

    <script src="/js/jquery-1.8.0.min.js"></script>
    <script src="/js/mine.js"></script>
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- InstanceEndEditable -->
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->

</head>

<body>

<link rel="stylesheet" href="/css/">
<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
    <div class="coursepic">
        <h3 class="righttit">全部资讯</h3>
        <div class="clearh"></div>
        <span class="bread nob">
        <a class="fombtn cur" href="/information/information">全部资讯</a>
        <a class="fombtn" href="/information/information">热门资讯</a>
        <a class="fombtn" href="/information/teacherlist">考试指导</a>
        <a class="fombtn" href="articlelist.html">精彩活动</a>
        </span>

    </div>
    <div class="clearh"></div>
    <div class="coursetext">

        {{--咨询内容4条--}}
        @foreach($article as $key=>$val)
            <div class="articlelist">
                <input type="hidden" value="{{$val->a_id}}">
                <h3><a class="artlink" href="/information/articlelist?id={{$val->a_id}}">{{$val->a_name}}</a></h3>
                <p>{{str_limit($val->a_desc,100,'.......')}}</p>
                <p class="artilabel">
                    <span class="ask_label">热门资讯</span>
                    <b class="labtime">{{$val->c_time}}</b>
                </p>
                <div class="clearh"></div>
            </div>
        @endforeach



        <div class="clearh" style="height:20px;"></div>
        {{--分页实现--}}
        <span class="pagejump">
    	<p class="userpager-list">
             {{--​{{ $article->ap->render()}}--}}
             {{$article->links()}}
        </p>
    </span>
        <div class="clearh" style="height:10px;"></div>
    </div>
    {{--热门咨询6条--}}
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
        {{--推荐课程--}}
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

