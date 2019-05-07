<?php

namespace App\Console\Commands;

use App\Jobs\SyncZcmuEducationSystemInfo;
use App\Model\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class SyncStudentScores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:student_scores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '同步教务系统成绩';

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
        User::with(['student'])
            ->orderBy('id', 'desc') // 优先更新新用户
            ->chunk(1000, function (Collection $users) {
            /** @var User $user */
            foreach ($users as $user) {
                $student = $user->student;
                if ($student) {
                    dispatch(new SyncZcmuEducationSystemInfo($student));
                }
            }
        });
    }
}
