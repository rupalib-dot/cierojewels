<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
 	
 	public function Customer()
 	{
 		return $this->hasone('App\User','id','user_id');
 	}

 	public function Product()
 	{
 		return $this->hasone('App\Model\Admin\Product','id','product_id');
 	}
}
