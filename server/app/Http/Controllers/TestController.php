<?php

namespace App\Http\Controllers;

use App\Contracts\VerifyCodeRecognizeInterface;
use App\Model\User;
use Illuminate\Http\Request;

// 用于一些使用的
class TestController extends Controller
{
    public function test(Request $request, VerifyCodeRecognizeInterface $verifyCodeRecognize)
    {
        $userId = (int) $request->get('user_id', 1);
        $user = User::find($userId);
        $student = $user->student;

        return $student->scores;
    }
}
