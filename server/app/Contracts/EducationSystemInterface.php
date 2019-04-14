<?php
/**
 * Author: robotgg@126.com
 * Date: 2019/4/14 - 14:10
 */

namespace App\Contracts;


interface EducationSystemInterface
{
    public function getSchoolReport(): array;

    public function getStudent(): StudentInterface;

}