<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use  App\Model\Admin\Category;
use  App\Model\Admin\Subcategory;
use  App\Model\Admin\ChildCategory;
use  App\Model\Admin\Product;


class FrontController extends Controller
{
	
//-----------Newsletter----------------
    public function storeNewsletter(Request $request){
        $validatedData = $request->validate([
            'email'  => 'required|unique:newsletters|max:55',
        ]);

        $data=array();
        $data['email']=$request->email;
        $category= DB::table('newsletters')->insert($data);

        $notification = array(
            'message'=>'Thanks for subscribing',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }


//-----------Order Tracking----------
    public function OrderTracking(Request $request)
    {
         $code=$request->code;

         $track=DB::table('orders')->where('status_code',$code)->first();
         if ($track) {
             return view('pages.track',compact('track'));
         }else{
               $notification=array(
                    'message'=>'Status code invalid ',
                    'alert-type'=>'error'
                );
             return Redirect()->back()->with($notification);
         }
    }


//-----------User Order View--------------
    public function UserOrderView($id)
    {
        $order=DB::table('orders')
            ->join('users','orders.user_id','users.id')
            ->select('users.name','users.phone','orders.*')
            ->where('orders.id',$id)
            ->first();

        $shipping=DB::table('shipping')->where('order_id',$id)->first();

        $details=DB::table('order_details')
                ->join('products','order_details.product_id','products.id')
                ->select('products.product_code','products.image_one','order_details.*')
                ->where('order_details.order_id',$id)
                ->get();

        return view('pages.view_order',compact('order','shipping','details'));
    }


//-------------Search-------------
    public function ProductSearch(Request $request)
    {
        $brands=DB::table('brands')->get();
        $item=$request->search;
        $products=DB::table('products')
                //->join('brands','products.brand_id','brands.id')
                //->select('products.*','brands.brand_name')
                ->where('product_name','LIKE', "%{$item}%")
                //->orWhere('brand_name','LIKE', "%{$item}%")
                ->paginate(20);
        return view('pages.search',compact('brands','products'));
    }


    public function RegisterView()
    {
      return view('customer-registration');
    }

    public function CategoryWiseData(Request $request)
    {     

       $category = Category::where('category_slug',$request->path())->first();

       if(!empty($category)){
            switch ($category->category_type) {
                case 'parent_category':
                    $column = 'category_id'; 
                    break;
                case 'sub_category':
                    $column = 'subcategory_id'; 
                    break;
                case 'child_category':
                    $column = 'childcategory_id'; 
                    break;
                default :
                $column = 'category_id';
                break;
            }
           
            $data = Product::where($column,$category->id)->where('is_approved','1')->paginate(15);
            
            $productCount = Product::where($column,$category->id)->where('is_approved','1')->count();
            $category_type = $category->category_type;
            return view('pages.category_wise_product',compact(['data','category','productCount','category_type']));
       }else{
            return abort(404);
       }
       

    }

    

}
