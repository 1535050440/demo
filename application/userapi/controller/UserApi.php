<?php
/**
 * Created by PhpStorm.
 * User: 12155
 * Date: 2019/3/8
 * Time: 14:39
 */

namespace app\userapi\controller;

use app\common\model\UserModel;
use app\exception\ParameException;
use app\exception\PowerException;
use think\facade\Cache;

/**
 * 用户端-基类控制器
 * Class UserApi
 * @package app\userapi\controller
 */
class UserApi
{
    /**
     * 不需要使用token的方法
     * @var array
     */
    protected $no_need_token = [

    ];
    /**
     * UserApi constructor.
     */
    public function __construct()
    {
        $checkLogin = $this->checkLogin();

        if ($checkLogin) {

            $token = request()->header('token')?request()->header('token'):request()->param('token');

            if (empty($token)) {
                throw new ParameException('登陆参数错误');
            }

            //  检查当前缓存是否失效
            $user_id = Cache::get($token);
            if (empty($user_id)) {
                throw new PowerException('登陆超时，请重新登陆');
            }

            $userFind = UserModel::get($user_id);

            //  保存到request对象中
            request()->user = $userFind;
        }
    }

    /**
     * 检查登陆
     * @author:dsp
     * @return bool
     * @date:2019/3/8 15:14
     */
    private function checkLogin()
    {
        $action = request()->action()?:'index';
        return !in_array($action, $this->no_need_token);

    }
    /**
     * 成功时-构造返回的结构体
     * @author:dsp
     * @param array $data
     * @param string $message
     * @param string $code
     * @date:2019/3/8 14:46
     */
    public function success($data = [], $message = '请求成功', $code = '200')
    {
        $result = [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];

        echo json_encode($result);
        exit;
    }
}