<?php
/**
 * Author: robotgg@126.com
 * Date: 2019/4/14 - 14:08
 */

namespace App\Contracts;


interface StudentInterface
{
    public function getStudentNumber(): string;

    public function getStudentPassword(): string;

    public function updateStudentSchoolReport(array $schoolReports);

    public function setStudentName(string $studentName);

    public function getStudentName(): string;
}