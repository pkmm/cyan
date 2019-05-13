<?php

namespace App\Jobs;

use App\Contracts\StudentInterface;
use App\Contracts\VerifyCodeRecognizeInterface;
use App\Manager\StudentManager;
use App\Model\Student;
use App\Services\CanNotDecodeViewStateException;
use App\Services\GetSchoolReportException;
use App\Services\GetUrlOfGetSchoolReportFailedException;
use App\Services\PasswordWrongException;
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

    /** @var int */
    private $studentId;

    public function __construct(int $studentId)
    {
        $this->studentId = $studentId;
    }

    public function handle(VerifyCodeRecognizeInterface $verifyCodeRecognize)
    {
        Log::info("queue[$this->queue]开始执行啦");
        $student = Student::whereId($this->studentId)->first();
        $educationSystem = new ZcmuEducationSystem(
            $student,
            $verifyCodeRecognize
        );
        $startAt = microtime(true);
        $msg = 'success';
        $count = 0;
        $tries = 3;
        while ($tries-- > 0) {
            try {
                $schoolReports = $educationSystem->getSchoolReport();
                $count = $student->updateStudentSchoolReport($schoolReports);
                break;
            } catch (PasswordWrongException $e) {
                $student->can_sync = 0;
                $student->save();
                $msg = $e->getMessage();
                Log::info(
                    "studentId {$student->getStudentNumber()} : => " . $e->getMessage());
                break;
            } catch (\Exception $e) {
                $msg = $e->getMessage();
                Log::info(
                    "studentId {$student->getStudentNumber()} : => " . $e->getMessage());
            }
        }
        $endAt = microtime(true);
        $costTime = sprintf('%fs', $endAt - $startAt);
        StudentManager::saveSyncStudentScoreLog(
            $student->getUid(),
            $student->getStudentNumber(),
            $costTime,
            $msg,
            $count
        );
    }
}
