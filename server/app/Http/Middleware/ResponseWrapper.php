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
        $ret = $response->original;

        if (!is_null($ret)) {
            if (empty($ret->result) || empty($ret->error) || empty($ret->message)) {
                $ret = [
                    'code' => 0,
                    'msg' => 'success',
                    'data' => $ret
                ];
            }
        }
        $response->setContent($ret);
        return $response;
    }
}
