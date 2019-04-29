<?php
/**
 * Author: zccxxx79@gmail.com
 * DateAt: 2019/4/30 0:55
 */

namespace App\Exceptions;

use App\Constants\ErrorCodes;

class UserExists extends RequestFailedException
{
    public function __construct($message = "")
    {
        parent::__construct($message, ErrorCodes::USERNAME_ALREADY_USED);
    }
}
