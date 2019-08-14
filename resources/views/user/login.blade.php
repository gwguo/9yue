@extends('layouts.layouts')
@section('content')


<body>
<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="login" style="background:url({{url('images/12.jpg')}}) right center no-repeat #fff">
    <h2>登录</h2>
    <form style="width:600px">
        <div>
            <p class="formrow">
                <label class="control-label" for="register_email">帐号</label>
                <input type="text" id="name">
            </p>
            <span class="text-danger">请输入Email地址 / 用户昵称</span>
        </div>
        <div>
            <p class="formrow">
                <label class="control-label" for="register_email">密码</label>
                <input type="password" id="u_pwd">
            </p>
            <p class="help-block"><span class="text-danger">请输入密码</span></p>
        </div>
        <div class="loginbtn">
            <label><input type="checkbox"  checked="checked"> <span class="jzmm">记住密码</span> </label>&nbsp;&nbsp;
            <button type="button" class="uploadbtn ub1">登录</button>

        </div>
        <div class="loginbtn lb">
            <a href="{{url('user/register')}}" class="link-muted">还没有账号？立即免费注册</a>
            <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
            <a href="{{url('user/forgetpwd')}}" class="link-muted">找回密码</a>
        </div>
    </form>
    <div class="hezuologo">
        <span class="hezuo">使用合作网站账号登录</span>
        <div class="hezuoimg">
            <img src="{{url('images/hezuoqq.png')}}" class="hzqq" title="QQ" width="40" height="40"/>
            <img src="{{url('images/hezuowb.png')}}" class="hzwb" title="微博" width="40" height="40"/>
        </div>

    </div>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>

</body>

<!-- InstanceEnd --></html>
<script>
    $('.ub1').click(function () {
        var $name=$('#name').val();
        var $u_pwd=$('#u_pwd').val();

        if($name==''){
            alert('请先输入账户');
            return false;
        }
        if($u_pwd==''){
            alert('请先输入密码');
            return false;
        }
        $.ajax({
            type:"post",
            url:"{{url("user/logindo")}}",
            data:{name:$name,u_pwd:$u_pwd},
            dataType:"json",
            success:function(res){
                if(res==1){
                    alert('登录成功');
                    window.location.href="/user/userindex";
                    return false;
                }else if(res==2){
                    alert('密码不正确');
                    return false;
                }else if(res==3){
                    alert('没有该用户');
                    return false;
                }
            }

        })
    })
</script>
@endsection