<?php
/**
 * Author: zccxxx79@gmail.com
 * DateAt: 2019/4/27 22:36
 */

namespace App\Exceptions;

use App\Constants\ErrorCodes;

class UserNotFoundException extends RequestFailedException
{
    public function __construct($message = "")
    {
        parent::__construct($message, ErrorCodes::USER_NOT_FOUND);
    }
}
