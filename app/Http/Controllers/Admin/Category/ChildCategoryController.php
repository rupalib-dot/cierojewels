<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use DB;
use Illuminate\Validation\Rule;
class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('IsAdmin');
    }


    public function childcategory()
    {    
        $childcategory= Category::with(['ParentCat','SubCat'])->where('category_type','child_category')->get();
        $category = Category::orderBy('category_name','asc')->where('category_type','parent_category')->get();
        return view('admin.category.childcategory',compact(['childcategory','category']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_name' => ['required'],
            'parent_id' => ['required','numeric'],
            'subparent_id'  =>['required','numeric'],
            'category_slug'  =>['required','regex:/^[a-z][-_a-z0-9\/]*$/'],
            'status' => ['required'],
            'category_title' => ['required'],
            'category_keyword' => ['required'],
            'category_description' => ['required'],

        ]);

        $store = new Category;
        $store->category_name = $request->category_name;
        $store->category_slug = $request->category_slug;
        $store->parent_id = $request->parent_id;
        $store->subparent_id = $request->subparent_id;
        $store->category_type = 'child_category';
        $store->status = $request->status;
        $store->category_title = $request->category_title;
        $store->category_keyword = $request->category_keyword;
        $store->category_description = $request->category_description;

        if($store->save()){
            $notification = array(
                'message'=>'Successfully Childcategory Inserted',
                'alert-type'=>'success'
            );
            return redirect()->route('childcategories')->with($notification);
        }else{
            $notification = array(
                'message'=>'Somthing Went Wrong',
                'alert-type'=>'success'
            );
            return redirect()->route('childcategories')->with($notification);
        }

        


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::find($id);
        $category = Category::where(['status'=>'1', 'category_type' => 'parent_category'])->get();

        return view('admin.category.edit_childcategory',compact(['category','data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   

        $validateData = $request->validate([
            'category_name' => ['required'],
            'parent_id' => ['required','numeric'],
            'subparent_id'  =>['required','numeric'],
            'category_slug'  =>['required','regex:/^[a-z][-_a-z0-9\/]*$/'],
            'status' => ['required'],
            'category_title' => ['required'],
            'category_keyword' => ['required'],
            'category_description' => ['required'],

        ]);

        $store = Category::find($id);
        $store->category_name = $request->category_name;
        $store->category_slug = $request->category_slug;
        $store->parent_id = $request->parent_id;
        $store->subparent_id = $request->subparent_id;
        $store->status = $request->status;
        $store->category_title = $request->category_title;
        $store->category_keyword = $request->category_keyword;
        $store->category_description = $request->category_description;

        if($store->save()){
            $notification = array(
                'message'=>'Successfully Childcategory Updated',
                'alert-type'=>'success'
            );
            return redirect()->route('childcategories')->with($notification);
        }else{
            $notification = array(
                'message'=>'Somthing Went Wrong',
                'alert-type'=>'success'
            );
            return redirect()->route('childcategories')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete  = Category::find($id);

        if($delete->delete()){
            $notification = array(
                'message'=>'Successfully Category Deleted',
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
