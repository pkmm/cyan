<?php
/**
 * Author: robotgg@126.com
 * Date: 2018/12/13 - 23:54
 */

namespace App\Exceptions;

use App\Constants\ErrorCode;

class InvalidRequestParameters extends RequestFailedException
{
    public function __construct($message)
    {
        parent::__construct($message, ErrorCode::INVALID_REQUEST_PARAMETERS);
    }
}
