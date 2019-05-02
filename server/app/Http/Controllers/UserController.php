<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestParameters;
use App\Manager\StudentManager;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @param Request $request
     * @return array
     * @throws InvalidRequestParameters
     */
    public function setStudentAccount(Request $request)
    {
        $user = auth()->user();
        $studentNumber = $request->get('student_number', '');
        $password = $request->get('password', '');
        if (empty($studentNumber) || empty($password)) {
            throw new InvalidRequestParameters('教务系统学号或者密码不能为空');
        }
        StudentManager::setAccount($user, $studentNumber, $password);
        $student = $user->student;
        return compact('student');
    }
}
