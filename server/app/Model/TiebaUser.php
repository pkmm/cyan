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
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\TiebaUser
 *
 * @property int $id
 * @property int $user_id
 * @property string $bduss
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Tieba[] $tiebas
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TiebaUser whereBduss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TiebaUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TiebaUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TiebaUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TiebaUser whereUserId($value)
 * @mixin \Eloquent
 */
class TiebaUser extends Model
{
    public $table = 'tieba_users';

    public function tiebas()
    {
        return $this->hasMany(Tieba::class, 'tieba_user_id', 'id');
    }
}
