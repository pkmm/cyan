<?php

namespace App\Console\Commands;

use App\Model\Student;
use App\Model\User;
use DB;
use Illuminate\Console\Command;

class MigrateStuInfoToUserTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:stu2user';

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
        DB::table('stu')->orderBy('id')
            ->chunk(100, function ($stus) {
                foreach ($stus as $stu) {
                    $user = new User();
                    $user->salt = md5(uniqid());
                    $user->password = md5(uniqid('s') . mt_rand());
                    $user->username = '未知';
                    $user->save();
                    $student = new Student();
                    $student->user_id = $user->id;
                    $student->num = $stu->num ?? '';
                    $student->pwd = $stu->pwd ?? '';
                    $student->name = '未知';
                    $student->save();
                }
            });
    }
}
