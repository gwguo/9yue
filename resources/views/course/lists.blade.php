@extends('layouts.layouts')
@section('content')
    <div class="coursecont">
        <div class="courseleft">
	<span class="select">
      <input type="text" id="c_name" class="pingjia_con"/>
      <a href="javascript:;" id="course" class="sellink"></a>
        <script>
            $('#course').click(function(){
                var c_name = $('#c_name').val();
                if(c_name != ''){
                    location.href = "http://www.guowei1.com/course/list?c_name="+c_name;
                }
            })
        </script>
    </span>
            <ul class="courseul">
                <li class="curr" style="border-radius:3px 3px 0 0;background:#fb5e55;"><h3 style="color:#fff;"><a href="#" class="whitea">全部课程</a></h3>
                @foreach($course_type as $v)
                <li>
                    <h4>{{$v->course_name}}</h4>
                    <ul class="sortul">
                    @foreach($v->son as $vv)
                        @if($vv->course_id==$v->course_id)
                        <li class="course_curr"><a href="javascript:;">{{$vv->c_name}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="clearh"></div>
                </li>
                @endforeach
            </ul>
            <div style="height:20px;border-radius:0 0 5px 5px; background:#fff;box-shadow:0 2px 4px rgba(0, 0, 0, 0.1)"></div>
        </div>
        <div class="courseright">
            <div class="clearh"></div>
            <ul class="courseulr">
                @foreach($course as $v)
                <li>
                    <div class="courselist">
                        <a href="coursecont.html" target="_blank"><img style="border-radius:3px 3px 0 0;" width="240" src="/images/c1.jpg" title="会计基础"></a>
                        <p class="courTit"><a href="coursecont?c_id={{$v->c_id}}" target="_blank">{{$v->c_name}}</a></p>
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
@endsection