<?php

namespace App\Http\Controllers;

use App\Exceptions\RequestFailedException;
use App\Exceptions\UserDonstHaveStudentException;
use App\Manager\StudentManager;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @return array
     * @throws UserDonstHaveStudentException
     */
    public function getScores()
    {
        $user = auth()->user();
        $student = $user->student;
        if (!$student) {
            throw new UserDonstHaveStudentException('用户没有对应的学生');
        }
        $scores = StudentManager::getScores($student);
        return compact('scores');
    }

    /**
     * @return array
     * @throws UserDonstHaveStudentException
     */
    public static function getSyncDetail()
    {
        $student = auth()->user()->student;
        if (!$student) {
            throw new UserDonstHaveStudentException('用户没有对应的学生');
        }
        $detail = StudentManager::getSyncScoreDetail($student);
        return compact('detail');
    }
}
