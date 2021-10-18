<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class SellerBusinessProfile extends Model
{
    public function VerificationData($value = '')
    {
    	return $this->hasone('App\Admin','id','seller_id');
    }
}
