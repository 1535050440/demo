<?php

namespace app\userapi\model;

use think\Model;

class BaseModel extends Model
{
    //自动过滤掉不存在的字段
    protected $field = true;
}
