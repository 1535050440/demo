<?php
/**
 * Created by PhpStorm.
 * User: 12155
 * Date: 2019/3/8
 * Time: 18:52
 */

namespace app\exception;


use Throwable;

class Exception extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}