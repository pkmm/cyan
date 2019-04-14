<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $info;

    /**
     * Create a new job instance.
     *
     * @param string $info
     */
    public function __construct(string $info)
    {
        $this->info = $info;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        var_dump("任务开始执行了" . $this->info);
        sleep(random_int(1, 2));
        var_dump("任务执行结束： " . $this->info);
        Log::info('任务结束：' . $this->info);
    }
}
