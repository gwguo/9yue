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
=======
Route::get('/', function () {
    return view('welcome');

});
Route::get('teacher/login','Teacher\TeacherController@login');
Route::post('teacher/logindo','Teacher\TeacherController@logindo');
<<<<<<< HEAD
Route::prefix("user")->group(function (){
    Route::any("login","User\LoginController@index");
    Route::any("register","User\LoginController@register");
});
=======
=======
});    
>>>>>>> 098b5a3a7f78c54070d968eeb740b594245ccc6f
>>>>>>> 5e8ccfc45db616b067a325e4484fecf434ed172a
>>>>>>> 1cbffb1bd10f5e1482dc260b126c0b2f60172e2f
