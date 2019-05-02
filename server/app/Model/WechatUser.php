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
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\WechatUser
 *
 * @property int $id
 * @property int $user_id
 * @property string $avatar
 * @property string $country
 * @property string $province
 * @property string $city
 * @property string $nickname
 * @property string $open_id
 * @property string $union_id
 * @property string $language
 * @property string $gender
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\WechatUser whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\WechatUser whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\WechatUser whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\WechatUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\WechatUser whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\WechatUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\WechatUser whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\WechatUser whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\WechatUser whereOpenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\WechatUser whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\WechatUser whereUnionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\WechatUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\WechatUser whereUserId($value)
 * @mixin \Eloquent
 */
class WechatUser extends Model
{
    public $table = 'wechat_users';
}
