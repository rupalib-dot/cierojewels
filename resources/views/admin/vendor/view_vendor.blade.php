@extends('admin.admin_layouts')
@section('admin_content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <a class="breadcrumb-item" href="index.html">Seller Business Profile</a>
        <span class="breadcrumb-item active">Accordion</span>
      </nav>

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Business Profile</h5>
        </div><!-- sl-page-title -->
        @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    	@if(session('error'))<div class="alert alert-error">{{ session('error') }}</div>@endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      	@if(!empty($data))
        <form action="{{route('update-seller-business',$data->id)}}" method="POST">
        @method('POST')
        @csrf
        <div class="card pd-20 pd-sm-40">
            <div class="card">
              <div class="card-header">
                <h6 class="mg-b-0">
                  <a  class="tx-gray-80">
                    Business detail
                  </a>
                </h6>
              </div><!-- card-header -->

              <div>
                <div class="card-body">
		                <div class="row">
				            <div class="col-lg-4">
				              <div class="form-group">
					                <label for="catname">Business Name <span class="text-danger">*</span></label>
					                <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Enter Business Name" value="{{old('business_name',$data->business_name)}}" >
					            </div>
				            </div><!-- col -->
				            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
				              	<div class="form-group">
					                <label for="catname">GSTIN / Provisional ID Number <span class="text-danger">*</span></label>
					                <input type="text" class="form-control" name="gst" id="gst" placeholder="Enter GSTIN / Provisional ID Number"  value="{{old('gst',$data->gst)}}">
					            </div>
				            </div><!-- col -->
				            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
				              	<div class="form-group">
					                <label for="catname">Registered Business Address <span class="text-danger">*</span></label>
					                <input type="text" class="form-control" name="register_business_address" id="register_business_address" placeholder="Enter Registered Business Address" value="{{old('register_business_address',$data->register_business_address)}}">
					            </div>
				            </div><!-- col -->

				            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
				              	<div class="form-group">
					                <label for="catname"> Business Type <span class="text-danger">*</span></label>
					                <select class="form-control" name="business_type" id="business_type">
					                	<option value="">--Select Business Type--</option>
					                	<option value="sp" {{(old('business_type',$data->business_type)  == 'sp' ? 'selected' : '')}}>Sole Proprietorship</option>
					                	<option value="pvt" {{(old('business_type',$data->business_type)  == 'pvt' ? 'selected' : '')}}>Private Limited Company</option>
					                </select>
					               
					            </div>
				            </div>

				            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
				              	<div class="form-group">
					                <label for="catname">PAN <span class="text-danger">*</span></label>
					                <input type="text" class="form-control" name="pan" id="pan" placeholder="Enter PAN" value="{{old('pan',$data->pan)}}">
					            </div>
				            </div>
				        </div>
              	</div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h6 class="mg-b-0">
                  <a class="tx-gray-80 ">
                    Bank Details
                  </a>
                </h6>
              </div>
              <div >
                <div class="card-body">
                	
		                <div class="row">
		                 	
				            <div class="col-lg-4">
				              <div class="form-group">
					                <label for="catname">Account Holder Name <span class="text-danger">*</span></label>
					                <input type="text" class="form-control" name="acc_holder_name" id="acc_holder_name" placeholder="Enter Account Holder Name" value="{{old('acc_holder_name',$data->acc_holder_name)}}">
					            </div>
				            </div><!-- col -->
				            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
				              	<div class="form-group">
					                <label for="catname">Account Number <span class="text-danger">*</span></label>
					                <input type="number" class="form-control" name="account_number" id="account_number" placeholder="Enter Account Number" value="{{old('account_number',$data->account_number)}}">
					            </div>
				            </div><!-- col -->
				            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
				              	<div class="form-group">
					                <label for="catname">Bank Name <span class="text-danger">*</span></label>
					                <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Enter Bank Name" value="{{old('bank_name',$data->bank_name)}}">
					            </div>
				            </div><!-- col -->

				            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
				              	<div class="form-group">
					                <label for="catname">City <span class="text-danger">*</span></label>
					                <input type="text" class="form-control" name="city" id="city" placeholder="Enter City" value="{{old('city',$data->city)}}">
					            </div>
				            </div>

				            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
				              	<div class="form-group">
					                <label for="catname">Branch <span class="text-danger">*</span></label>
					                <input type="text" class="form-control" name="branch" id="branch" placeholder="Enter Branch" value="{{old('branch',$data->branch)}}">
					            </div>
				            </div>

				            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
				              	<div class="form-group">
					                <label for="catname">State <span class="text-danger">*</span></label>
					                <input type="text" class="form-control" name="state" id="state" placeholder="Enter State" value="{{old('state',$data->state)}}">
					            </div>
				            </div>

				            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
				              	<div class="form-group">
					                <label for="catname">IFSC Code <span class="text-danger">*</span></label>
					                <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" placeholder="Enter IFSC Code" value="{{old('ifsc_code',$data->ifsc_code)}}">
					            </div>
				            </div>
				        </div>

		                
		           
              	</div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" role="tab" id="headingThree">
                <h6 class="mg-b-0">
                  <a class="tx-gray-80">
                    Display information
                  </a>
                </h6>
              </div>
              <div >
                <div class="card-body">
                 <div class="col-lg-4  mg-t-10 mg-lg-t-0">
		              <div class="form-group">
			                <label for="catname">Display Name <span class="text-danger">*</span></label>
			                <input type="text" class="form-control" name="display_name" id="display_name" placeholder="Enter Display Name" value="{{old('display_name',$data->display_name)}}">
			            </div>
		         </div><!-- col -->
		          <div class="col-lg-4 mg-t-10 mg-lg-t-0">
	              	<div class="form-group">
		                <label for="catname">Business Description <span class="text-danger">*</span></label>
		                <textarea  class="form-control" name="business_description" id="business_description" placeholder="Enter Business Description">{{old('business_description',$data->business_description)}}</textarea>
		                
		            </div>
		          </div><!-- col -->
                </div>
              </div><!-- collapse -->
            </div><!-- card -->

            <div class="card">
              <div class="card-header" role="tab" id="headingFour">
                <h6 class="mg-b-0">
                  <a class="tx-gray-80">
                    Pick up Address
                  </a>
                </h6>
              </div>
              <div >
                <div class="card-body">
                  <div class="col-lg-4 mg-t-10 mg-lg-t-0">

                  	<div class="form-group">
		                <label for="catname">Pick Up City <span class="text-danger">*</span></label>
		                <input  class="form-control" name="pickup_city" id="pickup_city" placeholder="Enter Pick Up City" value="{{old('pickup_city',$data->pickup_city)}}">
		                
		            </div>
	              	<div class="form-group">
		                <label for="catname">Pick Up Address <span class="text-danger">*</span></label>
		                <textarea  class="form-control" name="pickup_address" id="pickup_address" placeholder="Enter Pick Up Address">{{old('pickup_address',$data->pickup_address)}}</textarea>
		                
		            </div>
		          </div><!-- col -->
                </div>
              </div><!-- collapse -->
            </div><!-- card -->

            

            <button type="submit" class="btn btn-info pd-x-20">Update</button>
          </div><!-- accordion -->
        </div><!-- card -->
        </form>
        @else

        <div class="sl-pagebody">
	      <div class="card pd-20 pd-sm-40">
	        <h6 class="card-body-title">{{'Seller has not filled business information yet'}}</h6>
	     </div><!-- sl-pagebody -->
    	</div>
        
        @endif
      </div><!-- sl-pagebody -->
    </div>
@endsection