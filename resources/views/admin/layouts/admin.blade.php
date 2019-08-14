<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>layout 后台大布局 - Layui</title>
  <link rel="stylesheet" href="/admin/layui/css/layui.css">
  <script src="{{asset('/admin/layui/layui.js')}}"></script>
  <script src="{{asset('/js/jquery.js')}}"></script>
</head>
<body class="layui-layout-body">
  @include('admin/public/top')
  @include('admin/public/left')

  <div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">@yield('content')</div>
  </div>
  @include('admin/public/bottom')
  
  
</div>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});
</script>
</body>
</html>
