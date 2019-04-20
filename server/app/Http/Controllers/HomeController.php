<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotLoginException;
use Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /**/
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     */
    public function index()
    {
        return Redirect::to("/admin");
    }

    /**
     * @throws UserNotLoginException
     */
    public function needLogin()
    {
        throw new UserNotLoginException();
    }

}
