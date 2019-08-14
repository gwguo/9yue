<!doctype html>
<html><!-- InstanceBegin template="/Templates/dwt.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta charset="utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>谋刻职业教育在线测评与学习平台</title>

    <link rel="stylesheet" href="/css/course.css"/>
    <link rel="stylesheet" href="/css/register-login.css"/>
    <script src="/js/jquery-1.8.0.min.js"></script>
    <link rel="stylesheet" href="/css/tab.css" media="screen">
    <script src="/js/jquery.tabs.js"></script>
    <script src="/js/mine.js"></script>
    <!-- InstanceEndEditable -->
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->

</head>

<body>

@include('public/top')
<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="register" style="background:url(images/13.jpg) right center no-repeat #fff">
    <h2>订单</h2>
    <div class="form">
        <div>
            {{--@foreach($model as $k=>$v)--}}
                <tr >
                    <p class="formrow"><label class="control-label" for="register_email">购买的课程</label>
                        <a href="/information/coursecont?id={{$model['c_id']}}" target="_blank"><img style="border-radius:3px 3px 0 0;" width="100" src="{{$model['c_img']}}" title=""></a>
                    <h3  style="float: contour"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;   {{$model['c_name']}}      ￥<a style="color: red" class="price">{{$model['c_price']}}</a></h3>

                    </p>

                </tr>
               {{--@endforeach--}}
            <input type="hidden" class="oo" value="{{$model['c_id']}}">
        </div>
        <div>
            <p class="formrow"><label class="control-label" for="register_email">收货人姓名</label>
                <input type="text" style="height:35px;width: 300px" name="a_name" class="a_name">
            </p>
            <span class="text-danger" class="msgname">请输入收货人姓名</span>
        </div>
        <div>
            <p class="formrow"><label class="control-label" for="register_email">收货人手机号</label>
                <input type="text" style="height:35px;width: 300px" name="a_tel" class="a_tel">
            </p>
            <span class="text-danger">请输入11为手机号</span>
        </div>
        <div>
            <p class="formrow"><label class="control-label" for="register_email">收货地址</label>
                <input type="text" style="height:35px;width: 300px" name="city" class="city">
            </p>
            <span class="text-danger">省市区</span>
        </div>
        <div>
            <p class="formrow"><label class="control-label" for="register_email">详细地址</label>
                <input type="text" style="height:35px;width: 300px" name="a_detail" class="a_detail"></p>
            <span class="text-danger">如小区，街道，乡镇，村</span>
        </div>
        <div class="loginbtn reg">
            <button  id="butt" class="uploadbtn ub1">提交订单</button>
        </div>

    </div>
</div>
<!-- InstanceEndEditable -->
<script>
    //用户名
    $(document).on('blur','.a_name',function () {
        aname();
    })

    //手机号
    $(document).on('blur','.a_tel',function () {
        tel();
    })

    //提交订单
    $(document).on('click','#butt',function () {
        var name= $('.a_name').val();
        var tel= $('.a_tel').val();
        var city= $('.city').val();
        var detail= $('.a_detail').val();
        var cid= $('.oo').val();
        var price= $('.price').html();
        // alert(price);


        $.ajax({
            type:'post',
            url:"/information/order",
            data:{name:name,tel:tel,city:city,detail:detail,cid:cid,price:price},
            // dataType:'html',
            // async:false
        }).done(function(res){
            console.log(res);
            if(res=='success'){
                alert('下单成功'),location.href='/information/information';
            }else{
                alert('下单失败'),location.href='/information/order';
            }
            // $('#show').html(res);
        })
    })

    function aname() {
        var aname = $('.a_name').val();
        if(aname==''){
           alert('用户名不能为空');
        }
    }

    function tel() {
       var tel = $('.a_tel').val();
       var reg=/^\0?(13|14|15|18)[0-9]{9}$/;
       if(!reg.test(tel)){
           alert('请输入正确手机号');
       }
    }
</script>


<div class="clearh"></div>
@include('public/down')
