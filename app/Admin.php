<?php

namespace App;

use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Admin extends Authenticatable implements MustVerifyEmail
{   

   
    use Notifiable;

    public function sendPasswordResetNotification($token)
     {
         $this->notify(new AdminResetPasswordNotification($token));
     }

    public function sendEmailVerificationNotification()
     { 
         $this->notify(new Notifications\VerifyAdminEmail);
     }
      
        protected $guard = 'admin';


        protected $fillable = [
            'name', 'email', 'password','phone','user_type','order','coupon','product'
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
}
