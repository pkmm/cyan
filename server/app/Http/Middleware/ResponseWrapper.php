<?php
/**
 * Author: robotgg@126.com
 * Date: 2018/12/14 - 0:42
 */

namespace App\Http\Middleware;

use App\Constants\ErrorCodes;
use Closure;
use Illuminate\Http\Request;

class ResponseWrapper
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (is_null($response->exception)) {
            $ret = [
                'code' => ErrorCodes::SUCCESS,
                'msg' => 'success',
                'data' => $response->original
            ];
            $response->setContent(json_encode($ret));
            return $response;
        }
        return $response;
    }
}
