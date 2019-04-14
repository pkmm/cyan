<?php
/**
 * Author: robotgg@126.com
 * Date: 2019/4/14 - 11:54
 */

namespace App\Utils;

// 提供网络调用的 错误处理， 失败重试机制

use Closure;
use Exception;
use Log;

class HttpRequestWrapper
{
    /**
     * @param Closure $func
     * @param int $retry
     * @param bool $throwException
     * @return mixed|null
     * @throws Exception
     */
    public static function wrapper(Closure $func, int $retry = 3, bool $throwException = true)
    {
        $ret = null;
        while ($retry-- > 0) {
            try {
                $ret = $func();
            } catch (Exception $e) {
                Log::error($e->getMessage());
                if ($throwException) {
                    throw $e;
                }
            }
        }
        return $ret;
    }
}