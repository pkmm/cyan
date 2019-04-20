<?php

namespace App\Http\Controllers;

use App\Contracts\VerifyCodeRecognizeInterface;
use App\Model\User;
use Cache;
use Illuminate\Http\Request;

// 用于一些使用的
class TestController extends Controller
{
    public function test(Request $request, VerifyCodeRecognizeInterface $verifyCodeRecognize)
    {
        $userId = (int)$request->get('user_id', 2);
        $redisKey = "userId:$userId:scores";
        if (!($ret = Cache::get($redisKey))) {
            $user = User::find($userId);
            $student = $user->student;
            if (!$student) {
                return [];
            }
            $scores = $student->scores;
            $ret = json_encode($scores);
            Cache::forever($redisKey, $ret);
        }

        return json_decode($ret);
    }
}
