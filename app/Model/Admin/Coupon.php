<?php

namespace App\MOdel\Admin;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'coupon', 'discount','category'
    ];

    public function CoupenCategory($value='')
    {
    	return $this->hasone('App\Model\Admin\ChildCategory','id','category');
    }
}
