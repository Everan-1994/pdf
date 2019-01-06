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

Route::get('/form', function () {
    return view('form.index');
});

// 获取验证码
Route::get('/captcha', 'FormController@getImgCaptchaDTO');
//Auth::routes();

// 首页
Route::get('/home', 'HomeController@index')->name('home');
// 分组
Route::get('/group', 'HomeController@group')->name('group');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// 修改密码
Route::get('reset/password', function () {
    return view('auth.reset');
})->name('reset.password');
Route::post('reset/password', 'AdminController@reset')->name('reset.password');

// 后台接口
Route::group(['middleware' => 'auth:web'], function ($router) {

    // 新增分组
    $router->post('add_group', 'HomeController@addGroup');
});

