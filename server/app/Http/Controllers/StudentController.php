<?php

namespace App\Http\Controllers;

use App\Exceptions\RequestFailedException;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getScores(Request $request)
    {
        $num = $request->get('num');
        if (!$num) {
            throw new RequestFailedException('not found student numbers.');
        }
        return ['ss' => 23];
    }
}
