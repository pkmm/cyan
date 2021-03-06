<?php

namespace App\Http\Controllers;

use App\Contracts\EducationSystemInterface;
use App\Contracts\VerifyCodeRecognizeInterface;
use App\Exceptions\InvalidRequestParameters;
use App\Jobs\SyncZcmuEducationSystemInfo;
use App\Manager\StudentManager;
use App\Model\Student;
use App\Services\AccountShutdownException;
use App\Services\CanNotDecodeViewStateException;
use App\Services\PasswordWrongException;
use App\Services\VerifyCodeWrongException;
use App\Services\ZcmuEducationSystem;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @param Request $request
     * @param VerifyCodeRecognizeInterface $verifyCodeRecognize
     * @return array
     * @throws CanNotDecodeViewStateException
     * @throws InvalidRequestParameters
     * @throws AccountShutdownException
     * @throws PasswordWrongException
     * @throws VerifyCodeWrongException
     */
    public function setStudentAccount(Request $request, VerifyCodeRecognizeInterface $verifyCodeRecognize)
    {
        $user = auth()->user();
        $studentNumber = $request->get('student_number', '');
        $password = $request->get('password', '');
        if (empty($studentNumber) || empty($password)) {
            throw new InvalidRequestParameters('教务系统学号或者密码不能为空');
        }
        // 检测账号的状态
        $student = new Student();
        $student->num = $studentNumber;
        $student->pwd = $password;
        $srv = new ZcmuEducationSystem($student, $verifyCodeRecognize);
        try {
            $srv->login();
        } catch (\Exception $e) {
            throw new InvalidRequestParameters($e->getMessage());
        }
        $student = StudentManager::setAccount($user, $studentNumber, $password);
        dispatch((new SyncZcmuEducationSystemInfo($student->id))->onQueue('high'));
        $student = $user->student;
        return compact('student');
    }
}
