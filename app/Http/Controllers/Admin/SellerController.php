<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Model\Admin\SellerBusinessProfile;
use Illuminate\Validation\Rule;
class SellerController extends Controller
{
   public function SellerList()
   {
   	 	$data = Admin::orderBy('id','desc')->where('user_type','seller')->get();
   	 	return view('admin.vendor.vendor_list',compact(['data']));
   }



   public function EditSeller($id)
   {	

   		$data = Admin::find($id);
   		return view('admin.vendor.edit_vendor',compact(['data']));
   }

   public function ViewBusinessProfile($id)
   {
      
      $data = SellerBusinessProfile::where('seller_id',$id)->first();
      return view('admin.vendor.view_vendor',compact(['data']));

   }

   public function UpdateSeller(Request $request,$id)
   {
      $validateData = $request->validate([
         'name' => ['required', 'string', 'max:255'],
         'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore($id)],
         'phone' => ['required', 'string', 'max:255', Rule::unique('admins')->ignore($id)],
         'seller_detail_verification' => ['required']
      ]);
      

      $store = Admin::find($id);
      $store->name = $request->name;
      $store->email = $request->email;
      $store->phone = $request->phone;
      $store->seller_detail_verification = $request->seller_detail_verification;
      $store->save();
      return redirect()->back()->with('Row Updated SuccesfullyViewBusinessProfile');
   }

   public function UpdateSellerBusinessProfile(Request $request, $id)
   {  
      $validateData =$request->validate([
         'business_name' => ['required'],
         'gst' => ['required'],
         'register_business_address' => ['required'],
         'business_type' => ['required'],
         'pan' => ['required'],
         'acc_holder_name' => ['required'],
         'account_number' => ['required'],
         'bank_name' => ['required'],
         'city' => ['required'],
         'branch' => ['required'],
         'state' => ['required'],
         'ifsc_code' => ['required'],
         'display_name' => ['required'],
         'business_description' => ['required'],
         'pickup_city' => ['required'],
         'pickup_address' => ['required'],
      ]);

      $store = SellerBusinessProfile::find($id);
      
      $store->business_name = $request->business_name;
      $store->gst = $request->gst;
      $store->register_business_address = $request->register_business_address;
      $store->business_type = $request->business_type;
      $store->pan = $request->pan;
      $store->account_number = $request->account_number;
      $store->acc_holder_name = $request->acc_holder_name;
      //$store->account_number = $request->account_number;
      $store->bank_name = $request->bank_name;
      $store->city = $request->city;
      $store->branch = $request->branch;
      $store->state = $request->state;
      $store->ifsc_code = $request->ifsc_code;
      $store->display_name = $request->display_name;
      $store->business_description = $request->business_description;
      $store->pickup_city = $request->pickup_city;
      $store->pickup_address = $request->pickup_address;
      if($store->save()){
         return redirect()->back()->with('success','Information Store Successfully');
      }else{
         return redirect()->back()->with('error','Somthing Went Wrong');
      }
      
   }



}
