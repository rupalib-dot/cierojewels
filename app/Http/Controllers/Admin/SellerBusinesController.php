<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\SellerBusinessProfile;
use Auth;

class SellerBusinesController extends Controller
{
    public function SellerBusinessProfileView($value='')
    {	 

    	$data = SellerBusinessProfile::where('seller_id',Auth::user()->id)->first();
       
    	if(!empty($data)){
    		return redirect()->route('show-seller-business-profile');
    	}else{
    		return view('admin.seller.seller_business_profile');
    	}
    	
    }

    public function StoreBusinessProfile(Request $request)
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

    	
    	
		$store = new SellerBusinessProfile;
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
		$store->seller_id = Auth::user()->id;
		$store->save();
    	return redirect()->route('show-seller-business-profile')->with('Information Store Successfully');
    }

    public function showBusinessProfile()
    {
    	$data = SellerBusinessProfile::with('VerificationData')->where('seller_id',Auth::user()->id)->first();
    	return view('admin.seller.showbusinessdetail',compact(['data']));
    }
   

}
