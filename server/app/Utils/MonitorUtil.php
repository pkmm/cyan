<?php
/**
 * @Author zhang.chuancheng <zhang.chuancheng@danatech.com>
 * Date 2019/1/10
 */

namespace App\Utils;

use Config;
use GuzzleHttp\Client;

class MonitorUtil
{
    // server 酱通知
    public static function notify(array $data)
    {
        $url = 'https://sc.ftqq.com/' . Config::get('config.SCKEY') . '.send';
        $client = new Client(['verify' => false, 'timeout' => 20.0]);
        $client->post($url, [
            'form_params' => $data,
        ]);
    }
}
