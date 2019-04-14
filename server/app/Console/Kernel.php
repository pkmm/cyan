<?php

namespace App\Console;

use App\Console\Commands\MigrateStuInfoToUserTable;
use App\Console\Commands\TestOne;
use App\Console\Commands\TestTwo;
use App\Manager\ScheduleManager;
use App\Manager\ZcmuManager;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        TestOne::class,
        TestTwo::class,
        MigrateStuInfoToUserTable::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //        $this->notify($schedule);
        $schedule->command('test:one')->everyMinute()->runInBackground();
        $schedule->command('test:two')->everyTenMinutes()->runInBackground()->withoutOverlapping();
        $schedule->call(function () {
            self::getZcmuNewInfos();
        })->everyTenMinutes();
    }

    private function getZcmuNewInfos()
    {
        ZcmuManager::retrieveNewInfos();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }

    private function notify(Schedule $schedule)
    {
        $schedule->call(function () {
            Log::info('开始任务notify 时间是: ' . date('Y-m-d H:i:s'));
            ScheduleManager::dailyNotify();
            Log::info('任务结束notify 时间是: ' . date('Y-m-d H:i:s'));
        })->everyMinute()->runInBackground();
    }
}
