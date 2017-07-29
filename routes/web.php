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
Route::any('/wechat','\App\Http\Controllers\WechatController@serve');
Route::any('/wechat/qunfa','\App\Http\Controllers\Wechat@qunfa');
Route::any('/wechat/tuwen','\App\Http\Controllers\Wechat@tuwen');
Route::any('/wechat/moban','\App\Http\Controllers\Wechat@moban');
//Route::group(['middleware' => ['web','wechat.oauth']],function (){
    Route::any('/user/profile','\App\Http\Controllers\Wechat@shouquan');
    Route::any('/oauth_callback','\App\Http\Controllers\Wechat@callback');
//    Route::any('/user/profile',function (){
//        return view('user/profile');
//    });
//});