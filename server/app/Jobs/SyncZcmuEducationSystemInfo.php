<?php

namespace App\Jobs;

use App\Contracts\StudentInterface;
use App\Contracts\VerifyCodeRecognizeInterface;
use App\Manager\StudentManager;
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
        $startAt = microtime(true);
        $msg = 'success';
        $count = 0;
        $tries = 3;
        while ($tries-- > 0) {
            try {
                $schoolReports = $educationSystem->getSchoolReport();
                $count = $this->student->updateStudentSchoolReport($schoolReports);
                break;
            } catch (CanNotDecodeViewStateException $e) {
                $msg = $e->getMessage();
                Log::info(
                    "studentId {$this->student->getStudentNumber()} : => " . $e->getMessage());
            } catch (GetSchoolReportException $e) {
                $msg = $e->getMessage();
                    Log::info(
                        "studentId {$this->student->getStudentNumber()} : => " . $e->getMessage());
            } catch (GetUrlOfGetSchoolReportFailedException $e) {
                $msg = $e->getMessage();
                    Log::info(
                        "studentId {$this->student->getStudentNumber()} : => " . $e->getMessage());
            }
        }
        $endAt = microtime(true);
        $costTime = sprintf('%fs', $endAt - $startAt);
        StudentManager::saveSyncStudentScoreLog(
            $this->student->getUid(),
            $this->student->getStudentNumber(),
            $costTime,
            $msg,
            $count
        );

    }
}
