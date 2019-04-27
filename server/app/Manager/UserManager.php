<?php
/**
 * Author: robotgg@126.com
 * Date: 2018/12/14 - 0:25
 */

namespace App\Manager;

use App\Model\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    /**
     * @param string $openid
     * @return User|Builder|Model|null
     */
    public static function findUserOrNewByOpenId(string $openid)
    {
        $user = User::whereOpenid($openid)->first();
        if (!$user) {
            $user = new User();
            $user->openid = $openid;
            $user->password = bcrypt('123456');
            $user->salt = Str::random(10);
            $user->save();
        }
        return $user;
    }

    /**
     * @param string $username
     * @return User|Builder|Model|null
     */
    public static function getUserByName(string $username)
    {
        return User::whereUsername($username)->first();
    }

    /**
     * @param string $username
     * @param string $password
     * @return User
     */
    public static function createUserFromWeb(string $username, string $password)
    {
        $salt = Str::random(6);
        $user = new User();
        $user->username = $username;
        $user->password = bcrypt($salt . $password);
        $user->salt = $salt;
        $user->save();
        return $user;
    }
}
