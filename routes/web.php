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

    // 分组
    $router->post('add_group', 'HomeController@addGroup');
    $router->put('edit_group', 'HomeController@editGroup');
    $router->delete('del_group/{id}', 'HomeController@delGroup');

    // 用户
    $router->post('add_member', 'HomeController@addMember');
    $router->put('edit_member', 'HomeController@editMember');
    $router->delete('del_member/{id}', 'HomeController@delMember');
});

// test
// Route::get('test', function () {
//     $member = \DB::table('members')->where('id', '<', 96)->get()->chunk(48);

//     foreach ($member as $key => $value) {
//     	foreach ($value as $k => $v) {
//     		$data[$k] = [
//     			'name' => $v->name,
//     			'number' => $v->number,
//     			'id_card' => $v->id_card
//     		];
//     		if ($key == 0) {
//     			$data[$k]['group_id'] = 3;
//     		} else {
//     			$data[$k]['group_id'] = 4;
//     		}
//     		\DB::table('members')->insert($data[$k]);
//     	}
//     }

//     foreach ($member as $key1 => $value1) {
//     	foreach ($value1 as $k1 => $v1) {
//     		$data[$k1] = [
//     			'name' => $v1->name,
//     			'number' => $v1->number,
//     			'id_card' => $v1->id_card
//     		];
//     		if ($key1 == 0) {
//     			$data[$k1]['group_id'] = 5;
//     		} else {
//     			$data[$k1]['group_id'] = 6;
//     		}
//     		\DB::table('members')->insert($data[$k1]);
//     	}
//     }
    

// });

