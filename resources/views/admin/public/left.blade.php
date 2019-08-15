<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        {{--<li class="layui-nav-item layui-nav-itemed">--}}
        <li class="layui-nav-item">
          <a href="javascript:;">管理员管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/admin/adminuseradd">管理员添加</a></dd>
            <dd><a href="/admin/adminuserlist">管理员列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">教务管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/admin/teacher/tlist">教师列表</a></dd>
            <dd><a href="/admin/coursecateadd">课程分类添加</a></dd>
            <dd><a href="/admin/coursecatelist">课程分类列表</a></dd>
            <dd><a href="/admin/teacher/clist">课程列表</a></dd>
            <dd><a href="/admin/teacher/sectionlist">课程章节列表</a></dd>
            <dd><a href="/admin/teacher/periodlist">课时列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">资讯管理</a>
          <dl class="layui-nav-child">
            <dd><a href="/admin/advisory/cateadd">资讯分类添加</a></dd>
            <dd><a href="/admin/advisory/catelist">资讯分类列表</a></dd>
            <dd><a href="/admin/advisory/descadd">资讯内容添加</a></dd>
            <dd><a href="/admin/advisory/desclist">资讯列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">管理</a>
          <dl class="layui-nav-child">
            <dd><a href=""></a></dd>
          </dl>
        </li>
      </ul>
    </div>
  </div>