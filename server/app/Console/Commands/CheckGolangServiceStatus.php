<?php

namespace App\Console\Commands;

use App\Utils\MonitorUtil;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;

class CheckGolangServiceStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:go_service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '检测 golang 写的service的状态';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = config('VERIFY_CODE_SERVER');
        $client = new Client();
        try {
            $rep = $client->get($url, ['verify' => false, 'timeout' => 10.0]);
            if ($rep->getStatusCode() != 200) {
                MonitorUtil::notify(['text' => 'api 无法访问']);
                return;
            }
        } catch (RequestException $e) {
            MonitorUtil::notify(['text' => 'api 无法访问', 'desp' => $e->getMessage()]);
            return;
        }

        $ret = $rep->getBody()->getContents();
        $jsonData = json_decode($ret);
        if (!isset($jsonData['code']) || $jsonData['code'] != 10006) {
            MonitorUtil::notify(['text' => 'api 存在问题']);
        }
    }
}
