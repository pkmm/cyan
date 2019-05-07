<?php
/**
 * author: zhang.chuancheng@glority.com
 **/

namespace App\Contracts;

interface NotifyInterface
{
    public function notify(string $content);
}