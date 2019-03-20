<?php
/**
 * Created by PhpStorm.
 * User: 12155
 * Date: 2019/3/8
 * Time: 15:25
 */

namespace app\exception;

use Throwable;

/**
 * 权限-异常
 * Class PowerException
 * @package app\exception
 */
class PowerException extends BaseException
{
    /**
     * PowerException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '抱歉，您没有对应的权限！', $code = 4002, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}