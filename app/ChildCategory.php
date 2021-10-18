<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    
	public function ParentCat()
	{
		return $this->hasone('App\Model\Admin\Category','id','category')
	}
    public function SubCat()
    {
    	return $this->hasone('App\Model\Admin\Subcategory','id','subcategory')
    }
}
