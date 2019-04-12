<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/18
 * Time: 21:36
 */

namespace App\Model;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\User
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Student $student
 * @property-read TiebaUser $tiebaUser
 * @property-read WechatUser $wechatUser
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereSalt($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereUsername($value)
 * @mixin Eloquent
 */
class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    public $table = 'users';

    public function getRememberToken()
    {
        return 'user_' . $this->getAuthIdentifier();
    }

    public function setRememberToken($value)
    {
        // todo.
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id', 'id');
    }

    public function tiebaUser()
    {
        return $this->hasOne(TiebaUser::class, 'user_id', 'id');
    }

    public function wechatUser()
    {
        return $this->hasOne(WechatUser::class, 'user_id', 'id');
    }
}
