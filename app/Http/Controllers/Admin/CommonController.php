<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;

class CommonController extends Controller
{
    
    public function getSubCategory(Request $request)
    {	
    	
    	$subcategory = Category::where(['parent_id' => $request->parentCat,'category_type' => 'sub_category' ,'status' => '1'])->get();
    	if(count($subcategory) > 0){
    		return json_encode(['status' => 'true', 'data' => $subcategory->toArray() ]);
    	}else{
    		return json_encode(['status' => 'false' ]);	
    	}

    }

    public function getChildCategory(Request $request)
    {   
        
        $childcategory = Category::where(['subparent_id' => $request->subcategory_id,'category_type' => 'child_category' ,'status' => '1'])->get();
        if(count($childcategory) > 0){
            return json_encode($childcategory->toArray());
        }else{
            return json_encode(['status' => 'false' ]); 
        }
    }

    public function getCategoryBySearch(Request $request)
    {   

        if (!empty($request->searchCat)) {
            $category = Category::where('category_type','child_category')->where('category_name',  'like','%'.$request->searchCat.'%')->get();
            return  response()->json($category);
        }
    }
}
