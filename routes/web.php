<?php
<<<<<<< HEAD
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

=======
>>>>>>> 9aa571d401adaffef997e3d11d07eef68c3329d5
//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/','education\EducationController@index');
<<<<<<< HEAD

Route::get('/', function () {
    return view('welcome');

});
Route::get('teacher/login','Teacher\TeacherController@login');
Route::post('teacher/logindo','Teacher\TeacherController@logindo');

Route::prefix("user")->group(function (){
    Route::any("login","User\LoginController@index");
    Route::any("logindo","User\LoginController@logindo");
    Route::any("register","User\LoginController@register");
     Route::any("forgetpwd","User\LoginController@forgetpwd");
    Route::any("registerdo","User\LoginController@registerdo");
    Route::any("getpwdcode","User\LoginController@getpwdcode");
    Route::any("getcode","User\LoginController@getcode");
    Route::any("getpwdcode","User\LoginController@getpwdcode");
});


=======
Route::prefix('/course')->group(function(){
    Route::get('/list','course\CourseController@lists');
});
>>>>>>> 9aa571d401adaffef997e3d11d07eef68c3329d5
