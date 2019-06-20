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
Route::prefix('/pay')->group(function(){
    Route::get('/pay','pay\PayContrller@pay');
    Route::get('/alipay','alipay\AlipayController@pay');
});
Route::prefix('/user')->group(function(){
    Route::post('/reg','log\LogController@reg');
    Route::post('/login','log\LogController@login');
    Route::post('/index','log\LogController@index');
    Route::post('/sendEmail','log\LogController@sendEmail');
    Route::post('/code','log\LogController@code');
    Route::post('/password','log\LogController@password');
});
Route::prefix('/send')->group(function(){
    Route::get('/sendEmail','send\sendEmailController@sendEmail');
});
