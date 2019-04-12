<?php
/**
 * Author: robotgg@126.com
 * Date: 2018/12/13 - 23:49
 */

namespace App\Manager;

use Redis;

class RedisManager
{
    /**
     * @param $key
     * @return bool|string
     */
    public static function getValue($key)
    {
        return Redis::get($key);
    }
}
