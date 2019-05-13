<?php

namespace App\Console\Commands;

use App\Model\Student;
use Illuminate\Console\Command;

class ResetStudentCanSyncFlag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:can_sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '重置同步成绩标志';

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
        Student::query()->update([
            'can_sync' => 1,
        ]);
    }
}
