<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/verify', 'FormController@verify');
Route::get('/verify/getFileWebServerUrl', 'FormController@getFileWebServerUrl');

// 获取验证码
Route::get('/captcha', function() {
    $res = app('captcha')->create('default', true);

    return $res; // 用JSON格式后输出, 不然有些字符会被转义.
});
