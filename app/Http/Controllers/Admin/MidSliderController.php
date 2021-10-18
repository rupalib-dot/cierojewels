<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Midslide;
use File;

class MidSliderController extends Controller
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

    public function midSlider()
    {
        $sliders= Midslide::all();
        return view('admin.mid-slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mid-slider.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StoremidSlider(Request $request)
    {
        $validateData = $request->validate([
            'image' => ['required','max:1024'],
            'link' => ['url','nullable']
        ]);

        $store = new Midslide;
        $store->link = $request->link;

        $filename = str_replace(' ','-', $request->image->getClientOriginalName());
        $request->image->move(public_path('media/middle_slider/'),$filename);
        $store->image ='public/media/middle_slider/'.$filename;

        if($store->save()){
            $notification = array(
                'message'=>'Successfully Middle Banner Inserted',
                'alert-type'=>'success'
            );

            return redirect()->route('mid-banner')->with($notification);
        }else{
            $notification = array(
                'message'=>'Something Went Wrong',
                'alert-type'=>'error'
            );

            return redirect()->route('mid-banner')->with($notification);
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
        $slider = Midslide::find($id);
        return view('admin.mid-slider.edit',compact(['slider']));
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
            'image' => ['max:1024','nullable'],
            'link' => ['url','nullable']
        ]);

        $store = Midslide::find($id);
        $store->link = $request->link;
        if($request->hasfile('image')){

            $imagePath = $store->image;

            if(File::Exists($imagePath)){
                File::delete($imagePath);
            }

            $filename = str_replace(' ','-', $request->image->getClientOriginalName());
            $request->image->move(public_path('media/middle_slider/'),$filename);
            $store->image ='public/media/middle_slider/'.$filename;
        }
        

        if($store->save()){
            $notification = array(
                'message'=>'Successfully Middle Banner Updated',
                'alert-type'=>'success'
            );

            return redirect()->route('mid-banner')->with($notification);
        }else{
            $notification = array(
                'message'=>'Something Went Wrong',
                'alert-type'=>'error'
            );

            return redirect()->route('mid-banner')->with($notification);
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
        $delete = Midslide::find($id);

        if($delete->delete()){
            $imagePath = $delete->image;

            if(File::Exists($imagePath)){
                File::delete($imagePath);
            }

            $notification = array(
                'message'=>'Successfully Middle Banner Deleted',
                'alert-type'=>'success'
            );

            return redirect()->route('mid-banner')->with($notification);
        }else{
            $notification = array(
                'message'=>'Somthing Went Wrong',
                'alert-type'=>'error'
            );

            return redirect()->route('mid-banner')->with($notification);
        }
    }
}
