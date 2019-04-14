<?php

namespace App\Http\Controllers;

use App\Contracts\VerifyCodeRecognizeInterface;
use App\Jobs\SyncZcmuEducationSystemInfo;
use App\Model\User;
use App\Services\ZcmuEducationSystem;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

// 用于一些使用的
class TestController extends Controller
{
    public function test(Request $request, VerifyCodeRecognizeInterface $verifyCodeRecognize)
    {

        $student = User::first()->student;

        return $student->scores;
    }
}
