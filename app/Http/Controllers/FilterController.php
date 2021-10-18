<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Model\Admin\Subcategory;
use App\Model\Admin\ChildCategory;
use App\Model\Admin\Product;

class FilterController extends Controller
{
    public function SortBy(Request $request)
    {	 
        
        if($request->sortby == 'low_to_high'){
            return $this->SortBylth($request->category_id,$request->category_type);
        }elseif($request->sortby == 'high_to_low'){
            return $this->SortByHtl($request->category_id,$request->category_type);
            
        }elseif($request->sortby == 'new_arrivals'){
            return $this->SortByNewArrival($request->category_id,$request->category_type);
            
        }elseif($request->sortby == 'popularity'){
            return $this->SortByPopularity($request->category_id,$request->category_type);
        } 
    	
    }

   
    

    private function SortBylth($category_id,$category_type)
    {    
        
        $category = Category::where(['id' => $category_id, 'category_type' => $category_type])->first();
        $data = Product::where('category_id',$category_id)->where('is_approved','1')->orderby('selling_price','asc')->get();
        $productCount = Product::where('category_id',$category_id)->where('is_approved','1')->count();
        $category_type = 'parentcategory';
        return view('common.render_product',compact('data','productCount','category','category_type'))->render();
    }



    public function SortByHtl($category_id,$category_type)
    {    
        switch ($category_type) {
            case 'parentcategory':
                $category = Category::where('id',$category_id)->first();
                $data = Product::where('category_id',$category_id)->where('is_approved','1')->orderby('selling_price','desc')->get();
                $productCount = Product::where('category_id',$category_id)->where('is_approved','1')->count();
                $category_type = 'parentcategory';
                break;
            case 'subcategory':
                $category = Subcategory::where('id',$category_id)->first();
                $data = Product::where('subcategory_id',$category_id)->orderby('selling_price','desc')->where('is_approved','1')->get();
                $productCount = Product::where('category_id',$category_id)->where('is_approved','1')->count();
                $category_type = 'subcategory';
                break;
            case 'childcategory':
                $category = ChildCategory::where('id',$category_id)->first();
                $data = Product::where('childcategory_id',$category_id)->orderby('selling_price','desc')->where('is_approved','1')->get();
                $productCount = Product::where('category_id',$category->id)->where('is_approved','1')->count();
                $category_type = 'childcategory';
                break;
        }
        return view('common.render_product',compact('data','productCount','category','category_type'))->render();
        
    }


    public function SortByNewArrival($category_id,$category_type)
    {    
        switch ($category_type) {
            case 'parentcategory':
                $category = Category::where('id',$category_id)->first();
                $data = Product::where('category_id',$category_id)->where('is_approved','1')->orderby('id','desc')->get();
                $productCount = Product::where('category_id',$category_id)->where('is_approved','1')->count();
                $category_type = 'parentcategory';
                break;
            case 'subcategory':
                $category = Subcategory::where('id',$category_id)->first();
                $data = Product::where('subcategory_id',$category_id)->orderby('id','desc')->where('is_approved','1')->get();
                $productCount = Product::where('category_id',$category_id)->where('is_approved','1')->count();
                $category_type = 'subcategory';
                break;
            case 'childcategory':
                $category = ChildCategory::where('category_slug',$category_id)->first();
                $data = Product::where('id',$category_id)->orderby('id','desc')->where('is_approved','1')->get();
                $productCount = Product::where('category_id',$category_id)->where('is_approved','1')->count();
                $category_type = 'childcategory';
                break;
        }
        return view('common.render_product',compact('data','productCount','category','category_type'))->render();
        
    }


    public function SortByPopularity($category_id,$category_type)
    {    
        switch ($category_type) {
            case 'parentcategory':
                $category = Category::where('id',$category_id)->first();
                $data = Product::where('category_id',$category_id)->where('is_approved','1')->where('best_seller','1')->get();
                $productCount = Product::where('category_id',$category_id)->where('is_approved','1')->count();
                $category_type = 'parentcategory';
                break;
            case 'subcategory':
                $category = Subcategory::where('subcategory_slug',$category_id)->first();
                $data = Product::where('id',$category_id)->where('best_seller','1')->where('is_approved','1')->get();
                $productCount = Product::where('category_id',$category_id)->where('is_approved','1')->count();
                $category_type = 'subcategory';
                break;
            case 'childcategory':
                $category = ChildCategory::where('category_slug',$category_id)->first();
                $data = Product::where('id',$category_id)->where('best_seller','1')->where('is_approved','1')->get();
                $productCount = Product::where('category_id',$category_id)->where('is_approved','1')->count();
                $category_type = 'childcategory';
                break;
        }
        return view('common.render_product',compact('data','productCount','category','category_type'))->render();
        
    }


    public function SortByCategory(Request $request)
    {   
        if(!empty($request->category)){
            $data = Product::whereIn('subcategory_id',$request->category)->orderby('id','desc')->where('is_approved','1')->get();
        }

        return view('common.render_product',compact('data'))->render();
    }


    public function SortByPrice(Request $request)
    {
        switch ($request->price) {
            case 'under_500':
                $data = Product::where('selling_price', '<=' ,500)->where('is_approved','1')->get();
                break;
            case 'between_501_to_1000':
                $data = Product::whereBetween('selling_price',[501,1000])->where('is_approved','1')->get();
                break;
            case 'between_1001_to_1500':
                $data = Product::where('selling_price',[1001,1500])->where('is_approved','1')->get();
                break;

            case 'between_1501_to_2000':
                $data = Product::whereBetween('selling_price',[1501,2000])->where('is_approved','1')->get();
                break;

            case 'above_2000':
                $data = Product::where('selling_price','>',2000)->where('is_approved','1')->get();
                break;
        }

        return view('common.render_product',compact('data'))->render();
    }


    /*private function getcoutofsegments($url){
    	return $  = count(explode('/',$url));
        $slug = 
    }*/
}
