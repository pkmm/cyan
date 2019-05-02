<?php

namespace App\Model;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\SyncStudentScoreDetail
 *
 * @property int $id
 * @property int $student_id
 * @property string $student_number
 * @property int $lesson_count
 * @property string $cost_time
 * @property string $status 同步状态描述
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|SyncStudentScoreDetail whereCostTime($value)
 * @method static Builder|SyncStudentScoreDetail whereCreatedAt($value)
 * @method static Builder|SyncStudentScoreDetail whereId($value)
 * @method static Builder|SyncStudentScoreDetail whereLessonCount($value)
 * @method static Builder|SyncStudentScoreDetail whereStatus($value)
 * @method static Builder|SyncStudentScoreDetail whereStudentId($value)
 * @method static Builder|SyncStudentScoreDetail whereStudentNumber($value)
 * @method static Builder|SyncStudentScoreDetail whereUpdatedAt($value)
 * @mixin Eloquent
 */
class SyncStudentScoreDetail extends Model
{
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
