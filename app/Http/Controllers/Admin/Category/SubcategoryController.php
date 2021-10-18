<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Category;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('IsAdmin');
    }

    public function subcategory(){
        $category = Category::where('category_type','parent_category')->get();
        $subcategory=Category::with('parentCategory')->where('category_type','sub_category')->get();
        return view('admin.category.subcategory',compact('category','subcategory'));
    }

    //------------insert------------
    public function Storesubcategory(Request $request){
        $validatedData = $request->validate([
            'parent_id'  => 'required',
            'category_name'  => 'required',
            'category_slug'  => ['required','regex:/^[a-z][-_a-z0-9\/]*$/'],
            'status' => 'required',
            'category_title' => ['required'],
            'category_keyword' => ['required'],
            'category_description' => ['required'],
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->category_slug =$request->category_slug;
        $category->status = $request->status;
        $category->category_type = 'sub_category';
        $category->parent_id = $request->parent_id;
        $category->category_title = $request->category_title;
        $category->category_keyword = $request->category_keyword;
        $category->category_description = $request->category_description;

        if($category->save()){
            $notification = array(
                'message'=>'Successfully Subcategory Inserted',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message'=>'Something Went Wrong',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    //------------delete--------
    public function deletesubcategory($id){
        DB::table('categories')->where('id',$id)->delete();

        $notification = array(
            'message'=>'Successfully Subcategory Deleted',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    //--------edit----------------
    public function editsubcategory($id){
        $subcategory=DB::table('categories')->where('id',$id)->first();
        $category = Category::where('category_type','parent_category')->get();
        return view('admin.category.edit_subcategory',compact('subcategory','category'));
    }

    //-------update------
    public function updatesubcategory(Request $request,$id){

        $validatedData = $request->validate([
            'parent_id'  => 'required',
            'category_name'  => ['required'],
            'category_slug'  => ['required','regex:/^[a-z][-_a-z0-9\/]*$/'],
            'status' => 'required',
            'category_title' => ['required'],
            'category_keyword' => ['required'],
            'category_description' => ['required'],
        ]);

        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->category_slug =$request->category_slug;
        $category->status = $request->status;
        $category->parent_id = $request->parent_id;
        $category->category_title = $request->category_title;
        $category->category_keyword = $request->category_keyword;
        $category->category_description = $request->category_description;

        if($category->save()){
            $notification = array(
                'message'=>'Successfully Subcategory Inserted',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message'=>'Something Went Wrong',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }
        
    }





}
