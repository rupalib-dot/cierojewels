<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
use Auth;
use App\Rules\CheckeSellerSku;
use App\Rules\IgnoreSkuCode;
use App\Model\Admin\Product;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;



class ProductController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth:admin');
        $this->middleware('sellerdetailsverification');
        //$this->middleware('auth:admin');
    }

    //----------all--/read----------
    public function index()
    {   

        if(Auth::user()->user_type == 'admin'){
            $product = 
            $product=DB::table('products')
            ->join('categories','products.category_id','categories.id')            
            ->select('products.*','categories.category_name')->get();
        }else{

            $product=DB::table('products')
            ->join('categories','products.category_id','categories.id')
            ->select('products.*','categories.category_name')
            ->where('seller_id',Auth::user()->id)->get();
        }
        return view('admin.product.index',compact('product'));
    }


    public function resizeImage($file, $fileNameToStore) {
      // Resize image
      $resize = Image::make($file)->resize(600, null, function ($constraint) {
        $constraint->aspectRatio();
      })->encode('jpg');

      if($save) {
        return true;
      }
      return false;
    }

    //-----------add-------
    public function create()
    {
    	$category=DB::table('categories')->where('category_type','parent_category')->get();
        return view('admin.product.create',compact('category'));
    }

    //----subcategory collect by ajax request from category------
    public function GetSubcat($category_id)
    {
        $cat = DB::table("categories")->where("parent_id",$category_id)->where('category_type','sub_category')->get();
        if(count($cat) > 0){
            return json_encode($cat);
        }else{
            return json_encode(['status' => 'false' ]); 
        }
    }

    //--------insert------------
    public function store(Request $request)
    {   

        $validateData = $request->validate([
            'product_name' => ['required'],
            'product_sku' => ['required', new CheckeSellerSku],
            'product_quantity' => ['required'],
            'category_id' => ['required'],
            'subcategory_id' => ['required'],
            'childcategory_id' => ['required'],
            'product_size' => ['required'],
            'product_color' => ['required'],
            'sales_package' => ['required'],
            'material' => ['required'],
            'gross_weight' => ['required'],
            'mrp' => ['required'],
            'selling_price' => ['required'],
            'product_details' => ['required'],
            'image_one' => ['required'],
            'image_two' => ['required'],
            'image_three' => ['required'],
        ]);


        $store = new Product;
        $store->product_name = $request->product_name;
        $store->product_sku = $request->product_sku;
        $store->product_quantity = $request->product_quantity;
        $store->category_id = $request->category_id;
        $store->subcategory_id = $request->subcategory_id;
        $store->childcategory_id = $request->childcategory_id;
        $store->product_size = $request->product_size;
        $store->product_color = $request->product_color;
        $store->sales_package = $request->sales_package;
        $store->material = $request->material;
        $store->gross_weight = $request->gross_weight;
        $store->mrp = $request->mrp;
        $store->selling_price = $request->selling_price;
        $store->product_details = $request->product_details;
        $store->video_link = $request->video_link;
        $store->discount = ($request->mrp - $request->selling_price) / $request->mrp * 100;
        if(Auth::user()->user_type == 'admin'){
            $store->dealoftheday=$request->dealoftheday;
            $store->best_seller=$request->best_seller;
            $store->trend=$request->trend;
            $store->whats_new=$request->whats_new;
            $store->recently_view=$request->recently_view;
        }

        $store->status = 1;
        $store->seller_id = Auth::user()->id;
        $store->is_approved = '0';

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;


        if($image_one && $image_two && $image_three){
            
            $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('public/media/product/'.$image_one_name);
            $store->image_one ='public/media/product/'.$image_one_name;

            $image_two_name= hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300,300)->save('public/media/product/'.$image_two_name);
            $store->image_two ='public/media/product/'.$image_two_name;

            $image_three_name= hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300,300)->save('public/media/product/'.$image_three_name);
            $store->image_three ='public/media/product/'.$image_three_name;

        }
        
        if($store->save()){
            $productslug = rtrim(str_replace(' ', '-', strtolower(preg_replace('/[^- A-Za-z0-9\-]/','',$request->product_name))),'-').'-'.$store->id;
            DB::table('products')->where('id',$store->id)->update(['product_slug'=> $productslug]);

            $notification=array(
                'message'=>'Successfully Product Inserted ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification=array(
                'message'=>'Somehting Went Wrong ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }



    }

//---------Inactive-----------------
    public function Inactive($id)
    {
        DB::table('products')->where('id',$id)->update(['status'=> 0]);
        $notification=array(
                    'message'=>'Successfully Product Inactive',
                    'alert-type'=>'success'
                );
        return Redirect()->back()->with($notification);
    }

//---------Active-------------
    public function Active($id)
    {
        DB::table('products')->where('id',$id)->update(['status'=> 1]);
        $notification=array(
                    'message'=>'Successfully Product Aactive',
                    'alert-type'=>'success'
                );
        return Redirect()->back()->with($notification);
    }

//------------Delete----------------
    public function DeleteProduct($id)
    {
        $product=DB::table('products')->where('id',$id)->first();
        $image1=$product->image_one;
        $image2=$product->image_two;
        $image3=$product->image_three;
        unlink($image1);
        unlink($image2);
        unlink($image3);
        DB::table('products')->where('id',$id)->delete();
        $notification=array(
                     'message'=>'Successfully Product Deleted ',
                     'alert-type'=>'success'
                    );
         return Redirect()->back()->with($notification);

    }

//------------view-------------
    public function ViewProduct($id)
    {
        $product = Product::with(['Category','Subcategory','ChildCategory'])->where('id',$id)->first();
        return view('admin.product.show',compact('product'));

    }

//-----------edit-------------
    public function EditProduct($id)
    {
        $product=DB::table('products')->where('id',$id)->first();
        return view('admin.product.edit',compact('product'));
    }

//-----------Update-------------
    public function UpdateProductWithoutPhoto(Request $request,$id)
    {   

        $validateData = $request->validate([
            'product_name' => ['required'],
            'product_sku' => ['required', new IgnoreSkuCode($id)],
            'product_quantity' => ['required'],
            'category_id' => ['required'],
            'subcategory_id' => ['required'],
            'childcategory_id' => ['required'],
            'product_size' => ['required'],
            'product_color' => ['required'],
            'sales_package' => ['required'],
            'material' => ['required'],
            'gross_weight' => ['required'],
            'selling_price' => ['required'],
            'product_details' => ['required'],
        ]);


        $store = Product::find($id);

        $store->product_name = $request->product_name;
        $store->product_sku = $request->product_sku;
        $store->product_quantity = $request->product_quantity;
        $store->category_id = $request->category_id;
        $store->subcategory_id = $request->subcategory_id;
        $store->childcategory_id = $request->childcategory_id;
        $store->product_size = $request->product_size;
        $store->product_color = $request->product_color;
        $store->sales_package = $request->sales_package;
        $store->material = $request->material;
        $store->gross_weight = $request->gross_weight;
        $store->selling_price = $request->selling_price;
        $store->product_details = $request->product_details;
        $store->video_link = $request->video_link;
        $store->discount = ($store->mrp - $request->selling_price) / $store->mrp * 100;

        if(Auth::user()->user_type == 'admin'){

            $store->dealoftheday= $request->dealoftheday;
            $store->best_seller= $request->best_seller;
            $store->trend= $request->trend;
            $store->whats_new= $request->whats_new;
            $store->recently_view= $request->recently_view;
            $store->is_approved = $request->is_approved;
        }else{
            $store->is_approved = '0';
        }

        $store->status = 1;
        $productslug = rtrim(str_replace(' ', '-', strtolower(preg_replace('/[^- A-Za-z0-9\-]/','',$request->product_name))),'-').'-'.$store->id;
        $store->product_slug = $productslug;

        if($store->save()){
            $notification=array(
                    'message'=>'Successfully Product Updated ',
                    'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        }else{
            $notification=array(
                    'message'=>'Sorry Soemthing Went Wrong ',
                    'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }

    }

    //--------------------
    public function UpdateProductPhoto(Request $request,$id)
    {
        $old_one=$request->old_one;
        $old_two=$request->old_two;
        $old_three=$request->old_three;

        $image_one=$request->image_one;
        $image_two=$request->image_two;
        $image_three=$request->image_three;
        $data=array();

        if($image_one) {  //$request->has('image_one')
        unlink($old_one);
        $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
        Image::make($image_one)->resize(300,300)->save('public/media/product/'.$image_one_name);
        $data['image_one']='public/media/product/'.$image_one_name;
        DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                    'message'=>'Image One Updated ',
                    'alert-type'=>'success'
                    );
            return Redirect()->route('all.product')->with($notification);


        }if($image_two) {   ////$request->has('image_two')
        unlink($old_two);
        $image_two_name= hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
        Image::make($image_two)->resize(300,300)->save('public/media/product/'.$image_two_name);
        $data['image_two']='public/media/product/'.$image_two_name;
        DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                    'message'=>'Image Two Updated ',
                    'alert-type'=>'success'
                    );
            return Redirect()->route('all.product')->with($notification);

        }if($image_three) {     //$request->has('image_three')
        unlink($old_three);
        $image_three_name= hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
        Image::make($image_three)->resize(300,300)->save('public/media/product/'.$image_three_name);
        $data['image_three']='public/media/product/'.$image_three_name;
        DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                    'message'=>'Image Three Updated ',
                    'alert-type'=>'success'
                    );
            return Redirect()->route('all.product')->with($notification);

        //-----Not working from here---------
        }if($image_one && $image_two){      //$request->has('image_one') && $request->has('image_two')

        unlink($old_one);
        $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
        Image::make($image_one)->resize(300,300)->save('public/media/product/'.$image_one_name);
        $data['image_one']='public/media/product/'.$image_one_name;

        unlink($old_two);
        $image_two_name= hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
        Image::make($image_two)->resize(300,300)->save('public/media/product/'.$image_two_name);
        $data['image_two']='public/media/product/'.$image_two_name;

        DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                    'message'=>'Image One and Two Updated ',
                    'alert-type'=>'success'
                    );
            return Redirect()->route('all.product')->with($notification);



        }if($image_one && $image_two && $image_three){  //$request->has('image_one') && $request->has('image_two') && $request->has('image_three')
        unlink($old_one);
        unlink($old_two);
        unlink($old_three);
        $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
        Image::make($image_one)->resize(300,300)->save('public/media/product/'.$image_one_name);
        $data['image_one']='public/media/product/'.$image_one_name;

        $image_two_name= hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
        Image::make($image_two)->resize(300,300)->save('public/media/product/'.$image_two_name);
        $data['image_two']='public/media/product/'.$image_two_name;

        $image_three_name= hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
        Image::make($image_three)->resize(300,300)->save('public/media/product/'.$image_three_name);
        $data['image_three']='public/media/product/'.$image_three_name;

        DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                    'message'=>'Image One and Two and Three Updated ',
                    'alert-type'=>'success'
                    );
            return Redirect()->route('all.product')->with($notification);
        }
        return Redirect()->route('all.product');

    }


    public function pendingProducts()
    {      
       
        if(Auth::user()->user_type == 'admin'){
            $product=DB::table('products')
            ->join('categories','products.category_id','categories.id')
            ->select('products.*','categories.category_name')->where('is_approved','0')->get();
        }else{
            $product=DB::table('products')
            ->join('categories','products.category_id','categories.id')
            ->select('products.*','categories.category_name')->where('is_approved','0')->where('seller_id',Auth::user()->id)->get();
        }
        return view('admin.product.pending_products',compact('product'));
        
    }

}
