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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|WechatUser whereAvatar($value)
 * @method static Builder|WechatUser whereCity($value)
 * @method static Builder|WechatUser whereCountry($value)
 * @method static Builder|WechatUser whereCreatedAt($value)
 * @method static Builder|WechatUser whereGender($value)
 * @method static Builder|WechatUser whereId($value)
 * @method static Builder|WechatUser whereLanguage($value)
 * @method static Builder|WechatUser whereNickname($value)
 * @method static Builder|WechatUser whereOpenId($value)
 * @method static Builder|WechatUser whereProvince($value)
 * @method static Builder|WechatUser whereUnionId($value)
 * @method static Builder|WechatUser whereUpdatedAt($value)
 * @method static Builder|WechatUser whereUserId($value)
 * @mixin Eloquent
 */
class WechatUser extends Model
{
    public $table = 'wechat_users';
}
