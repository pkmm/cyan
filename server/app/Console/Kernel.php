<?php

namespace App\Console;

use App\Console\Commands\MigrateStuInfoToUserTable;
use App\Console\Commands\CheckGolangServiceStatus;
use App\Console\Commands\ResetStudentCanSyncFlag;
use App\Console\Commands\SyncStudentScores;
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
        CheckGolangServiceStatus::class,
        SyncStudentScores::class,
        MigrateStuInfoToUserTable::class,
        ResetStudentCanSyncFlag::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('check:go_service')->everyMinute()->runInBackground();

        $schedule->command('sync:student_scores')
                 ->everyTenMinutes()
                 ->runInBackground()
                 ->withoutOverlapping();

        $schedule->command('')->dailyAt('23:55');

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
}
