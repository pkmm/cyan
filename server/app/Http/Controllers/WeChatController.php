<?php
/**
 * Created by PhpStorm.
 * User: pkmm
 * Date: 2017/10/14
 * Time: 17:17
 */

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestParameters;
use Illuminate\Http\Request;
use Log;

class WeChatController extends Controller
{
    public function __construct()
    {
        //todo
    }

    // 微信公众号使用，第三方sdk

    public static function wxLogin(Request $request)
    {
        $iv = $request->get('iv');
        $code = $request->get('code');
        $encryptedData = $request->get('encrypted_data');
        if (empty($iv) || empty($code) || empty($encryptedData)) {
            throw new InvalidRequestParameters('Invalid parameters.');
        }
        return ['ss' => 'sss'];
    }

    public function serve()
    {
        Log::info('request arrived.');
        $app = app('wechat.official_account');

        $app->server->push(function ($message) {
            return '人生的意义是什么？';
        });

        return $app->server->serve();
    }

}
