@extends('layouts.layouts')
@section('content')


<body>


<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="register" style="background:url({{url('images/13.jpg')}}) right center no-repeat #fff">
    <h2>注册</h2>
    <form>
        <div>
            <p class="formrow"><label class="control-label" for="register_email">邮箱地址</label>
                <input type="text" id="u_email"><button type="button" id="sub">发送</button></p>



            <span class="text-danger">请输入邮箱地址</span>
        </div>
        <div>
            <p class="formrow"><label class="control-label" for="register_email">邮箱验证码</label>
                <input type="text" id="u_code"></p>
            <span class="text-danger">请输入邮箱验证码</span>
        </div>
        <div>
            <p class="formrow"><label class="control-label" for="register_email">昵称</label>
                <input type="text" id="u_name"></p>
            <span class="text-danger">该怎么称呼你？ 中、英文均可，最长14个英文或7个汉字</span>
        </div>
        <div>
            <p class="formrow"><label class="control-label" for="register_email">密码</label>
                <input type="password" id="u_pwd"></p>
            <span class="text-danger">5-20位英文、数字、符号，区分大小写</span>
        </div>
        <div>
            <p class="formrow"><label class="control-label" for="register_email">确认密码</label>
                <input type="password"  id="u_pwds"></p>
            <span class="text-danger">再输入一次密码</span>
        </div>
        <div class="loginbtn reg">
            <button type="button" class="uploadbtn ub1">注册</button>
        </div>

    </form>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>


</body>
<script>
    $('#sub').click(function () {
      var $u_email=$('#u_email').val();
      if($u_email==''){
          alert('邮箱不能为空');
          return false;
      }
        $.ajax({
            type:"post",
            url:"{{url("user/getcode")}}",
            data:{u_email:$u_email},
            dataType:"json",
            success:function(res){
                if(res==1){
                    alert('发送成功');
                }
            }

        })
    });
      $('.ub1').click(function () {
            var $u_email=$('#u_email').val();
            var $u_code=$('#u_code').val();
            var $u_name=$('#u_name').val();
            var $u_pwd=$('#u_pwd').val();
            var $u_pwds=$('#u_pwds').val();
            if($u_code==''){
                alert('请先输入邮箱验证码');
                return false;
            }
          if($u_name==''){
              alert('请先输入昵称');
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
              url:"{{url("user/registerdo")}}",
              data:{u_email:$u_email,u_name:$u_name,u_pwd:$u_pwd,u_code:$u_code},
              dataType:"json",
              success:function(res){
             if(res==1){
                 alert('注册成功');
             }else if(res==2){
                 alert('注册失败');
                 return false;
             }else if(res==3){
                 alert('验证码不正确');
                 return false;
             }else if(res==4){
                 alert('邮箱已有');
                 return false;
             }else{
                 alert('账户已有');
                 return false;
             }
              }

          })



      })

</script>
@endsection


