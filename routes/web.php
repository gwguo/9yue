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
<<<<<<< HEAD

<<<<<<< HEAD
Route::get("/test/abc",'Test\TestController@abc');
<<<<<<< HEAD

=======
=======
Route::get("/test/abc",'Test\TestController@abc');//as
>>>>>>> 0a458b105e65644a849ae548a027b7ebf92e9098
=======
Route::get("/test/abc",'Test\TestController@abc');
>>>>>>> c416b47832df1c2bb3a9423d6866203911d7f8bf
Route::get('/a','log\LogController@redisC');
>>>>>>> a9bf2071938c9e1fb1e62703dbdcbd02c5375e58
Route::prefix('/pay')->group(function(){
    Route::get('/pay','pay\PayContrller@pay');
    Route::get('/alipay','alipay\AlipayController@pay');
});
Route::prefix('/user')->group(function(){
    Route::post('/reg','log\LogController@reg');
    Route::post('/login','log\LogController@login');
});
