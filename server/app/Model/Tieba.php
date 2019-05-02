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
 * App\Model\Tieba
 *
 * @property int $id
 * @property int $tieba_user_id
 * @property string $kw
 * @property int $fid
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tieba whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tieba whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tieba whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tieba whereKw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tieba whereTiebaUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tieba whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tieba extends Model
{
    public $table = 'tiebas';
}