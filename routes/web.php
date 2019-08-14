<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 804b5c7a3cb16324669a66a5fe29919ad4682318
<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
<<<<<<< HEAD
Route::get('/', function () {
    return view('index');

});
//登录
Route::get('teacher/login', 'Teacher\TeacherController@login');
Route::post('teacher/logindo', 'Teacher\TeacherController@logindo');
//首页
Route::get('teacher/index', 'Teacher\TeacherController@index');
//注册
Route::get('teacher/reg', 'Teacher\TeacherController@reg');
Route::post('teacher/email', 'Teacher\TeacherController@email');
Route::post('teacher/regdo', 'Teacher\TeacherController@regdo');
//修改密码
Route::get('teacher/resetpwd', 'Teacher\TeacherController@resetpwd');
Route::post('teacher/resetpwds', 'Teacher\TeacherController@resetpwds');
//退出
Route::get('teacher/loginout', 'Teacher\TeacherController@loginout');
//忘记密码
Route::get('teacher/forgetpwd', 'Teacher\TeacherController@forgetpwd');
Route::post('teacher/forgetpwds', 'Teacher\TeacherController@forgetpwds');
//新密码
Route::get('teacher/newpwd', 'Teacher\TeacherController@newpwd');
Route::post('teacher/newpwds', 'Teacher\TeacherController@newpwds');
//个人中心
Route::get('teacher/myuser', 'Teacher\TeacherController@myuser');
Route::post('teacher/myusers', 'Teacher\TeacherController@myusers');
Route::post('teacher/userupload', 'Teacher\TeacherController@userupload');
Route::get('teacher/meuser', 'Teacher\TeacherController@meuser');
//课程
Route::get('teacher/course', 'Teacher\TeacherController@course');
Route::post('teacher/courseadd', 'Teacher\TeacherController@courseadd');
Route::get('teacher/courselist', 'Teacher\TeacherController@courselist');
Route::post('teacher/coursedel', 'Teacher\TeacherController@coursedel');
Route::get('teacher/courseup', 'Teacher\TeacherController@courseup');
Route::post('teacher/courseupdo', 'Teacher\TeacherController@courseupdo');
//章节
Route::get('teacher/section', 'Teacher\TeacherController@section');
Route::post('teacher/sectionadd', 'Teacher\TeacherController@sectionadd');
Route::get('teacher/sectionlist', 'Teacher\TeacherController@sectionlist');
Route::post('teacher/sectiondel', 'Teacher\TeacherController@sectiondel');
Route::get('teacher/sectionup', 'Teacher\TeacherController@sectionup');
Route::post('teacher/sectionupdo', 'Teacher\TeacherController@sectionupdo');
//小节
Route::get('teacher/son', 'Teacher\TeacherController@son');
Route::post('teacher/sonadd', 'Teacher\TeacherController@sonadd');
Route::get('teacher/sonlist', 'Teacher\TeacherController@sonlist');
Route::post('teacher/sondel', 'Teacher\TeacherController@sondel');
Route::get('teacher/sonup', 'Teacher\TeacherController@sonup');
Route::post('teacher/sonupdo', 'Teacher\TeacherController@sonupdo');
//课时
Route::get('teacher/period', 'Teacher\TeacherController@period');
Route::post('teacher/videoupload', 'Teacher\TeacherController@videoupload');
Route::post('teacher/periodadd', 'Teacher\TeacherController@periodadd');
Route::get('teacher/periodlist', 'Teacher\TeacherController@periodlist');
Route::post('teacher/perioddel', 'Teacher\TeacherController@perioddel');
Route::get('teacher/periodup', 'Teacher\TeacherController@periodup');
Route::post('teacher/periodupdo', 'Teacher\TeacherController@periodupdo');
//作业
Route::get('teacher/work', 'Teacher\TeacherController@work');
Route::post('teacher/workadd', 'Teacher\TeacherController@workadd');
Route::get('teacher/worklist', 'Teacher\TeacherController@worklist');
Route::post('teacher/workdel', 'Teacher\TeacherController@workdel');
Route::get('teacher/workup', 'Teacher\TeacherController@workup');
Route::post('teacher/workupdo', 'Teacher\TeacherController@workupdo');
//问答
Route::get('teacher/reply', 'Teacher\TeacherController@reply');
Route::post('teacher/replyadd', 'Teacher\TeacherController@replyadd');
=======

Route::get('/', function () {
    return view('welcome');
});
Route::get('/','education\EducationController@index');

Route::get('/teacher', function () {
    return view('welcome');

});
Route::get('teacher/login','Teacher\TeacherController@login');
Route::post('teacher/logindo','Teacher\TeacherController@logindo');
Route::prefix("user")->group(function (){
    Route::any("login","User\LoginController@index");
    Route::any("register","User\LoginController@register");
});


//管理后台
Route::prefix('/admin')->group(function(){
    //登陆页面
    Route::match(['post','get'],'adminlogin','Admin\LoginController@adminLogin');
    Route::post('adminlogout','Admin\LoginController@adminLogout');  //退出
    //后台首页
    Route::get('adminindex','Admin\AdminController@adminIndex')->middleware('checkadminuserlogin');
    //管理员管理
    //管理员添加
    Route::match(['get','post'],'adminuseradd','Admin\AdminController@adminuseradd')->middleware('checkadminuserlogin');
    Route::get('adminuserlist','Admin\AdminController@adminuserlist')->middleware('checkadminuserlogin');   //管理员列表
    Route::post('adminuserdel','Admin\AdminController@adminuserdel')->middleware('checkadminuserlogin');   //管理员删除
    Route::match(['get','post'],'adminedit','Admin\AdminController@adminedit')->middleware('checkadminuserlogin');

    //教师管理
    //教师列表
    Route::get('teacher/tlist','Admin\TeacherController@teacherList');
    //审核通过
    Route::post('teachercheckok','Admin\TeacherController@teachercheckok');
    Route::any('teachercheckno','Admin\TeacherController@teachercheckno');  //审核不通过
    //课程列表
    Route::any('teacher/clist','Admin\TeacherController@courselist');
    //课程审核通过
    Route::post('coursecheckok','Admin\TeacherController@coursecheckok');
    //课程审核不通过
    Route::any('coursecheckno','Admin\TeacherController@coursecheckno');
    //课程分类添加
    Route::any('coursecateadd','Admin\TeacherController@coursecateadd');
    Route::any('coursecatelist','Admin\TeacherController@coursecatelist');
    Route::any('coursecateedit','Admin\TeacherController@coursecateedit');
    Route::any('coursecatedel','Admin\TeacherController@coursecatedel');

    //课程审核管理
    Route::get('teacher/courselist','Admin\TeacherController@courselist');


    //资讯管理
    //资讯分类添加
    Route::any('advisory/cateadd','Admin\AdvisoryController@cateadd');
    Route::any('advisory/catelist','Admin\AdvisoryController@catelist');  //分类列表
    Route::any('advisory/cateedit','Admin\AdvisoryController@cateedit');  //分类修改
    Route::any('advisory/catedel','Admin\AdvisoryController@catedel');  //分类删除

    Route::any('advisory/descadd','Admin\AdvisoryController@descadd');  //资讯内容添加
    Route::any('advisory/desclist','Admin\AdvisoryController@desclist');  //资讯内容列表
    Route::any('advisory/descdel','Admin\AdvisoryController@descdel');  //资讯内容删除
    Route::any('advisory/descedit','Admin\AdvisoryController@descedit');  //资讯内容修改



    Route::get('test','Admin\LoginController@test');   //测试
});


//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/','education\EducationController@index');
Route::prefix('/course')->group(function(){
    Route::get('/list','course\CourseController@lists');
});
>>>>>>> 804b5c7a3cb16324669a66a5fe29919ad4682318
