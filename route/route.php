<?php
use \think\facade\Route;
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//  登陆api
Route::any('login', 'userapi/v1.Login/login');
//  用户登陆接口
Route::post('userapi/v1/login/login','userapi/v1.Login/login');
//  获取当前用户信息
Route::post('userapi/v1/user/show','userapi/v1.User/show');
//  修改当前用户信息
Route::post('userapi/v1/user/update_user_info','userapi/v1.User/updateUserInfo');














Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::any('demo', 'userapi/v1.Login/demo');


//  测试api
Route::any('userapi/login/demo','userapi/v1.Login/demo');

return [

];
