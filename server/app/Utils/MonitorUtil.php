<?php
/**
 * @Author zhang.chuancheng <zhang.chuancheng@danatech.com>
 * Date 2019/1/10
 */

namespace App\Utils;

use Carbon\Carbon;
use GuzzleHttp\Client;

class MonitorUtil
{
    // server 酱通知
    public static function notify(array $data)
    {
        $url = 'https://sc.ftqq.com/' . config('services.notify.fang_tang.sckey') . '.send';
        $client = new Client(['verify' => false, 'timeout' => 20.0]);
        $client->post($url, [
            'form_params' => $data,
        ]);

        self::notifyByWxpusher();
    }

    // wxpuser
    public static function notifyByWxpusher()
    {
        $url = config('services.notify.wx_pusher.server');
        $client = new Client(['verify' => false, 'timeout' => 30.0]);
        $client->post($url, [
            'json' => [
                'userIds' => [config('services.notify.wx_pusher.id')],
                'template_id' => 'lpO9UoVZYGENPpuND3FIofNueSMJZs0DMiU7Bl1eg2c',
                'data' => [
                    'first' => [
                        'value' => 'cgin service failed',
                        'color' => '#ff0000'
                    ],
                    'keyword1'=> [
                        'value' => 'High',
                        'color' => '#ff0000'
                    ],
                    'keyword2' => [
                        'value' => '服务器不可访问',
                        'color' => '#ff0000',
                    ],
                    'keyword3' => [
                        'value' => Carbon::now()->format('Y-m-d H:i:s'),
                        'color' => '#ff0000'
                    ],
                    'remark' => [
                        'value' => '快去修复吧',
                        'color' => '#ff0000'
                    ]
                ]
            ],
        ]);
    }
}
