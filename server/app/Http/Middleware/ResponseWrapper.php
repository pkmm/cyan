<?php
/**
 * Author: robotgg@126.com
 * Date: 2018/12/14 - 0:42
 */

namespace App\Http\Middleware;

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
        //        if (is_null($response->exception)) {
        //            $ret = [
        //                'code' => 0,
        //                'msg' => 'success',
        //                'data' => $response->original
        //            ];
        //        } else {
        //            $ret = [
        //                'code' => ErrorCode::INNER_ERROR,
        //                'msg' => 'error',
        //                'data' => null,
        //            ];
        //        }
        //        $response->setContent($ret);
        return $response;
    }
}
