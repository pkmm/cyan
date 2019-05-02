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
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Model\User
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $openid
 * @property string $password
 * @property string $salt
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Model\Student $student
 * @property-read \App\Model\TiebaUser $tiebaUser
 * @property-read \App\Model\WechatUser $wechatUser
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereSalt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Model implements Authenticatable, JWTSubject
{
    use \Illuminate\Auth\Authenticatable;
    public $table = 'users';

    protected $hidden = ['password', 'salt'];

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

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
