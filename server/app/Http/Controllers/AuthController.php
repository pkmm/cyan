<?php
/**
 * Author: robotgg@126.com
 * Date: 2019/4/20 - 3:56
 */

namespace App\Http\Controllers;

use App\Constants\enums\DeviceType;
use App\Exceptions\InvalidRequestParameters;
use App\Exceptions\LoginFailedException;
use App\Exceptions\UserNotFoundException;
use App\Exceptions\UserRegisterFailedException;
use App\Manager\UserManager;
use App\Model\User;
use App\Utils\StringUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * @param Request $request
     * @return User|null
     * @throws InvalidRequestParameters
     * @throws UserRegisterFailedException
     */
    public function register(Request $request)
    {
        $deviceType = $request->get('device_type', DeviceType::WEB);
        $user = null;
        if ($deviceType == DeviceType::WEB) {
            $user = $this->registerFromWeb();
        } elseif ($deviceType == DeviceType::MINI_PROGRAM) {
            // nothing to do. mini program must be registered when it do login.
            // in fact mini program should not call this function.
        }
        if (is_null($user)) {
            throw new UserRegisterFailedException('用户注册失败，请稍后重试');
        }
        $token = auth('api')->login($user);
        return compact('token', 'user');
    }

    /**
     * @return User
     * @throws InvalidRequestParameters
     */
    private function registerFromWeb()
    {
        $username = request()->get('username');
        $password = request()->get('password');
        if (empty($username) || empty($password)) {
            throw new InvalidRequestParameters('用户名与密码不能为空');
        }
        $user = UserManager::createUserFromWeb($username, $password);
        return $user;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     * @throws InvalidRequestParameters
     * @throws LoginFailedException
     * @throws UserNotFoundException
     */
    public function login()
    {
        $deviceType = (int)request()->get('device_type', DeviceType::MINI_PROGRAM);
        $token = null;
        if ($deviceType == DeviceType::MINI_PROGRAM) {
            $token = $this->loginFromMiniProgram();
        } elseif ($deviceType == DeviceType::WEB) {
            $token = $this->loginFromWeb();
        }
        if (is_null($token)) {
            throw new InvalidRequestParameters('登陆失败,参数不合法');
        }
        return $this->respondWithToken($token);
    }

    /**
     * @throws InvalidRequestParameters
     * @throws LoginFailedException
     * @throws UserNotFoundException
     */
    private function loginFromWeb()
    {
        $username = request()->get('username', null);
        $password = request()->get('password', null);
        if (empty($username) || empty($password)) {
            throw new InvalidRequestParameters('参数不合法.');
        }

        $user = UserManager::getUserByName($username);
        if (!$user) {
            throw new UserNotFoundException("未找到用户$username");
        } else {
            if ($user->password !== bcrypt($user->salt . $password)) {
                throw new LoginFailedException('密码或者用户名错误！');
            }
        }
        $token = auth()->login($user);
        return $token;
    }

    /**
     * @throws InvalidRequestParameters
     */
    private function loginFromMiniProgram()
    {
        $credentials = request(['code', 'openid']);
        if (!isset($credentials['code'], $credentials['openid']) ||
            !$this->check($credentials['openid'], $credentials['code'])) {
            throw new InvalidRequestParameters('参数不合法.');
        }

        $user = UserManager::findUserOrNewByOpenId($credentials['openid']);
        $token = auth()->login($user);
        return $token;
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
