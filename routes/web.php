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
//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/','education\EducationController@index');

//前台咨询
Route::prefix('/information')->group(function () {
    //商品条件
    Route::any('/information','information\InformationController@information');//全部咨询
    Route::any('/articlelist','information\InformationController@articlelist');//咨询内容
    Route::any('/teacherlist','information\InformationController@teacherlist');//指导老师
    Route::any('/chat','information\InformationController@chat');//指导窗口
    Route::any('/chatdo','information\InformationController@chatdo');//指导窗口

    Route::any('/couse','information\InformationController@course');//推荐课程
    Route::any('/courselist','information\InformationController@courselist');//课程列表
    Route::any('/coursecont','information\InformationController@coursecont');//进入购买课程
    Route::any('/buycoursecont','information\InformationController@buycoursecont');//获取购买信息


    Route::any('/order','order\OrderController@order');//订单




});
=======
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
>>>>>>> 518e962903bdedfd5a34599c9e3ed90a5cbfd2dc
