<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/18
 * Time: 21:58
 */

namespace App\Model;

use App\Contracts\StudentInterface;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Student
 *
 * @property int $id
 * @property int $user_id
 * @property string $num
 * @property string $pwd
 * @property string|null $name
 * @property int $can_sync
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Score[] $scores
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Student whereCanSync($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Student whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Student whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Student wherePwd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Student whereUserId($value)
 * @mixin \Eloquent
 */
class Student extends Model implements StudentInterface
{
    public $table = 'students';
    protected $guarded = [];

    public function scores()
    {
        return $this->hasMany(Score::class, 'student_id', 'id');
    }

    public function getStudentNumber(): string
    {
        return $this->num;
    }

    public function getStudentPassword(): string
    {
        return $this->pwd;
    }

    public function updateStudentSchoolReport(array $schoolReports): int
    {
        if (count($schoolReports) == $this->scores()->count()) {
            // 在成绩数量没变化的情况下， 随机的更新成绩
            $x = mt_rand(1, 100);
            if ($x > 2) {
                return count($schoolReports);
            }
            $this->scores()->delete();
        }
        $data = [];
        foreach ($schoolReports as $schoolReport) {
            $data[] = [
                'xn' => $schoolReport[0],
                'xq' => $schoolReport[1],
                'kcmc' => $schoolReport[2],
                'type' => $schoolReport[3],
                'xf' => (double)$schoolReport[4],
                'jd' => (double)$schoolReport[5],
                'cj' => $schoolReport[6],
                'bkcj' => $schoolReport[7],
                'cxcj' => $schoolReport[8],
                'student_id' => $this->id,
            ];
        }

        $this->scores()->insert($data);
        return sizeof($data);
    }

    public function setStudentName(string $studentName)
    {
        $this->update([
            'name' => $studentName,
        ]);
    }

    public function getStudentName(): string
    {
        return $this->name;
    }

    public function getUid(): int
    {
        return $this->id;
    }

    public function syncDetail()
    {
        return $this->hasOne(SyncStudentScoreDetail::class, 'student_id', 'id');
    }
}
