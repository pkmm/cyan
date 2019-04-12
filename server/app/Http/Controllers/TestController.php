<?php

namespace App\Http\Controllers;

use App\Constants\ErrorCode;
use App\error\BusinessException;
use App\error\EmBusinessError;
use App\Manager\NewInfoManager;
use App\Manager\ZcmuManager;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function test(Request $request)
    {

//        ZcmuManager::retrieveNewInfos();
//        return NewInfoManager::getNewInfos();
    }
}
