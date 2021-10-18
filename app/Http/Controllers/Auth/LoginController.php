<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    public $previous_url;
    //protected $redirectTo = '/user/profile';

    protected function redirectTo()
    {   
        return  $this->previous_url;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

   
    public function __construct(Request $request)
    {    
        
        $this->previous_url = $request->previous_url;
        $this->middleware('guest')->except('logout');
        //for restricting the users to access the admin login after logged in as user
        $this->middleware('guest:admin')->except('logout');
    }
}
