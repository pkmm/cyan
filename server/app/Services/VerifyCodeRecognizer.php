<?php
/**
 * Author: robotgg@126.com
 * Date: 2019/4/14 - 11:49
 */

namespace App\Services;

use App\Contracts\VerifyCodeRecognizeInterface;
use App\Utils\HttpRequestWrapper;
use GuzzleHttp\Client;

class VerifyCodeRecognizer implements VerifyCodeRecognizeInterface
{
    /**
     * @param string $imageStringContent
     * @return string
     * @throws \Exception
     */
    public function decode(string $imageStringContent): string
    {
        $client = new Client();
        $ret = HttpRequestWrapper::wrapper(function () use ($client, $imageStringContent) {
            $response = $client->post(env('VERIFY_CODE_SERVER'), [
                'multipart' => [
                    [
                        'name' => 'img',
                        'contents' => $imageStringContent,
                        'filename' => 'img'
                    ]
                ],
                'timeout' => 10,
                'verify' => false
            ])->getBody()->getContents();
            $response = json_decode($response);
            if ($response->code == 0) {
                return $response->data->text;
            }
            return '';
        });
        return $ret;
    }
}
