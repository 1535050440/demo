<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::any('demo', 'userapi/v1.Login/demo');


//  测试api
Route::any('userapi/login/demo','userapi/v1.Login/demo');

//  登陆api
Route::any('login', 'userapi/v1.Login/login');
Route::post('userapi/login/login','userapi/v1.Login/login');

//  用户api
Route::post('userapi/user/updateUserInfo','userapi/v1.User/updateUserInfo');
Route::get('userapi/user/show','userapi/v1.User/show');



















return [

];
