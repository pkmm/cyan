<?php
/**
 * Author: robotgg@126.com
 * Date: 2018/12/14 - 0:29
 */

namespace App\Utils;

class StringUtils
{
    /**
     * @param array $data
     * @return string
     */
    public static function signUrl(array $data): string
    {
        ksort($data);
        $str = '';
        $first = true;
        foreach ($data as $key => $val) {
            if ($key == 'sign') {
                continue;
            }
            if ($first) {
                $str .= $key . '=' . $val;
                $first = false;
            } else {
                $str .= sprintf('&%s=%s', $key, $val);
            }
        }
        return strtoupper(md5($str));
    }

    public static function convertString(string $str)
    {
        $str = str_replace("&mdash;", "——", $str);
        $str = str_replace("&ldquo;", "“", $str);
        $str = str_replace("&rdquo;", "”", $str);
        return $str;
    }

    public static function md5String(string ...$salts)
    {
        $str = implode('', $salts);
        return md5($str);
    }
}
