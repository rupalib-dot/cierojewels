<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Coupon;
use App\Model\Admin\Category;
use App\Model\Admin\Product;
use DB;
use Illuminate\Http\Request;
use Auth;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('sellerdetailsverification');
    }

//--------read-------
    public function coupon(){
        if(Auth::user()->user_type == 'admin'){
            $coupon=DB::table('coupons')->get();
            return view('admin.coupon.coupon',compact('coupon'));
        }else{
            $coupon=DB::table('coupons')->where('admin_id',Auth::user()->id)->get();
            return view('admin.coupon.coupon',compact('coupon'));
        }
    }

//--------enter----------
    public function storeCoupon(Request $request){

        $validataData =$request->validate([
            'coupon' => ['required'],
            'discount' => ['required'],
            'category' => ['required']
        ]);

        $coupen = new Coupon;
        $coupen->coupon = $request->coupon;
        $coupen->discount = $request->discount;
        $coupen->category = $request->category_id;
        $coupen->admin_id = Auth::user()->id;


        if($coupen->save()){
            $notification = array(
                'message'=>'Successfully Coupon Inserted',
                'alert-type'=>'success'
            );
        }else{
            $notification = array(
                'message'=>'Something Went Wrong',
                'alert-type'=>'error'
            );
        }

        return redirect()->back()->with($notification);
    }

//------ delete -------------
    public function deleteCoupon($id){
        $deleteCoupon = Coupon::find($id);
        if($deleteCoupon->delete()){  
            $notification = array(
                'message'=>'Successfully Coupon Deleted',
                'alert-type'=>'success'
            );
        }else{
            $notification = array(
                'message'=>'Something Went Wrong',
                'alert-type'=>'error'
            );
        }
        
        return redirect()->back()->with($notification);
    }

//--------edit----------------
    public function editCoupon($id){
        $coupon= DB::table('coupons')->where('id',$id)->first();
        $category = Category::where('id',$coupon->category)->first();
        return view('admin.coupon.edit_coupon',compact('coupon','category'));
    }

//-------update------
    public function updateCoupon(Request $request,$id){


        $validataData =$request->validate([
            'coupon' => ['required'],
            'discount' => ['required'],
        ]);
        
        $coupen = Coupon::find($id);
        $coupen->coupon = $request->coupon;
        $coupen->discount = $request->discount;
        $coupen->admin_id = Auth::user()->id;

        if($coupen->save()){
            $notification = array(
                'message'=>'Successfully Coupon Updated',
                'alert-type'=>'success'
            );
        }else{
            $notification = array(
                'message'=>'Something Went Wrong',
                'alert-type'=>'error'
            );
        }
        
        return redirect()->route('coupons')->with($notification);
    }


//---------------//------------------//-----------------//----------------//-------------------//


//----------------Newsletter--------------------
    public function newsletter(){
        $newsletter=DB::table('newsletters')->get();
        return view('admin.coupon.newsletter',compact('newsletter'));
    }
//------ delete -------------
    public function deletenewsletter($id){
        DB::table('newsletters')->where('id',$id)->delete();

        $notification = array(
            'message'=>'Successfully Deleted',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

//------------SEO------------
    public function Seo()
    {
        $seo=DB::table('seo')->first();
        return view('admin.coupon.seo',compact('seo'));
    }

    public function UpdateSeo(Request $request)
    {
        $id=$request->id;
        $data=array();
        $data['meta_title']=$request->meta_title;
        $data['meta_author']=$request->meta_author;
        $data['meta_tag']=$request->meta_tag;
        $data['meta_description']=$request->meta_description;
        $data['google_analytics']=$request->google_analytics;
        $data['bing_analytics']=$request->bing_analytics;
        DB::table('seo')->where('id',$id)->update($data);

        $notification=array(
                'message'=>'SEO Updated',
                'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }



}

