<?php
//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/','education\EducationController@index');
Route::prefix('/course')->group(function(){
    Route::get('/list','course\CourseController@lists');
});