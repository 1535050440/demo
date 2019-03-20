<?php
/**
 * Created by PhpStorm.
 * User: 12155
 * Date: 2019/3/8
 * Time: 16:46
 */

namespace app\exception;

use think\exception\Handle;

class ExceptionHandle extends Handle
{
    /**
     * 渲染方式
     * @param \Exception $e
     * @return \think\Response
     */
    public function render(\Exception $e)
    {
        if ($e instanceof BaseException) {
            return json([
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ], $e->getCode());
        }
        return parent::render($e);
    }

}