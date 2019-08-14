@extends('layouts.layouts')
@section('content')


    <body>
    <!-- InstanceBeginEditable name="EditRegion1" -->
    <div class="login" style="background:url({{url('images/12.jpg')}}) right center no-repeat #fff">
        <h2>找回密码</h2>
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
                    <label class="control-label" for="register_email">更改密码</label>
                    <input type="password" id="u_pwd">
                </p>
                <p class="help-block"><span class="text-danger">请输入密码</span></p>
            </div>
            <div>
                <p class="formrow">
                    <label class="control-label" for="register_email">确认改密码</label>
                    <input type="password" id="u_pwds">
                </p>
                <p class="help-block"><span class="text-danger">请输入密码</span></p>
            </div>
            <div class="loginbtn">
                <button type="button" class="uploadbtn ub1">确定</button>

            </div>
        </form>

    </div>
    <!-- InstanceEndEditable -->


    <div class="clearh"></div>

    </body>

    <!-- InstanceEnd --></html>
    <script>
        $('.ub1').click(function () {
            var $name=$('#name').val();
            var $u_pwd=$('#u_pwd').val();
            var $u_pwds=$('#u_pwds').val();
            if($name==''){
                alert('请先输入账户');
                return false;
            }
            if($u_pwd==''){
                alert('请先输入密码');
                return false;
            }
            if($u_pwds==''){
                alert('请先确认密码');
                return false;
            }
            if($u_pwd!=$u_pwds){
                alert('请先确认两次密码是否一致');
                return false;
            }
            $.ajax({
                type:"post",
                url:"{{url("user/findpwddo")}}",
                data:{name:$name,u_pwd:$u_pwd},
                dataType:"json",
                success:function(res){
                    if(res==1){
                        alert('修改成功');
                      window.location.href="/user/login";
                      return false;
                    }else if(res==2){
                        alert('修改失败');
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