<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Review;

class ReviewController extends Controller
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
    public function index()
    {
        $data = Review::with(['Customer','Product'])->get();
        return view('admin.review.all-review',compact('data'));
    }


    public function newReview()
    {
        $data = Review::with(['Customer','Product'])->where('status','new')->get();
        return view('admin.review.new-review',compact('data'));
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {   
        $update  = Review::find($id);
        $update->status = 'active';
        if($update->save()){
            return redirect()->back()->with('success','Review Updated Successfully');
        }else{
            return redirect()->back()->with('success','Something Went Wrong');
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
        $delete = Review::find($id);
        if($delete->delete()){
            $notification = array(
                'message'=>'Comment  Deleted Successfully',
                'alert-type'=>'success'
            );

            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message'=>'Somthing Went Wrong',
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
