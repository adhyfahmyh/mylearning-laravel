<?php

<<<<<<< HEAD
namespace MyLearning\Http\Controllers\Auth;

use MyLearning\Http\Controllers\Controller;
=======
namespace PLearning\Http\Controllers\Auth;

use PLearning\Http\Controllers\Controller;
>>>>>>> 83057d45ae102081508fb236bfd2d6dfdfb3d56c
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
