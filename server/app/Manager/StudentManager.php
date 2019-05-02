<?php
/**
 * Author: zccxxx79@gmail.com
 * DateAt: 2019/5/1 21:02
 */

namespace App\Manager;

use App\Contracts\StudentInterface;
use App\Model\Score;
use App\Model\Student;
use App\Model\SyncStudentScoreDetail;
use App\Model\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class StudentManager
{
    /**
     * @param Student $student
     * @return Score[]|Builder[]|Collection
     */
    public static function getScores(Student $student)
    {
        $scores = Score::whereStudentId($student->id)->get();
        return $scores;
    }

    /**
     * @param User $user
     * @param string $studentNumber
     * @param string $password
     * @return Student|Builder|Model|null
     */
    public static function setAccount(User $user, string $studentNumber, string $password)
    {
        $student = Student::whereUserId($user->id)->first();
        if (!$student) {
            $student = new Student();
            $student->user_id = $user->id;
            $student->num = $studentNumber;
            $student->pwd = $password;
            $student->save();
        } else {
            $student->num = $studentNumber;
            $student->pwd = $password;
            $student->save();
        }
        return $student;
    }

    /**
     * @param int $studentId
     * @param string $studentNumber
     * @param string $costTime
     * @param string $msg
     * @param int $lessonCount
     * @return SyncStudentScoreDetail
     */
    public static function saveSyncStudentScoreLog(
        int $studentId,
        string $studentNumber,
        string $costTime,
        string $msg,
        int $lessonCount
    ) {
        $log = SyncStudentScoreDetail::whereStudentId($studentId)->first();
        if (!$log) {
            $log = new SyncStudentScoreDetail();
            $log->student_id = $studentId;
            $log->student_number = $studentNumber;
        }

        $log->lesson_count = $lessonCount;
        $log->status = $msg;
        $log->cost_time = $costTime;
        $log->save();

        return $log;
    }

    /**
     * @param Student $student
     * @return SyncStudentScoreDetail|Builder|Model|null
     */
    public static function getSyncScoreDetail(Student $student)
    {
        $log = SyncStudentScoreDetail::whereStudentId($student->id)->first();
        return $log;
    }
}
