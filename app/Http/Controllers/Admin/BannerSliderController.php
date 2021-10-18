<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\BannerSlider;
use DB;
class BannerSliderController extends Controller
{
    
	public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('IsAdmin');
    }

    public function bannerSlider(){
        $sliders= BannerSlider::all();
        return view('admin.slider.bannerslider',compact('sliders'));
    }


    public function StorebannerSlider(Request $request){
        $validatedData = $request->validate([
            'banner_image'  => ['required','max:1024'],
        ]);

        $data=array();
        if(!empty($request->banner_link)){
        	$data['banner_link']=$request->banner_link;
        }
        
        $image = $request->file('banner_image');
	    $image_name= $image->getClientOriginalName();
	    $filename = pathinfo($image_name, PATHINFO_FILENAME);
	    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
	    $extension= strtolower($ext);
	    $image_full_name= $filename.time().'.'.$extension;
	    $upload_path= 'public/media/banner_slider/';
	    $image_url = $upload_path;
	    $success= $image->move($image_url,$image_full_name);
	    $data['banner_image']= $upload_path.$image_full_name;

	    //echo  $data['banner_image'];
	    //die;
	    DB::table('banner_sliders')->insert($data);

	    $notification = array(
	        'message'=>'Successfully Brand Inserted',
	        'alert-type'=>'success'
	    );
	    return redirect()->back()->with($notification);
        
    }


    public function editbannerSlider($id)
    {
    	$slider=BannerSlider::first();
        return view('admin.slider.edit_bannerslider',compact('slider'));
    }



    public function updatebannerSlider(Request $request, $id)
    {	

    	$validatedData = $request->validate([
            'banner_image'  => ['max:1024'],
        ]);

        $data=array();
        if(!empty($request->banner_link)){
        	$data['banner_link']=$request->banner_link;
        }

        $image = $request->file('banner_image');
        if($image){
        	$image_name= $image->getClientOriginalName();
		    $filename = pathinfo($image_name, PATHINFO_FILENAME);
		    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
		    $extension= strtolower($ext);
		    $image_full_name= $filename.time().'.'.$extension;
		    $upload_path= 'public/media/banner_slider/';
		    $image_url = $upload_path;
		    $success= $image->move($image_url,$image_full_name);
		    $data['banner_image']= $upload_path.$image_full_name;
        }
	
        DB::table('banner_sliders')->where('id',$id)->update($data);

        $notification = array(
            'message'=>'Successfully Banner Slider Updated!',
            'alert-type'=>'success'
        );
        return redirect()->route('banner-slider')->with($notification);

    }

    public function deletebannerSlider($id){
        $slider=DB::table('banner_sliders')->where('id',$id)->first();
        $image=$slider->banner_image;

        $delete=DB::table('banner_sliders')->where('id',$id)->delete();

        if($delete){
            if($image){
                unlink($image);
            }
            $notification = array(
                'message'=>'Successfully Banner Slider Deleted',
                'alert-type'=>'success'
            );
            return redirect()->route('mid-banner')->with($notification);
        }
        else{
            $notification = array(
                'message'=>'Something Went Wrong!',
                'alert-type'=>'error'
            );
            return redirect()->route('mid-banner')->with($notification);
        }
    }



   
}
