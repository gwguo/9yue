@extends('layouts.layouts')
@section('content')


    <body>
    <!-- InstanceBeginEditable name="EditRegion1" -->
    <div class="login" style="background:url({{url('images/12.jpg')}}) right center no-repeat #fff">
        <h2>添加笔记</h2>
        <form style="width:600px">
            <div>
                <p class="formrow">
                    <label class="control-label" for="register_email">笔记名称</label>
                    <input type="text" id="name">
                </p>
                <span class="text-danger">请输入笔记名称</span>
            </div>
            <div>
                <p class="formrow">
                    <label class="control-label" for="register_email">笔记内容</label>

                </p>
                <textarea id="word" cols="30" rows="10"></textarea>
                <p class="help-block"><span class="text-danger">请输入内容</span></p>

            </div>
            <div class="loginbtn">
                <button type="button" class="uploadbtn ub1">添加</button>

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
            var $word=$('#word').val();

            if($name==''){
                alert('请先输入标题');
                return false;
            }
            if($word==''){
                alert('请先输入内容');
                return false;
            }
            $.ajax({
                type:"post",
                url:"{{url("user/worddo")}}",
                data:{name:$name,word:$word},
                dataType:"json",
                success:function(res){
                    if(res==1){
                        alert('添加成功');
                        window.location.href="/user/meword";
                        return false;
                    }else if(res==2){
                        alert('添加失败');
                        return false;
                    }
                }

            })
        })
    </script>
@endsection