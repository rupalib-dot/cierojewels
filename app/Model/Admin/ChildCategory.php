<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    public function ParentCat()
	{
		return $this->hasone('App\Model\Admin\Category','id','category_id');
	}
    public function SubCat()
    {
    	return $this->hasone('App\Model\Admin\Subcategory','id','subcategory_id');
    }
}
