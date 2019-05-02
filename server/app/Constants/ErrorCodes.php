<?php
/**
 * Author: robotgg@126.com
 * Date: 2018/12/13 - 23:53
 */

namespace App\Constants;

class ErrorCodes
{
    const SUCCESS = 0;
    const INNER_ERROR = 1000;
    const INVALID_REQUEST_PARAMETERS = 10001;
    const USER_NOT_LOGIN = 10002;
    const LOGIN_FAILED = 10003;
    const USER_NOT_FOUND = 10004;
    const USER_REGISTER_FAILED = 10005;
    const USERNAME_ALREADY_USED = 10006;
    const CAN_NOT_HAVE_STUDENT = 10007;
}
