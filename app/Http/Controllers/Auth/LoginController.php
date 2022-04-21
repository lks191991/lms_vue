<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Validator;
use DB;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '';
   protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /* public function redirectTo() {
        $role = Auth::user()->type; 
        switch ($role) {
          case 'admin':
            return '/admin/dashboard';
            break;
          case 'user':
            return '/admin/dashboard';
            break; 
      
          default:
            return '/'; 
          break;
        }
      } */
}
