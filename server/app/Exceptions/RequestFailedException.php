<?php
/**
 * Author: robotgg@126.com
 * Date: 2018/12/13 - 23:57
 */

namespace App\Exceptions;

use Exception;

class RequestFailedException extends Exception
{
    public $errorCode;
    public $data = [];

    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message);
        $this->errorCode = $code;
    }

    public function setData($key, $val)
    {
        $this->data[$key] = $val;
    }
}
