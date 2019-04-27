<?php
/**
 * Author: zccxxx79@gmail.com
 * DateAt: 2019/4/27 22:45
 */

namespace App\Exceptions;

use App\Constants\ErrorCodes;

class UserRegisterFailedException extends RequestFailedException
{
    public function __construct($message = "")
    {
        parent::__construct($message, ErrorCodes::USER_REGISTER_FAILED);
    }
}
