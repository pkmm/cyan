<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/18
 * Time: 21:58
 */

namespace App\Model;

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
class Student extends Model
{
    public $table = 'students';

    public function scores()
    {
        return $this->hasMany(Score::class, 'student_id', 'id');
    }
}
