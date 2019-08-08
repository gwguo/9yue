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
<<<<<<< HEAD
});
Route::get('teacher/login','Teacher\TeacherController@login');
Route::post('teacher/logindo','Teacher\TeacherController@logindo');
=======
});    
>>>>>>> 098b5a3a7f78c54070d968eeb740b594245ccc6f
