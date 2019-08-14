@extends('layouts.layouts')
@section('content')
    <script type="text/javascript">
        $(function(){
            $('.demo2').Tabs({
                event:'click'
            });
            $('.demo3').Tabs({
                event:'click'
            });
        });
    </script>
<div class="coursecont">
    <div class="coursepic1">
        <div class="coursetitle1">
            <h2 class="courseh21">会计财经法规与会计职业道德</h2>
            <div  style="margin-top:-40px;margin-right:25px;float:right;">
                <script>
                    window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"24"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
                </script>
            </div>
        </div>
<div class="course_img1">
    <img src="/images/c1.jpg" height="140">
</div>
<div class="course_xq">
    <span class="courstime1"><p>课时<br/><span class="coursxq_num">100课时</span></p></span>
    <span class="courstime1"><p>学习人数<br/><span class="coursxq_num">25987人</span></p></span>
    <span class="courstime1"><p style="border:none;">课程时长<br/><span class="coursxq_num">3小时20分</span></p></span>
</div>
<div class="course_xq2">
    <a class="course_learn" href="video.html">开始学习</a>
</div>
<div class="clearh"></div>
</div>

<div class="clearh"></div>
<div class="coursetext">
    <div class="box demo2" style="position:relative">
        <ul class="tab_menu">
            <li class="current course1">章节</li>
            @if($u_id=='')
            @else
            <li class="course1">评价</li>
            <li class="course1">问答</li>
            <li class="course1">资料区</li>
                @endif
        </ul>
        <!--<a class="fombtn" style=" position:absolute; z-index:3; top:-10px; width:80px; text-align:center;right:0px;" href="#">下载资料包</a>-->
        <div class="tab_box">
            <div>
                <dl class="mulu noo">
                    <div>
                        <dt class="mulu_title"><span class="mulu_img"></span>{{$section->section_name}}
                            <span class="mulu_zd">+</span></dt>
                        @foreach($course_son_section as $v)
                        <div class="mulu_con">
                            <dd class="smalltitle"><strong>{{$v->period_name}}</strong></dd>
                            @foreach($v->son as $vv)
                            <a href="video.html"><dd><strong class="cataloglink">{{$vv->period_name}}</strong><i class="fini nn"></i></dd></a>
                                @endforeach
                        </div>
                            @endforeach
                    </div>
                </dl>
            </div>
            @if($u_id=='')
                @else
                <div class="hide">
                    <div>
                        <div id="star">
                            <span class="startitle">请打分</span>
                            <ul>
                                <li class="score"><a href="javascript:;" class="a">1</a></li>
                                <li class="score"><a href="javascript:;" class="a">2</a></li>
                                <li class="score"><a href="javascript:;" class="a">3</a></li>
                                <li class="score"><a href="javascript:;" class="a">4</a></li>
                                <li class="score"><a href="javascript:;" class="a">5</a></li>
                            </ul>
                            {{--//课程ID--}}
                            <input type="hidden" id="c_id" value="{{$section->c_id}}">
                            <p></p>
                        </div>
                        <div class="c_eform">
                            <span class="startitle">请评论</span>
                            <textarea rows="7" class="pingjia_con" id="l_content"></textarea>
                            <a href="javascript:;" id="comment" class="fombtn">发布评论</a>
                            <div class="clearh"></div>
                        </div>
<script>
    $('.score').click(function(){
        var _this = $(this);
        var score = _this.children().text();
        var c_id = $('#c_id').val();
        return false
        $.get(
            'http://www.guowei1.com/course/content_comment',
            {score:score,c_id:c_id},
            function(res){

            },'json'
        )
    })
    $('#comment').click(function(){
        var l_content = $('#l_content').val();
        var c_id = $('#c_id').val();
        return false
        $.get(
            'http://www.guowei1.com/course/content_comment',
            {content:content,c_id:c_id},
            function(res){

            },'json'
        )
    })
</script>
                        <ul class="evalucourse">
                            <li>
                        	<span class="pephead"><img src="/images/0-0.JPG" width="50" title="候候">
                            <p class="pepname">候候候候</p>
                            </span>
                                <span class="pepcont"><p>2013年国家公务员考试真题2013年国家公务员考试真题2013年国家公务员考试真题2013试真3年国家公。</p>
                            <p class="peptime pswer">2015-01-02</p></span>
                            </li>
                            <li>
                        	<span class="pephead"><img src="/images/0-0.JPG" width="50" title="候候">
                            <p class="pepname">候候15kpiii</p>
                            </span>
                                <span class="pepcont"><p>2013年国家公务员考试真题2013年国家公务员考试真题2013年国家公务员考试真题2013年国家公务员考试真题2013年国家公务员考试真题2013年国家公务员考试真题2013年国家公务员考试真题2013年国家公。</p>
                            <p class="peptime pswer">2015-01-02</p></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="hide">
                    <div>
                        <h3 class="pingjia">提问题</h3>
                        <div class="c_eform">
                            <input type="text" id="title" class="pingjia_con" placeholder="请输入标题"><br/>
                            <textarea rows="7" class="pingjia_con" placeholder="请输入问题的详细内容" id="content"></textarea>
                            <a href="javascript:;" class="fombtn" id="publish">发布</a>
                            <div class="clearh"></div>
                        </div>
                        <script>
                            $('#publish').click(function(){
                                var content = $('#content').val();
                                var title = $('#title').val();
                                var c_id = $('#c_id').val();
                                return false
                                $.get(
                                    'http://www.guowei1.com/course/questions',
                                    {content:content,title:title,c_id:c_id},
                                    function(res){

                                    },'json'
                                )
                            })
                        </script>
                        <ul class="evalucourse">
                            <li>
                        	<span class="pephead"><img src="/images/0-0.JPG" width="50" title="候候">
							<p class="pepname">候候</p>
                            </span>
                                <span class="pepcont">
                            <p><a href="#" class="peptitle" target="_blank">2013年国家公务员考试真题2013年国家公务员考试真题2013年国家公务员考试真题2013年?</a></p>
                            <p class="peptime pswer"><span class="pepask">回答(<strong><a class="bluelink" href="#">10</a></strong>)&nbsp;&nbsp;&nbsp;&nbsp;浏览(<strong><a class="bluelink" href="#">10</a></strong>)</span>2015-01-02</p>
                            </span>
                            </li>
                            <li>
                        	<span class="pephead"><img src="/images/0-0.JPG" width="50" title="候候">
							<p class="pepname">候候</p>
                            </span>
                                <span class="pepcont">
							<p><a href="#" class="peptitle" target="_blank">2013年国家公务员考试真题2013年国家公务员考试真题2013年国家公务员考试真题2013年?</a></p>
                            <p class="peptime pswer"><span class="pepask">回答(<strong><a class="bluelink" href="#">10</a></strong>)&nbsp;&nbsp;&nbsp;&nbsp;浏览(<strong><a class="bluelink" href="#">10</a></strong>)</span>2015-01-02</p>
                            </span>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="hide">
                    <div>
                        <ul class="notelist" >
                            <li>
                                <p class="mbm mem_not"><a href="#" class="peptitle">1.rar</a></p>
                                <p class="gray"><b class="coclass">课时：<a href="#" target="_blank">会计的概念与目标1</a></b><b class="cotime">上传时间：<b class="coclass" >2015-05-8</b></b></p>

                            </li>
                            <li>
                                <p class="mbm mem_not"><a href="#" class="peptitle">资料.rar</a></p>
                                <p class="gray"><b class="coclass">课时：<a href="#" target="_blank">会计的概念与目标2</a></b><b class="cotime">上传时间：<b class="coclass" >2015-05-8</b></b></p>
                            </li>
                        </ul>

                    </div>
                </div>
                @endif
        </div>
    </div>

</div>

<div class="courightext">
    <div class="ctext">
        <div class="cr1">
            <h3 class="righttit">授课讲师</h3>
            <div class="teacher">
                <div class="teapic ppi">
                    <a href="teacher.html" target="_blank"><img src="/images/teacher.png" width="80" class="teapicy" title="张民智"></a>
                    <h3 class="tname"><a href="teacher.html" class="peptitle" target="_blank">{{$teacher->t_name}}</a><p style="font-size:14px;color:#666">{{$teacher->t_desc}}</p></h3>
                </div>
                <div class="clearh"></div>
                <p>{{$teacher->t_style}}</p>
            </div>
        </div>
    </div>

    <div class="ctext">
        <div class="cr1">
            <h3 class="righttit" onclick="reglog_open();">最新学员</h3>
            <div class="teacher zxxy">
                <ul class="stuul">
                    <li><img src="/images/0-0.JPG" width="60" title="张三李四"><p class="stuname">张三李四</p></li>
                    <li><img src="/images/0-0.JPG" width="60" title="张三李四"><p class="stuname">张三李四</p></li>
                    <li><img src="/images/0-0.JPG" width="60" title="张三李四"><p class="stuname">张三李四</p></li>
                    <li><img src="/images/0-0.JPG" width="60" title="张三李四"><p class="stuname">张三李四</p></li>
                </ul>
                <div class="clearh"></div>
            </div>
        </div>
    </div>

    <div class="ctext">
        <div class="cr1">
            <h3 class="righttit">相关课程</h3>
            <div class="teacher">
                <div class="teapic">
                    <a href="#"  target="_blank"><img src="/images/c1.jpg" height="60" title="财经法规与财经职业道德"></a>
                    <h3 class="courh3"><a href="#" class="peptitle" target="_blank">财经法规与财经职业道德</a></h3>
                </div>
                <div class="clearh"></div>
                <div class="teapic">
                    <a href="#"  target="_blank"><img src="/images/c2.jpg" height="60" title="财经法规与财经职业道德"></a>
                    <h3 class="courh3"><a href="#" class="peptitle" target="_blank">财经法规与财经职业道德</a></h3>
                </div>
                <div class="clearh"></div>
                <div class="teapic">
                    <a href="#"  target="_blank"><img src="/images/c3.jpg" height="60" title="财经法规与财经职业道德"></a>
                    <h3 class="courh3"><a href="#" class="peptitle" target="_blank">财经法规与财经职业道德</a></h3>
                </div>
                <div class="clearh"></div>
            </div>
        </div>
    </div>

</div>
@endsection