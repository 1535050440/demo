<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/3/24
 * Time: 23:33
 */

namespace app\userapi\service;


use think\facade\Config;

class Token
{
    public static function createToken()
    {
        //  随机字符串
        $token = getRandString();
        //  盐
        $token_salt = Config::get('secure.token_salt');
        return md5($token . $token_salt);
    }
}