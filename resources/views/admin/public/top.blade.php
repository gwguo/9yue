<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">layui 后台布局</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->

    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item"><a id='logout' href="javascript:void(0)">退出</a></li>
    </ul>
  </div>
  <script>
    $('#logout').click(function(){
      var out = confirm('确定要退出吗');
      if (out) {
        $.ajax({
          url:"/admin/adminlogout",
          method:'post',
          success:function(msg){
              //layer.msg(msg.msg,{icon:msg.code});
              alert(msg.msg);
              location.href="/admin/adminlogin";
            //console.log(msg);
          },
          dataType:'json'
        });
      } else{
        return false;
      }
    });
  </script>