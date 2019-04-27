<?php
/**
 * Author: zccxxx79@gmail.com
 * DateAt: 2019/4/27 22:32
 */

namespace App\Exceptions;

use App\Constants\ErrorCodes;

class LoginFailedException extends RequestFailedException
{
    public function __construct($message = "")
    {
        parent::__construct($message, ErrorCodes::LOGIN_FAILED);
    }
}
