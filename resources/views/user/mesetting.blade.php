@extends('layouts.layouts')
@section('content')

    <script src="{{url('/js/ajaxfileupload.js')}}"></script>
    <body>


    <!-- InstanceBeginEditable name="EditRegion1" -->
    <div class="register" style="background:url({{url('images/13.jpg')}}) right center no-repeat #fff">
        <h2>修改信息</h2>
        <form>
            <input type="hidden" id="uid" value="{{$res['u_id']}}">
            <div>
                <p class="formrow"><label class="control-label" for="register_email">邮箱地址</label>
                    <input type="text" value="{{$res['u_email']}}" id="u_email"><button type="button" id="sub">发送</button></p>



                <span class="text-danger">请输入邮箱地址</span>
            </div>
            <div>
                <p class="formrow"><label class="control-label" for="register_email">邮箱验证码</label>
                    <input type="text" id="u_code"></p>
                <span class="text-danger">请输入邮箱验证码</span>
            </div>
            <div>
                <p class="formrow"><label class="control-label" for="register_email">昵称</label>
                    <input type="text" value="{{$res['u_name']}}" id="u_name"></p>
                <span class="text-danger">该怎么称呼你？ 中、英文均可，最长14个英文或7个汉字</span>
            </div>
            <div>
                <p class="formrow"><label class="control-label" for="register_email">头像</label>
                    <input type="file" id="file" name="file"  value="{{$res['u_img']}}">
                 </p><img src="/{{$res['u_img']}}" width="80" >
                <span class="text-danger">选择头像</span>
            </div>

            <div class="loginbtn reg">
                <button type="button" class="uploadbtn ub1">确定修改</button>
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
                var $uid=$('#uid').val();
            var $u_email=$('#u_email').val();
            var $u_code=$('#u_code').val();
            var $u_name=$('#u_name').val();
            var $file=$('#file').val();

            if($u_code==''){
                alert('请先输入邮箱验证码');
                return false;
            }
            if($u_name==''){
                alert('请先输入昵称');
                return false;
            }

                $.ajaxFileUpload({
                    type: 'post',
                    url: '/user/updmeset',
                    secureuri: false,
                    fileElementId: 'file',

                    dataType: 'json',
                    success: function (msg){
                        console.log(msg);
                    }
                })


                $.ajax({
                    type:"post",
                    url:"{{url("user/updateme")}}",
                    data:{uid:$uid,u_email:$u_email,u_code:$u_code,u_name:$u_name},
                    dataType:"json",
                    success:function(res){
                        if(res==1){
                            alert('修改成功');
                        }else if(res==2){
                            alert('修改失败');
                            return false;
                        }else if(res==3){
                            alert('验证码不正确');
                            return false;
                        }
                    }
                })
        })

    </script>
@endsection


