@extends('admin.admin_layouts')

@section('admin_content')

@php
  $category=DB::table('categories')->where('category_type','parent_category')->get();
  $subcategory=DB::table('categories')->where(['category_type'=>'sub_category','parent_id' => $product->category_id])->get();
  //echo $product->subcategory_id;
  //die;
  $childcategory=DB::table('categories')->where(['category_type'=>'child_category','subparent_id' => $product->subcategory_id])->get();

  //print_r($childcategory->toArray());
@endphp

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap-tagsinput.css')}}">

    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Starlight</a>
        <span class="breadcrumb-item active">Edit Product Section</span>
      </nav>
      <div class="sl-pagebody">
      	   <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Update Product </h6>
          @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
          <form action="{{ url('update/product/withoutphoto/'.$product->id) }}" method="post" >
          	@csrf
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Product Name <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="product_name" value="{{ $product->product_name }}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Product SKU <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="product_sku" value="{{ $product->product_sku }}" placeholder="Product SKU">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Quantity <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="product_quantity" value="{{ $product->product_quantity }}" >
                </div>
              </div><!-- col-6 -->
              {{-- <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Discount Price <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="discount_price" value="{{ $product->discount_price }}" >
                </div>
              </div> --}}<!-- col-6 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" data-placeholder="Choose Category" name="category_id">
                    {{-- <option label="Choose Category"></option> --}}
                    <option value="">--Select  Category--</option>
                    @foreach($category as $row)
                    <option value="{{ $row->id }}" <?php if ($row->id == $product->category_id) {
                    	echo "selected";
                    } ?> >{{ $row->category_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Sub Category: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="subcategory_id">
                    <option value="">--Select Sub Category--</option>
                     @foreach($subcategory as $row)
                    <option value="{{ $row->id }}" <?php if ($row->id == $product->subcategory_id) {
                    	echo "selected";
                    } ?> >{{ $row->category_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                {{$product->childcategory_id}}
                <label class="form-control-label">Child Category: <span class="tx-danger">*</span></label>
                <select class="form-control select2" name="childcategory_id" required id="childcategory_id">
                  <option value="">--Select Child Category--</option>
                  @foreach($childcategory as $row)
                  <option value="{{$row->id}}" {{($row->id == $product->childcategory_id ? 'selected' : '')}}>{{$row->category_name}}</option>
                  @endforeach
                </select>
              </div>
            </div><!-- col-4 -->

              
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label><br>
                  <input class="form-control" type="text" name="product_size" id="size" data-role="tagsinput" value="{{ $product->product_size }}">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label><br>
                  <input class="form-control lg-4" type="text" name="product_color" data-role="tagsinput" id="color" value="{{ $product->product_color }}">
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Sales Package <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="sales_package"  placeholder="Sales Package" required="" value="{{ $product->sales_package }}" >
              </div>
            </div><!-- col-4 -->

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Material <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="material"  placeholder="Material" required=""  value="{{ $product->material }}"> 
              </div>
            </div><!-- col-4 -->

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Gross weight <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="gross_weight"  placeholder="Gross weight" required=""  value="{{ $product->gross_weight }}">
              </div>
            </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">M.R.P <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="mrp"  placeholder="M.R.P" required  value="{{ $product->mrp }}" disabled="">
                </div>

                <p>&#9432;  MRP Will Remain Unchangeable</p>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Selling Price <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="selling_price"  placeholder="Selling Price" value="{{ $product->selling_price }}">
                </div>
              </div><!-- col-4 -->
              @if(Auth::user()->user_type === 'admin')
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label" >Approve Product <span class="tx-danger">*</span></label>
                  <select name="is_approved" class="form-control" required="">
                    <option value="">--Select Approval</option>
                    <option value="1" {{(old('is_approved',$product->is_approved) == '1' ? 'selected' : '')}}> Approved</option>
                    <option value="0" {{(old('is_approved',$product->is_approved) == '0' ? 'selected' : '')}}> Pending</option>
                  </select>
                </div>
              </div><!-- col-4 -->
              @endif
              <div class="col-lg-12">
              	<div class="form-group">
                  <label class="form-control-label">Product Details<span class="tx-danger">*</span></label>
                   <textarea class="form-control" id="summernote" name="product_details" >
                   	 {{ $product->product_details}}
                   </textarea>
                </div>
              </div>
              <div class="col-lg-12">
              	<div class="form-group">
                  <label class="form-control-label">Video Link<span class="tx-danger">*</span></label>
                   <input class="form-control" placeholder="video link" name="video_link" value="{{ $product->video_link }}">
                </div>
              </div>


            </div><!-- row -->
            <hr>
            @if(Auth::user()->user_type == 'admin')
            <div class="row">
            	<div class="col-lg-4">
            		<label class="ckbox">

      					  <input type="checkbox" name="trend" value="1" {{(old('trend',$product->trend) == '1' ? 'checked' : '')}}  >
      					  <span>Trending Products</span>
      					</label>
            	</div>
            	<div class="col-lg-4">
            		<label class="ckbox">
      					  <input type="checkbox" name="whats_new" value="1" {{(old('whats_new',$product->whats_new) == '1' ? 'checked' : '')}} <?php if ($product->whats_new == 1) {
      					  	echo "checked";
      					  }?>>
      					  <span>Whats New</span>
      					</label>
            	</div>
            	<div class="col-lg-4">
            		<label class="ckbox">
      					  <input type="checkbox" name="dealoftheday" value="1" {{(old('dealoftheday',$product->dealoftheday) == '1' ? 'checked' : '')}}>
      					  <span>Deals of The Day</span>
      					</label>
            	</div>
            	<div class="col-lg-4">
            		<label class="ckbox">
      					  <input type="checkbox" name="best_seller" value="1"  {{(old('best_seller',$product->best_seller) == '1' ? 'checked' : '')}} >
      					  <span>Best Seller</span>
      					</label>
            	</div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="recently_view" value="1" {{(old('recently_view',$product->recently_view) == '1' ? 'checked' : '')}}>
                  <span>Recently Viewed</span>
                </label>
              </div>
            	
            </div>

            <br><hr>
            @endif
            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5" type="submit">Update </button>
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
          </form>
        </div><!-- card -->
    </div><!-- sl-pagebody -->




<!---------- Update Product With Photo ---------------->


       <div class="sl-pagebody">
      	   <div class="card pd-20 pd-sm-40">
               <h6 class="card-body-title">Update Product With Photo</h6>
               <form action="{{ url('update/product/photo/'.$product->id) }}" method="post" enctype="multipart/form-data">
               	@csrf
               <div class="row">
               	 <div class="col-lg-6 col-sm-6">
               	 	<label>Image One (Main Thumbnail)<span class="tx-danger">*</span></label><br>
              	     <label class="custom-file">
      				  <input type="file" id="file" class="custom-file-input" name="image_one" onchange="readURL(this);"  accept="image">
      				  <span class="custom-file-control"></span>
      				   <input type="hidden" name="old_one" value="{{ $product->image_one }}">
      				  <img src="#" id="one" >
      				</label>
               	 </div>
               	 <div class="col-lg-6 col-sm-6">
               	 	<img src="{{ URL::to($product->image_one) }}" style="height: 80px; width: 80px;">
               	 </div>
               </div>
        	   <div class="row">
               	 <div class="col-lg-6 col-sm-6">
               	 	<label>Image Two <span class="tx-danger">*</span></label><br>
              	     <label class="custom-file">
      				  <input type="file" id="file" class="custom-file-input" name="image_two" onchange="readURL1(this);"  accept="image">
      				  <input type="hidden" name="old_two" value="{{ $product->image_two }}">
      				  <span class="custom-file-control"></span>
      				  <img src="#" id="two" >
      				</label>
               	 </div>
               	 <div class="col-lg-6 col-sm-6">
               	 	<img src="{{ URL::to($product->image_two) }}" style="height: 80px; width: 80px;">
               	 </div>
               </div>
                <div class="row">
               	 <div class="col-lg-6 col-sm-6">
               	 	<label>Image Three <span class="tx-danger">*</span></label><br>
              	     <label class="custom-file">
      				  <input type="file" id="file" class="custom-file-input" name="image_three" onchange="readURL2(this);"  accept="image">
      				  <span class="custom-file-control"></span>
      				  <img src="#" id="three" >
      				   <input type="hidden" name="old_three" value="{{ $product->image_three }}">
      				</label>
               	 </div>
               	<div class="col-lg-6 col-sm-6">
               	 	<img src="{{ URL::to($product->image_three) }}" style="height: 80px; width: 80px;">
                </div>

               	 <button type="submit" class="btn btn-sm btn-warning">Update Photo</button>
               </form>

           </div>
       </div>
    </div><!-- sl-mainpanel -->

        <!-------------jQuery file/cdn------------------>
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script> --}}
<script src="{{ asset('public/backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/backend/js/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('public/backend/js/bootstrap-tagsinput.min.js') }}"></script>


<!--------JQ for getting "subcategory" after "category"--------->
<script type="text/javascript">
    $(document).ready(function() {
       $('select[name="category_id"]').on('change', function(){
           var category_id = $(this).val();
           if(category_id) {
               $.ajax({
                   url: "{{  url('/get/subcategory/') }}/"+category_id,
                   type:"GET",
                   dataType:"json",
                   success:function(data) {
                      var d =$('select[name="subcategory_id"]').empty();
                         $.each(data, function(key, value){
                             $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.category_name + '</option>');

                         });
                   },
               });
           } else {
               alert('danger');
           }
       });

       $('select[name="subcategory_id"]').on('change', function(){
           var subcategory_id = $(this).val();
           if(subcategory_id) {
               $.ajax({
                  headers:{
                    'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('content')
                  },
                   url: "{{route('get-child-categories')}}",
                   type:"POST",
                   data:{subcategory_id:subcategory_id},
                   dataType:"json",
                   success:function(data) {
                      var d =$('select[name="childcategory_id"]').empty();
                      $('select[name="childcategory_id"]').append('<option value="">--Select Child Category--</option>');
                      if(data.status == 'false'){
                        
                      }else{
                        $.each(data, function(key, value){

                             $('select[name="childcategory_id"]').append('<option value="'+ value.id +'">' + value.category_name + '</option>');

                         });
                      }
                         
                   },
               });
           } else {
               alert('danger');
           }
       });
       
   });
</script>


<!--------JQ for image--------->
<script type="text/javascript">
	function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#one')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
<script type="text/javascript">
	function readURL1(input) {                  //------------
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#two')                         //------------
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
<script type="text/javascript">
	function readURL2(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#three')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>


@endsection
