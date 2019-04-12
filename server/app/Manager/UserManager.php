<?php
/**
 * Author: robotgg@126.com
 * Date: 2018/12/14 - 0:25
 */

namespace App\Manager;

use App\Model\User;

class UserManager
{
    /**
     * @param string $accessToken
     * @param int $userId
     * @return User|null
     */
    public static function checkAndGetUser(string $accessToken, int $userId): ?User
    {
        // todo check.
        if (empty($accessToken) || empty($userId)) {
            return null;
        }

        $myAccessToken = RedisManager::getValue($userId);
        if ($myAccessToken != $accessToken) {
            return null;
        }

        $user = self::getUser($userId);


        return $user;
    }

    public static function getUser(int $userId): ?User
    {
        $user = User::whereId($userId)->first();
        return $user;
    }
}
