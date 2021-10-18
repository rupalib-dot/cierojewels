<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'subcategory_id','product_name','product_code','product_quantity','product_details','product_color','product_size','selling_price','discount_price','video_link','main_slider','hot_deal','best_rated','mid_slider','hot_new','trend','image_one','image_two','image_three','status','coupen_id','whats_new','dealoftheday','best_seller','recently_view','mrp','discount','gross_weight','product_sku','sales_package'
    ];
    //'brand_id',

    public function Product()
    {
    	return $this->hasMany('App\Model\Admin\Product');
    }

    public function Category($value='')
    {
        return $this->hasone('App\Model\Admin\Category','id','category_id');
    }

    public function Subcategory($value='')
    {
       return $this->hasone('App\Model\Admin\Category','id','subcategory_id');
    }

    public function ChildCategory($value='')
    {
        return $this->hasone('App\Model\Admin\Category','id','childcategory_id');
    }

    /*public function CategoryData($value='')
    {
    	return
    }*/
}
