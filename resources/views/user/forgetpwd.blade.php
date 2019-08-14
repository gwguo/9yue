@extends('layouts.layouts')
@section('content')


    <body>


    <!-- InstanceBeginEditable name="EditRegion1" -->
    <div class="register" style="background:url({{url('images/13.jpg')}}) right center no-repeat #fff">
        <h2>忘记密码</h2>
        <form>
            <div>
                <p class="formrow"><label class="control-label" for="register_email">邮箱地址</label>
                    <input type="text" id="u_email"></p>
                <span class="text-danger">请输入邮箱地址</span>
            </div>
            {{--<div>--}}
                {{--<p class="formrow"><label class="control-label" for="register_email">邮箱验证码</label>--}}
                    {{--<input type="text" id="u_code"></p>--}}
                {{--<span class="text-danger">请输入邮箱验证码</span>--}}
            {{--</div>--}}
            <div class="loginbtn reg">
                <button type="button" class="uploadbtn ub1" id="sub">发送</button>
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
                url:"{{url("user/getpwdcode")}}",
                data:{u_email:$u_email},
                dataType:"json",
                success:function(res){
                    if(res==1){
                        alert('发送成功');

                    }
                }

            })
        });


    </script>
@endsection


