<?php
//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/','education\EducationController@index');
Route::prefix('/course')->group(function(){
    Route::get('/list','course\CourseController@lists');
    Route::get('/coursecont','course\CourseController@coursecont');
    Route::get('/coursecont1','course\CourseController@coursecont1');
});