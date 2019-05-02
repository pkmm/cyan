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
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Score whereBkcj($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Score whereCj($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Score whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Score whereCxcj($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Score whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Score whereJd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Score whereKcmc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Score whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Score whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Score whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Score whereXf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Score whereXn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Score whereXq($value)
 * @mixin \Eloquent
 */
class Score extends Model
{
    public $table = 'scores';
    public $guarded = [];
}
