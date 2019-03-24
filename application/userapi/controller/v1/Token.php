<?php
/**
 * Created by PhpStorm.
 * User: 12155
 * Date: 2019/3/23
 * Time: 16:11
 */

namespace app\userapi\controller\v1;


use app\exception\ParameException;
use app\userapi\service\UserToken;

class Token
{
    /**
     * 获取token接口
     * @author:dsp
     * @param $code
     * @return mixed
     * @throws ParameException
     * @date:2019/3/23 16:27
     */
    public function getToken($code)
    {
        if (empty($code)) {
            throw new ParameException('code参数不能为空');
        }

        $userToken = new UserToken($code);
        $token = $userToken->get();

        return $token;
    }

}