<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/18
 * Time: 21:59
 */

namespace App\Model;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Score
 *
 * @property int $id
 * @property int $student_id
 * @property string $xn
 * @property int $xq
 * @property string $kcmc
 * @property string $type
 * @property string $cj
 * @property float $jd
 * @property float $xf
 * @property string|null $bkcj
 * @property string|null $cxcj
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Score whereBkcj($value)
 * @method static Builder|Score whereCj($value)
 * @method static Builder|Score whereCreatedAt($value)
 * @method static Builder|Score whereCxcj($value)
 * @method static Builder|Score whereId($value)
 * @method static Builder|Score whereJd($value)
 * @method static Builder|Score whereKcmc($value)
 * @method static Builder|Score whereStudentId($value)
 * @method static Builder|Score whereType($value)
 * @method static Builder|Score whereUpdatedAt($value)
 * @method static Builder|Score whereXf($value)
 * @method static Builder|Score whereXn($value)
 * @method static Builder|Score whereXq($value)
 * @mixin Eloquent
 */
class Score extends Model
{
    public $table = 'scores';
    public $guarded = [];
}
