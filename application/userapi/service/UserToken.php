<?php
/**
 * Created by PhpStorm.
 * User: 12155
 * Date: 2019/3/23
 * Time: 16:21
 */

namespace app\userapi\service;

use app\exception\ParameException;
use think\facade\Config;

/**
 * 微信用户端获取token
 * Class UserToken
 * @package app\userapi\service
 */
class UserToken
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    /**
     * UserToken constructor.
     * @param $code
     */
    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = Config('wx.app_id');
        $this->wxAppSecret = Config('wx.secret');
        //  拼接url拼接访问微信接口
        $this->wxLoginUrl = 'https://api.weixin.qq.com/sns/jscode2session' . $this->wxAppID . $this->wxAppSecret . $this->code;
    }

    /**
     * @author:dsp
     * @param $code
     * @return bool|string
     * @throws ParameException
     * @date:2019/3/23 17:53
     */
    public function get($code)
    {
        //  发送get请求(字符串)
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result, true);

        if (empty($wxResult)) {
            throw new ParameException('获取session_key及openid异常，微信内部错误');
        }
        $loginFail = array_key_exists('errcode',$wxResult);
        if ($loginFail) {
            throw new ParameException($wxResult);
        } else {
            $this->grantToken($wxResult);
        }
        return $result;
    }

    /**
     * @author:dsp
     * @param $wxResult
     * @date:2019/3/23 17:52
     * @return mixed
     */
    private function grantToken($wxResult)
    {
        //  拿到openid
        //  检查当前openid是否已经存在        1.如果存在，则不做处理，       2.如果不存在那么新增一条user记录
        //  生成令牌，准备缓存数据，写入缓存
        //  把令牌返回到客户端去
        $openid = $wxResult['openid'];

        return $openid;
    }

}