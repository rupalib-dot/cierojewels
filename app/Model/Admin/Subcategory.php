<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'subcategory_name', 'category_id',
    ];

    public function childCategory()
    {
    	return $this->hasmany('App\Model\Admin\ChildCategory','subcategory_id','id');
    }
}
