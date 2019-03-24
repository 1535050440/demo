<?php
/**
 * Created by PhpStorm.
 * User: 12155
 * Date: 2019/3/8
 * Time: 14:56
 */

namespace app\exception;


use Throwable;

class BaseException extends \Exception
{
    /**
     * BaseException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}