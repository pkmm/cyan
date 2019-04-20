<?php
/**
 * Author: robotgg@126.com
 * Date: 2019/4/20 - 3:56
 */

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestParameters;
use App\Manager\UserManager;
use App\Utils\StringUtils;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     * @throws InvalidRequestParameters
     */
    public function login()
    {
        $credentials = request(['code', 'openid']);
        if (!isset($credentials['code'], $credentials['openid']) ||
            !$this->check($credentials['openid'], $credentials['code'])) {
            throw new InvalidRequestParameters('参数不合法.');
        }

        $user = UserManager::findUserOrNew($credentials['openid']);
        $token = auth()->login($user);
        return $this->respondWithToken($token);
    }

    /**
     * @param string $openid
     * @param string $code
     * @return bool
     */
    private function check(string $openid, string $code)
    {
        $myCode = StringUtils::md5String(
            config('services.mini_program.random_str'),
            config('services.mini_program.app_id'),
            $openid
        );

        return $myCode == $code;
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json(['user' => auth()->user()]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json('Successfully logged out.');
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
