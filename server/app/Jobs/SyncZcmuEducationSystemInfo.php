<?php

namespace App\Jobs;

use App\Contracts\StudentInterface;
use App\Contracts\VerifyCodeRecognizeInterface;
use App\Services\ZcmuEducationSystem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncZcmuEducationSystemInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var StudentInterface */
    private $student;

    public function __construct(StudentInterface $student)
    {
        $this->student = $student;
    }

    public function handle(VerifyCodeRecognizeInterface $verifyCodeRecognize)
    {
        $educationSystem = new ZcmuEducationSystem(
            $this->student,
            $verifyCodeRecognize
        );
        $schoolReports  = $educationSystem->getSchoolReport();
        $this->student->updateStudentSchoolReport($schoolReports);
    }
}
