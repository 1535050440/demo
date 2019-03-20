<?php
/**
 * Created by PhpStorm.
 * User: 12155
 * Date: 2019/3/8
 * Time: 15:47
 */

namespace app\userapi\controller\v1;

use app\userapi\controller\UserApi;
use think\Request;

/**
 * 用户控制器
 * Class User
 * @package app\userapi\controller\v1
 */
class User extends UserApi
{
    /**
     * User constructor.
     * @throws \app\exception\ParameException
     * @throws \app\exception\PowerException
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 修改用户信息
     * @author:dsp
     * @param Request $request
     * @date:2019/3/8 15:48
     */
    public function updateUserInfo(Request $request)
    {
        $cover = $request->param('cover');
        $city = $request->param('city');
        $sex = $request->param('sex');
        $nick_name = $request->param('nick_name');
      
        $userFind = $request->user;

        if ($cover) $userFind->cover = $cover;
        if ($city) $userFind->city = $city;
        if ($sex) $userFind->sex = $sex;
        if ($nick_name) $userFind->nick_name = base64_encode($nick_name);
        $userFind->save();
      
        $this->success($userFind);
    }

    /**
     * 获取当前用户信息
     * @author:dsp
     * @param Request $request
     * @date:2019/3/8 16:01
     */
    public function show(Request $request)
    {
        $this->success($request->user);
    }

}