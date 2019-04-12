<?php
/**
 * Author: robotgg@126.com
 * Date: 2018/12/13 - 23:35
 */

namespace App\Http\Middleware;

use App\Exceptions\InvalidRequestParameters;
use App\Exceptions\RequestFailedException;
use App\Manager\UserManager;
use App\Utils\StringUtils;
use Auth;
use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param mixed ...$roles anonymous user admin
     * @return mixed
     * @throws InvalidRequestParameters
     * @throws RequestFailedException
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            if ($role == 'ANONYMOUS') {
                return $next($request);
            } else {
                break;
            }
        }

        $accessToken = $request->get('tk', '');
        $userId = (int)$request->get('uid', 0);

        $user = UserManager::checkAndGetUser($accessToken, $userId);
        if (!$user) {
            throw new InvalidRequestParameters('not found auth data.');
        }
        $ts = $request->get('ts');
        $nonce = $request->get('nonce');
        if (empty($ts) || empty($nonce)) {
            throw new InvalidRequestParameters('参数不合法');
        }
        $data = [
            'tk' => $accessToken,
            'uid' => $userId,
            'nonce' => $nonce,
            'ts' => $ts,
        ];
        $sign = $request->get('sign');
        if ($sign != StringUtils::signUrl($data)) {
            throw new RequestFailedException('Invalid parameters.');
        }

        Auth::login($user);

        return $next($request);
    }
}
