<?php
/**
 * Author: robotgg@126.com
 * Date: 2018/12/13 - 23:44
 */

namespace App\Constants\enums;

class Role
{
    const NONE = 0;
    const ANONYMOUS = 1;
    const USER = 2;
    const ADMIN = 3;

    public static function verify($value)
    {
        return in_array($value, self::values());
    }

    public static function values()
    {
        return [
            self::NONE,
            self::ANONYMOUS,
            self::USER,
            self::ADMIN
        ];
    }

    public static function getName($val)
    {
        if ($val == self::NONE) {
            return 'None';
        } elseif ($val == self::ANONYMOUS) {
            return 'ANONYMOUS';
        } elseif ($val == self::USER) {
            return 'USER';
        } elseif ($val == self::ADMIN) {
            return 'ADMIN';
        }
        return 'NULL';
    }
}
