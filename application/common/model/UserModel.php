<?php
/**
 * Created by PhpStorm.
 * User: 12155
 * Date: 2019/3/8
 * Time: 15:06
 */

namespace app\common\model;


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
}