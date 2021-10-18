<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [

        'category_name','category_slug','parent_id','subparent_id','category_type','category_image','status'
    ];

    public function parentCategory()
    {
    	return $this->hasone('App\Model\Admin\Category','id','parent_id');
    }

    public function subCategory()
    {
    	return $this->hasmany('App\Model\Admin\Category','parent_id','id')->where('category_type','sub_category')->with('childCategory');
    }

    public function childCategory()
    {
        return $this->hasmany('App\Model\Admin\Category','subparent_id','id')->where('category_type','child_category')->with('childCategory');
    }


//;


    public function ParentCat($value='')
    {
        return $this->hasone('App\Model\Admin\Category','id','parent_id');
    }

    public function SubCat($value='')
    {
        return $this->hasone('App\Model\Admin\Category','id','subparent_id');
    }
}
