<?php
/**
 * Author: robotgg@126.com
 * Date: 2018/12/15 - 16:46
 */

namespace App\Model;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Model\NewInfo
 *
 * @property int $id
 * @property string $title
 * @property int $title_crc32
 * @property string $url 新闻详情的地址
 * @property string $detail
 * @property string $post_at 新闻发表的时间
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewInfo whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewInfo wherePostAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewInfo whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewInfo whereTitleCrc32($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\NewInfo whereUrl($value)
 * @mixin \Eloquent
 */
class NewInfo extends Model
{
    protected $table = 'new_infos';
    protected $guarded = [];
}
