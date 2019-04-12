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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Tieba[] $tiebas
 * @method static Builder|TiebaUser whereBduss($value)
 * @method static Builder|TiebaUser whereCreatedAt($value)
 * @method static Builder|TiebaUser whereId($value)
 * @method static Builder|TiebaUser whereUpdatedAt($value)
 * @method static Builder|TiebaUser whereUserId($value)
 * @mixin Eloquent
 */
class TiebaUser extends Model
{
    public $table = 'tieba_users';

    public function tiebas()
    {
        return $this->hasMany(Tieba::class, 'tieba_user_id', 'id');
    }
}
