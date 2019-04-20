<?php
/**
 * Author: zccxxx79@gmail.com
 * DateAt: 2019/4/20 13:48
 */

namespace App\Exceptions;


use App\Constants\ErrorCodes;

class UserNotLoginException extends RequestFailedException
{
    public function __construct($message = "Please login first.", $code = ErrorCodes::USER_NOT_LOGIN)
    {
        parent::__construct($message, $code);
    }
}