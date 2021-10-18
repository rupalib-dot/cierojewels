<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Auth;
/*use Illuminate\Foundation\Auth\RegistersUsers;*/

class VendorRegistrationController extends Controller
{
    //use RegistersUsers;

     

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected $redirectTo = 'admin/home';



    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'phone' => ['required', 'string', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {   

        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'user_type' => 'seller',
            'order' => 1,
            'coupon' => 1,
            'product' => 1,
        ]);
    }



    public function showform()
    {	
    	
    	return view('vendors.vendor-registration');
    }

    public function RegisterVendor(Request $request)
    {	
    	$this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());

    }


    protected function registered(Request $request, $user)
    {
        //
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }


    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    
}
