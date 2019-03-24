<?php

namespace app\userapi\model;

class UserModel extends BaseModel
{
    //  表名
    protected $name = 'user';

    /**
     * 自动解码base64
     * @return bool|string
     */
    public function getNickNameAttr()
    {
        return htmlentities(base64_decode($this->getData('nick_name')));
    }

    /**
     * @param $openid
     * @return array|\PDOStatement|string|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getbyOpenID($openid)
    {
        $user = self::where('openid','=',$openid)
            ->find();

        return $user;
    }
}
