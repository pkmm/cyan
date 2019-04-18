<?php

namespace App\Jobs;

use App\Contracts\StudentInterface;
use App\Contracts\VerifyCodeRecognizeInterface;
use App\Services\CanNotDecodeViewStateException;
use App\Services\GetSchoolReportException;
use App\Services\GetUrlOfGetSchoolReportFailedException;
use App\Services\ZcmuEducationSystem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

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
        $tries = 3;
        while ($tries-- > 0) {
            try {
                $schoolReports = $educationSystem->getSchoolReport();
                $this->student->updateStudentSchoolReport($schoolReports);
                break;
            } catch (CanNotDecodeViewStateException $e) {
                Log::info(
                    "studentId {$this->student->getStudentNumber()} : => " . $e->getMessage());
            } catch (GetSchoolReportException $e) {
                Log::info(
                    "studentId {$this->student->getStudentNumber()} : => " . $e->getMessage());
            } catch (GetUrlOfGetSchoolReportFailedException $e) {
                Log::info(
                    "studentId {$this->student->getStudentNumber()} : => " . $e->getMessage());
            }
        }
    }
}
