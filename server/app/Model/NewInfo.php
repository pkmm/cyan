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
 * @mixin Eloquent
 * @property int $id
 * @property string $title
 * @property int $title_crc32
 * @property string $url 新闻详情的地址
 * @property string $post_at 新闻发表的时间
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|NewInfo whereCreatedAt($value)
 * @method static Builder|NewInfo whereId($value)
 * @method static Builder|NewInfo wherePostAt($value)
 * @method static Builder|NewInfo whereTitle($value)
 * @method static Builder|NewInfo whereTitleCrc32($value)
 * @method static Builder|NewInfo whereUpdatedAt($value)
 * @method static Builder|NewInfo whereUrl($value)
 * @property string $detail
 * @method static Builder|NewInfo whereDetail($value)
 */
class NewInfo extends Model
{
    protected $table = 'new_infos';
    protected $guarded = [];
}
