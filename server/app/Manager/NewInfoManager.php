<?php
/**
 * Author: robotgg@126.com
 * Date: 2018/12/15 - 16:45
 */

namespace App\Manager;

//教务处新闻
use App\Model\NewInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class NewInfoManager
{
    /**
     * @param string $title
     * @param string $url
     * @param string $detail
     * @param string $postAt
     * @return NewInfo|\Illuminate\Database\Eloquent\Builder|Model|null
     */
    public static function addNewInfo(string $title, string $url, string $detail, string $postAt)
    {
        $model = self::getNewInfoByTitle($title);
        if ($model) {
            return $model;
        }

        $newInfo = new NewInfo();
        $newInfo->title = $title;
        $newInfo->url = $url;
        $newInfo->title_crc32 = crc32($title);
        $newInfo->post_at = $postAt;
        $newInfo->detail = $detail;
        $newInfo->save();

        return $newInfo;
    }

    /**
     * @param string $title
     * @return \Illuminate\Database\Eloquent\Builder|Model|null
     */
    public static function getNewInfoByTitle(string $title)
    {
        $crc32 = crc32($title);
        $model = NewInfo::query()
            ->where('title_crc32', $crc32)
            ->where('title', $title)
            ->first();

        return $model;
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|Model|null
     */
    public static function getNewInfoById(int $id)
    {
        return NewInfo::query()->where('id', $id)->first();
    }

    /**
     * 获取新闻的列表不包括detail
     * @param int $pageSize
     * @param int $pageNumber
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Builder[]|Collection
     */
    public static function getNewInfos($pageSize = 10, $pageNumber = 1)
    {
        if ($pageNumber < 1) {
            $pageNumber = 1;
        }
        $results = NewInfo::query()
            ->skip(($pageNumber - 1) * $pageSize)
            ->take($pageSize)
            ->select(['id', 'title', 'url', 'post_at'])
            ->get();

        return $results;
    }
}
