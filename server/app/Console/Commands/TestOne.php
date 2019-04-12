<?php

namespace App\Console\Commands;

use App\Utils\MonitorUtil;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;

class TestOne extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:one';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $url = 'https://api.52pkm.cn/zf/get_failed_lessons';
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
        if (count(json_decode($ret, true)) != 10) {
            MonitorUtil::notify(['text' => 'api 存在问题']);
        }
    }
}
