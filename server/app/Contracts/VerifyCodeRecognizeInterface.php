<?php
/**
 * Author: robotgg@126.com
 * Date: 2019/4/14 - 11:45
 */

namespace App\Contracts;

interface VerifyCodeRecognizeInterface
{
    public function decode(string $imageStringContent): string;
}
