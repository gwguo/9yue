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