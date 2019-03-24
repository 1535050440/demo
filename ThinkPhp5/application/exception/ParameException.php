<?php
/**
 * Created by PhpStorm.
 * User: 12155
 * Date: 2019/3/8
 * Time: 15:20
 */

namespace app\exception;


use Throwable;

/**
 * 参数-异常
 * Class ParameException
 * @package app\exception
 */
class ParameException extends BaseException
{
    /**
     * ParameException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '抱歉，参数错误', $code = 4003, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}