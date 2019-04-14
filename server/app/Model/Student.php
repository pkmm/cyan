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
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Score[] $scores
 * @method static Builder|Student whereCreatedAt($value)
 * @method static Builder|Student whereId($value)
 * @method static Builder|Student whereName($value)
 * @method static Builder|Student whereNum($value)
 * @method static Builder|Student wherePwd($value)
 * @method static Builder|Student whereUpdatedAt($value)
 * @method static Builder|Student whereUserId($value)
 * @mixin Eloquent
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

    public function updateStudentSchoolReport(array $schoolReports)
    {
        if (count($schoolReports) == $this->scores()->count()) {
            return;
        }
        $data = [];
        foreach ($schoolReports as $schoolReport) {
            $data[] = [
                'xn' => $schoolReport[0],
                'xq' => $schoolReport[1],
                'kcmc' => $schoolReport[2],
                'type' => $schoolReport[3],
                'xf' => $schoolReport[4],
                'jd' => $schoolReport[5],
                'cj' => $schoolReport[6],
                'bkcj' => $schoolReport[7],
                'cxcj' => $schoolReport[8],
                'student_id' => $this->id,
            ];
        }

        $this->scores()->insert($data);
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
}
