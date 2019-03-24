<?php
/**
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/3/24
 * Time: 23:52
 */

namespace app\exception;


use Throwable;

class TokenException extends BaseException
{
    public function __construct($message = 'Token已过期或Token无效', $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}