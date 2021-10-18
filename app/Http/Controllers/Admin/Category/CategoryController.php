<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Category;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('IsAdmin');
    }

    //--------read----------
    public function category(){
        $category= Category::where('category_type','parent_category')->orderBy('id','desc')->get();
        return view('admin.category.category',compact('category'));
    }

    //--------- Insert------------
    public function Storecategory(Request $request){
        $validatedData = $request->validate([
            'category_name'  => 'required',
            'category_image' => 'required',
            'status' => 'required',
            'category_slug' => ['required','regex:/^[a-z][-_a-z0-9\/]*$/'],
            'category_title' => ['required'],
            'category_keyword' => ['required'],
            'category_description' => ['required'],
        ]);


        $category = new Category;
        $category->category_name = $request->category_name;
        $category->category_slug = $request->category_slug;
        $category->status = $request->status;
        $category->category_type = 'parent_category';
        $category->category_title = $request->category_title;
        $category->category_keyword = $request->category_keyword;
        $category->category_description = $request->category_description;

        if($request->hasfile('category_image')){
            $filename = str_replace(' ', '-',$request->category_image->getClientOriginalName());
                
            $request->category_image->move(public_path('media/category_image'),$filename);

            $category->category_image = 'public/media/category_image/'.str_replace(' ', '-',$request->category_image->getClientOriginalName());
        }
       
        if($category->save()){
            $notification = array(
                'message'=>'Successfully Category Inserted',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }

//------ delete -------------
    public function deleteCategory($id){
        DB::table('categories')->where('id',$id)->delete();
        
        $notification = array(
            'message'=>'Successfully Category Deleted',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    //--------edit----------------
    public function editCategory($id){
        $category=DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit_category',compact('category'));
    }

    //-------update------
    public function updatecategory(Request $request,$id){
        $validatedData = $request->validate([
            'category_name'  => ['required'],
            'category_slug' => ['required','regex:/^[a-z][-_a-z0-9\/]*$/'],
            'status' => 'required',
            'category_title' => ['required'],
            'category_keyword' => ['required'],
            'category_description' => ['required'],
        ]);

        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=  $request->category_slug;
        $data['status'] = $request->status;

        $data['category_title'] = $request->category_title;
        $data['category_keyword'] = $request->category_keyword;
        $data['category_description'] = $request->category_description;

        if($request->hasfile('category_image')){
            $filename = str_replace(' ', '-',$request->category_image->getClientOriginalName());
            $request->category_image->move(public_path('media/category_image'), $filename);
            $data['category_image'] = 'public/media/category_image/'.$filename;
        }
        $category= DB::table('categories')->where('id',$id)->update($data);

        if($category){
            $notification = array(
                'message'=>'Successfully Category Updated',
                'alert-type'=>'success'
            );
            return redirect()->route('categories')->with($notification);
        }else{
            $notification = array(
                'message'=>' Nothing to Update!',
                'alert-type'=>'success'
            );
            return redirect()->route('categories')->with($notification);
        }
    }

}
