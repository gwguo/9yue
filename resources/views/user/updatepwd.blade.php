@extends('layouts.layouts')
@section('content')


    <body>
    <!-- InstanceBeginEditable name="EditRegion1" -->
    <div class="login" style="background:url({{url('images/12.jpg')}}) right center no-repeat #fff">
        <h2>修改密码</h2>
        <form style="width:600px">
            <div>
                <input type="hidden" id="uid" value="{{$res->u_id}}">
                <p class="formrow">
                    <label class="control-label" for="register_email">密码</label>
                    <input type="password" id="pwd">
                </p>
                <span class="text-danger">请输密码</span>
            </div>
            <div>
                <p class="formrow">
                    <label class="control-label" for="register_email">要修改密码</label>
                    <input type="password" id="u_pwd">
                </p>
                <p class="help-block"><span class="text-danger">请输入要修改的密码</span></p>
            </div>
            <div>
                <p class="formrow">
                    <label class="control-label" for="register_email">确认修改密码</label>
                    <input type="password" id="u_pwds">
                </p>
                <p class="help-block"><span class="text-danger">输入要修改的密码</span></p>
            </div>
            <div class="loginbtn">&nbsp;
                <button type="button" class="uploadbtn ub1">确定修改</button>

            </div>
            <div class="loginbtn lb">
                <a href="{{url('user/forgetpwd')}}" class="link-muted">找回密码</a>
            </div>
        </form>
    </div>
    <!-- InstanceEndEditable -->


    <div class="clearh"></div>

    </body>

    <!-- InstanceEnd --></html>
    <script>
        $('.ub1').click(function () {
            var $uid=$('#uid').val();
            var $pwd=$('#pwd').val();
            var $u_pwd=$('#u_pwd').val();
            var $u_pwds=$('#u_pwds').val();
            if($pwd==''){
                alert('请先输入密码');
                return false;
            }
            if($u_pwd==''){
                alert('请先输入要修改的密码');
                return false;
            }
            if($u_pwds==''){
                alert('请在输入要修改的密码');
                return false;
            }
            if($u_pwd!=$u_pwds){
                alert('要修改的两次密码不一致');
                return false;
            }
            $.ajax({
                type:"post",
                url:"{{url("user/updpwddo")}}",
                data:{uid:$uid,pwd:$pwd,u_pwd:$u_pwd,u_pwds:$u_pwds},
                dataType:"json",
                success:function(res){
                    if(res==1){
                        alert('修改成功');
                        window.location.href="/user/login";
                        return false;
                    }else if(res==2){
                        alert('输入的密码不正确');
                        return false;
                    }else if(res==3){
                        alert('修改失败');
                        return false;
                    }
                }

            })
        })
    </script>
@endsection