<<<<<<< HEAD
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
