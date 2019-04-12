<?php
/**
 * Author: robotgg@126.com
 * Date: 2018/12/15 - 16:16
 */

namespace App\Manager;

use App\Utils\StringUtils;

class ZcmuManager
{
    // 获取教务处的新闻信息
    public static function retrieveNewInfos()
    {
        // todo better 目前只获取第一页的数据(20)
        $html = file_get_contents(
            "http://jwc.zcmu.edu.cn/more.jsp?currentPage=1&c_name=%E6%97%A5%E5%B8%B8%E5%85%AC%E5%91%8A&nav_key=&flag=1"
        );

        $re = '/<a[\s]+href="details\.jsp\?(.*?)">(.*?)<\/a>[\s]*<span>(.*?)<\/span>/s';
        preg_match_all($re, $html, $matches, PREG_SET_ORDER, 0);

        $baseUrl = 'http://jwc.zcmu.edu.cn/details.jsp?';
        //        ksort($matches);
        foreach ($matches as $match) {
            $url = $match[1];
            $title = $match[2];
            $title = StringUtils::convertString($title);
            $postAt = $match[3];
            $url = str_replace(" ", "%20", $url);
            $url = $baseUrl . $url;
            $detail = self::getNewDetail($url);
            if (isset($detail[0][0])) {
                NewInfoManager::addNewInfo($title, $url, $detail[0][0], $postAt);
            }
        }
    }

    /**
     * 获取新闻的具体内容
     * @param $url
     * @return mixed
     */
    public static function getNewDetail($url)
    {
        $html = file_get_contents($url);
        $re = '/<div class="news_xq">(.*?)<\/div>/s';
        preg_match_all($re, $html, $matches, PREG_SET_ORDER, 0);

        return $matches;
    }
}
