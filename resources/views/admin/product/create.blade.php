@extends('admin.admin_layouts')

@section('admin_content')

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap-tagsinput.css')}}">

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">Starlight</a>
      <span class="breadcrumb-item active">Product Section</span>
    </nav>
    <div class="sl-pagebody">
           <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">New Product Add <a href="{{ route('all.product') }}" class="btn btn-success btn-sm pull-right">All Product</a></h6>
        <p class="mg-b-20 mg-sm-b-30">New product add form</p>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
        <!------ Form Starts --------->
        <form action="{{ route('store.product') }}" method="post" enctype="multipart/form-data">
            @csrf

        <div class="form-layout">
          <div class="row mg-b-25">
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Product Name <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="product_name"  placeholder="Product Name" value="{{old('product_name')}}" required="">                
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Product Sku <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="product_sku"   placeholder="Product Sku" required=""  value="{{old('product_sku')}}">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Quantity <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="product_quantity"  placeholder="Quantity" required="" value="{{old('product_quantity')}}">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                <select class="form-control select2" data-placeholder="Choose Category" name="category_id" required="">
                  <option value=""> Choose Category </option>

                  @foreach($category as $row)
                  <option value="{{ $row->id }}" {{(old('category_id') == $row->id ? 'selected' : '')}}>{{ $row->category_name }}</option>
                  @endforeach

                </select>
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">Sub Category: <span class="tx-danger">*</span></label>
                <select class="form-control select2" name="subcategory_id" required="">
                </select>
              </div>
            </div><!-- col-4 -->

            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">Child Category: <span class="tx-danger">*</span></label>
                <select class="form-control select2" name="childcategory_id"  id="childcategory_id" required="">


                </select>
              </div>
            </div><!-- col-4 -->
            {{-- <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                <select class="form-control select2" data-placeholder="Choose brand" name="brand_id">
                  <option>Choose Brand here</option>
                  @foreach($brand as $br)
                  <option value="{{ $br->id }}">{{ $br->brand_name }}</option>
                  @endforeach
                </select>
              </div>
            </div> --}}<!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Product Size <span class="tx-danger">*</span></label><br>
                <input class="form-control" type="text" placeholder="Product Size" name="product_size" id="size" data-role="tagsinput" required="" value="{{old('product_size')}}">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label><br>
                <input class="form-control lg-4" type="text" placeholder="Product Color" name="product_color" data-role="tagsinput" id="color" required=""  value="{{old('product_color')}}">
              </div>
            </div><!-- col-4 -->

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Sales Package <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="sales_package"  placeholder="Sales Package" required="" value="{{old('sales_package')}}" >
              </div>
            </div><!-- col-4 -->

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Material <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="material"  placeholder="Material" required=""  value="{{old('material')}}">
              </div>
            </div><!-- col-4 -->

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Gross weight <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="gross_weight"  placeholder="Gross weight" required="" value="{{old('gross_weight')}}">
              </div>
            </div><!-- col-4 -->

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">M.R.P <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="mrp"  placeholder="M.R.P" required="" value="{{old('mrp')}}">
              </div>

              <p>&#9432;  MRP Will Remain Unchangeable</p>
            </div><!-- col-4 -->

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Selling Price <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="selling_price"  placeholder="Selling Price" required="" value="{{old('selling_price')}}" >
              </div>
            </div><!-- col-4 -->


            

            <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Product Details<span class="tx-danger">*</span></label>
                  <textarea class="form-control" id="summernote" name="product_details" required="" value="{{old('product_details')}}"></textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Video Link</label>
                  <input class="form-control" placeholder="video link" name="video_link"  value="{{old('video_link')}}">
                </div>
            </div>

            <div class="col-lg-4">
                <label>Image One (Main Thumbnail)<span class="tx-danger">*</span></label>
                <label class="custom-file">
                <input type="file" id="file" class="custom-file-input" name="image_one" onchange="readURL(this);"  accept="image" required="">
                <span class="custom-file-control"></span>
                <img src="#" id="one" >
              </label>
            </div>
            <div class="col-lg-4">
                <label>Image Two : <span class="tx-danger">*</span></label>
                <label class="custom-file">
                <input type="file" id="file" class="custom-file-input" name="image_two" onchange="readURL1(this);"  accet="image" required="">
                <span class="custom-file-control"></span>
                <img src="#" id="two" >
              </label>
            </div>
            <div class="col-lg-4">
                <label>Image Three <span class="tx-danger">*</span></label>
                <label class="custom-file">
                <input type="file" id="file" class="custom-file-input" name="image_three" onchange="readURL2(this);"  accept="/image" required="">
                <span class="custom-file-control" ></span>
                <img src="#" id="three" >
              </label>
            </div>
          </div><!-- row -->
          

          

          @if(Auth::user()->user_type == 'admin')
          <br><hr>
            <div class="row">
              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="trend" value="1"  {{(old('trend') == '1' ? 'checked' : '')}}>
                  <span>Trending Products</span>
                </label>
              </div>
              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="whats_new" value="1" {{(old('whats_new') == '1' ? 'checked' : '')}}>
                  <span>Whats New</span>
                </label>
              </div>
              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="dealoftheday" value="1" {{(old('dealoftheday') == '1' ? 'checked' : '')}}>
                  <span>Deals of The Day</span>
                </label>
              </div>
              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="best_seller" value="1" {{(old('best_seller') == '1' ? 'checked' : '')}}>
                  <span>Best Seller</span>
                </label>
              </div>

               <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="recently_view" value="1" {{(old('recently_view') == '1' ? 'checked' : '')}}>
                  <span>Recently Viewed</span>
                </label>
              </div>
              
            </div>

            <br><hr>
           
          @endif

          <br><br><hr>
          <div class="form-layout-footer">
            <button class="btn btn-info mg-r-5" type="submit">Submit </button>
          </div><!-- form-layout-footer -->
        </div><!-- form-layout -->
        </form>
      </div><!-- card -->

    </div><!-- sl-pagebody -->
  </div><!-- sl-mainpanel -->

  @php print_r(url('/get/subcategory/')); @endphp

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
                    if (!('status' in data)){
                      var d =$('select[name="subcategory_id"]').empty();
                      $('select[name="subcategory_id"]').append('<option value="">--Select Sub Category--</option>');
                         $.each(data, function(key, value){
                             $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.category_name + '</option>');

                         });
                      }
                   },
               });
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
                    if (!('status' in data)){
                      var d =$('select[name="childcategory_id"]').empty();
                      $('select[name="childcategory_id"]').append('<option value="">--Select Child Category--</option>');
                         $.each(data, function(key, value){

                             $('select[name="childcategory_id"]').append('<option value="'+ value.id +'">' + value.category_name + '</option>');

                         });
                    }   
                   },
               });
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

