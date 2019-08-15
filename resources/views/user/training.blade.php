<!doctype html>
<html><!-- InstanceBegin template="/Templates/dwt.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta charset="utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>谋刻职业教育在线测评与学习平台</title>
    <link rel="stylesheet" href="{{url('css/course.css')}}"/>
    <link rel="stylesheet" href="{{url('css/member.css')}}"/>
    <script src="{{url('js/jquery-1.8.0.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('css/tab.css')}}" media="screen">
    <script src="{{url('js/jquery.tabs.js')}}"></script>
    <script src="{{url('js/mine.js')}}"></script>
    <script type="text/javascript">
        $(function(){


            $('.demo2').Tabs({
                event:'click'
            });



        });
    </script>
    <!-- InstanceEndEditable -->
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->

</head>

<body>

<div class="head" id="fixed">
    <div class="nav">
        <span class="navimg"><a href="index.html"><img border="0" src="{{url('images/logo.png')}}"></a></span>
        <ul class="nag">
            <li><a href="{{url('user/userindex')}}" class="link1 current">个人</a></li>
            <li><a href="articlelist.html" class="link1">课程</a></li>
            <li><a href="articlelist.html" class="link1">资讯</a></li>
            <li><a href="teacherlist.html" class="link1">讲师</a></li>
            <li><a href="exam_index.html" class="link1" target="_blank">题库</a></li>
            <li><a href="askarea.html" class="link1" target="_blank">问答</a></li>

        </ul>
        <span class="massage">
            <!--<span class="select">
        	<a href="#" class="sort">课程</a>
        	<input type="text" value="关键字"/>
            <a href="#" class="sellink"></a>
            <span class="sortext">
            	<p>课程</p>
                <p>题库</p>
                <p>讲师</p>
            </span>
        </span>-->
            <!--未登录-->
        	<span class="exambtn_lore">
                 <a class="tkbtn tklog" href="{{url('user/login')}}">登录</a>
                 <a class="tkbtn tkreg" href="{{url('user/register')}}">注册</a>

            </span>
            <!--登录后-->
            <!--<div class="logined">
                <a href="mycourse.html"  onMouseOver="logmine()" style="width:70px" class="link2 he ico" target="_blank">sherley</a>
                <span id="lne" style="display:none" onMouseOut="logclose()" onMouseOver="logmine()">
                    <span style="background:#fff;">
                        <a href="mycourse.html" style="width:70px; display:block;" class="link2 he ico" target="_blank">sherley</a>
                    </span>
                    <div class="clearh"></div>
                    <ul class="logmine" >
                        <li><a class="link1" href="#">我的课程</a></li>
                        <li><a class="link1" href="#">我的题库</a></li>
                        <li><a class="link1" href="#">我的问答</a></li>
                        <li><a class="link1" href="#">退出</a></li>
                    </ul>
                </span>
            </div>-->
 <li><a class="link1" href="{{url('user/exitadd')}}">退出</a></li>
        </span>
    </div>
</div>
<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="clearh"></div>
<div class="membertab">
    <div class="memblist">
        <div class="membhead">
            <div style="text-align:center;"><img src="/{{$data['u_img']}}" width="80" ></div>

            <div style="width:220px;text-align:center;">

                <p class="membUpdate mine">{{$data->u_name}}</p>

                <p class="membUpdate mine"><a href="{{url('user/mesetting')}}/{{$data->u_id}}">修改信息</a>&nbsp;|&nbsp;<a href="{{url('user/updatepwd')}}/{{$data->u_id}}">修改密码</a></p>
                <div class="clearh"></div>
            </div>
        </div>
        <div class="memb">

            <ul>
                <li class="currnav"><a class="mb1" href="{{url('user/userindex')}}">我的课程</a></li>
                <li><a class="mb3" href="{{url('user/myask')}}">我的问答</a></li>
                <li><a class="mb4" href="{{url('user/meword')}}">我的笔记</a></li>
                <li><a class="mb12" href="{{url('user/myhomework')}}">我的作业</a></li>
                <li><a class="mb2" href="{{url('user/training')}}" target="_blank">我的题库</a></li>
            </ul>

        </div>


    </div>


    <div class="membcont">
        <div>
            <h3 class="mem-h3">我的题库</h3>

        </div>

        <div class="box demo2" style="width:820px;">
            <div class="tab_box">
                <div>


                    <ul class="memb_course">

                        @foreach($arr as $k=>$v)
                            <div>

                                    @if($v->work_reply=="")

                                @else
                                    <p style="color:red">问{{$v->work_desc}}</p>
                                    <p class="formrow">
                                        <label class="control-label" for="register_email">答案:</label><br>
                                    <p>{{$v->work_reply}}</p>
                                    @endif
                                    </p>
                            </div>
                            <br>    <br>

                        @endforeach

                        <div style="height:10px;" class="clearfix"></div>
                    </ul>



                    <div class="hide">
                        <div>
                            <ul class="memb_course">

                                <li>
                                    <div class="courseli">
                                        <a href="video.html" target="_blank"><img width="230" src="{{url('images/c8.jpg')}}"></a>
                                        <p class="memb_courname"><a href="coursecont.html" class="blacklink">会计基础</a></p>
                                        <div class="mpp">
                                            <div class="lv" style="width:100%;"></div>
                                        </div>
                                        <p class="goon"><a href="coursecont.html"><span>查看课程</span></a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="courseli">
                                        <a href="video.html" target="_blank"><img width="230" src="{{url('images/c8.jpg')}}"></a>
                                        <p class="memb_courname"><a href="coursecont.html" class="blacklink">会计基础</a></p>
                                        <div class="mpp">
                                            <div class="lv" style="width:100%;"></div>
                                        </div>
                                        <p class="goon"><a href="coursecont.html"><span>查看课程</span></a></p>
                                    </div>
                                </li>


                                <div class="clearfix" style="height:10px;"></div>
                            </ul>

                        </div>
                    </div>
                    <div class="hide">
                        <div>
                            <ul class="memb_course">
                                <li>
                                    <div class="courseli mysc">
                                        <a href="video.html" target="_blank"><img width="230" src="{{url('images/c8.jpg')}}" class="mm"></a>
                                        <p class="memb_courname"><a href="video.html" class="blacklink">会计基础</a></p>
                                        <div class="mpp">
                                            <div class="lv" style="width:20%;"></div>
                                        </div>
                                        <p class="goon"><a href="#"><span>继续学习</span></a></p>
                                        <div class="mask"><span class="qxsc"  title="移除收藏">▬</span></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="courseli mysc">
                                        <a href="video.html" target="_blank"><img width="230" src="{{url('images/c8.jpg')}}" class="mm"></a>
                                        <p class="memb_courname"><a href="video.html" class="blacklink">会计基础</a></p>
                                        <div class="mpp">
                                            <div class="lv" style="width:20%;"></div>
                                        </div>
                                        <p class="goon"><a href="#"><span>继续学习</span></a></p>
                                        <div class="mask"><span class="qxsc"  title="移除收藏">▬</span></div>
                                    </div>
                                </li>
                                <div class="clearfix" style="height:10px;"></div>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="clearh"></div>
    </div>

    <!-- InstanceEndEditable -->


    <div class="clearh"></div>
    <div class="foot">
        <div class="fcontainer">
            <div class="fwxwb">
                <div class="fwxwb_1">
                    <span>关注微信</span><img width="95" alt="" src="{{url('images/num.png')}}">
                </div>
                <div>
                    <span>关注微博</span><img width="95" alt="" src="{{url('images/wb.png')}}">
                </div>
            </div>
            <div class="fmenu">
                <p><a href="#">关于我们</a> | <a href="#">联系我们</a> | <a href="#">优秀讲师</a> | <a href="#">帮助中心</a> | <a href="#">意见反馈</a> | <a href="#">加入我们</a></p>
            </div>
            <div class="copyright">
                <div><a href="/">谋刻网</a>所有&nbsp;晋ICP备12006957号-9</div>
            </div>
        </div>
    </div>
    <!--右侧浮动-->
    <div class="rmbar">
	<span class="barico qq" style="position:relative">
	<div  class="showqq">
	   <p>官方客服QQ:<br>335049335</p>
	</div>
	</span>
        <span class="barico em" style="position:relative">
	  <img src="{{url('images/num.png')}}" width="75" class="showem">
	</span>
        <span class="barico wb" style="position:relative">
	  <img src="{{url('images/wb.png')}}" width="75" class="showwb">
	</span>
        <span class="barico top" id="top">置顶</span>
    </div>


    <!-- InstanceEnd --><>
</div>
</body>
</html>
