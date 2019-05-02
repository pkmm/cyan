<?php
/**
 * Author: zccxxx79@gmail.com
 * DateAt: 2019/5/1 21:27
 */

namespace App\Exceptions;

use App\Constants\ErrorCodes;

class UserDonstHaveStudentException extends RequestFailedException
{
    public function __construct($message = "")
    {
        parent::__construct($message, ErrorCodes::CAN_NOT_HAVE_STUDENT);
    }
}
