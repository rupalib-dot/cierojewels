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
          <p>Please Complete Your Business Profile For Starting Business With Ciero Jewels</p>
        </div><!-- sl-page-title -->

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

        <form action="{{route('store-seller-business-profile')}}" method="POST">
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
					                <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Enter Business Name" value="{{old('business_name')}}" required="">
					            </div>
				            </div><!-- col -->
				            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
				              	<div class="form-group">
					                <label for="catname">GSTIN / Provisional ID Number <span class="text-danger">*</span></label>
					                <input type="text" class="form-control" name="gst" id="gst" placeholder="Enter GSTIN / Provisional ID Number"  value="{{old('gst')}}" required="">
					            </div>
				            </div><!-- col -->
				            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
				              	<div class="form-group">
					                <label for="catname">Registered Business Address <span class="text-danger">*</span></label>
					                <input type="text" class="form-control" name="register_business_address" id="register_business_address" placeholder="Enter Registered Business Address" value="{{old('register_business_address')}} " required="">
					            </div>
				            </div><!-- col -->

				            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
				              	<div class="form-group">
					                <label for="catname"> Business Type <span class="text-danger">*</span></label>
					                <select class="form-control" name="business_type" id="business_type" required="">
					                	<option value="">--Select Business Type--</option>
					                	<option value="sp" {{(old('business_type')  == 'sp' ? 'selected' : '')}}>Sole Proprietorship</option>
					                	<option value="pvt" {{(old('business_type')  == 'pvt' ? 'selected' : '')}}>Private Limited Company</option>
					                </select>
					               
					            </div>
				            </div>

				            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
				              	<div class="form-group">
					                <label for="catname">PAN <span class="text-danger">*</span></label>
					                <input type="text" class="form-control" name="pan" id="pan" placeholder="Enter PAN" value="{{old('pan')}}" required="">
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
				                <input type="text" class="form-control" name="acc_holder_name" id="acc_holder_name" placeholder="Enter Account Holder Name" value="{{old('acc_holder_name')}}" required="">
				            </div>
			            </div><!-- col -->
			            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
			              	<div class="form-group">
				                <label for="catname">Account Number <span class="text-danger">*</span></label>
				                <input type="number" class="form-control" name="account_number" id="account_number" placeholder="Enter Account Number" value="{{old('account_number')}}" required="">
				            </div>
			            </div><!-- col -->
			            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
			              	<div class="form-group">
				                <label for="catname">Bank Name <span class="text-danger">*</span></label>
				                <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Enter Bank Name" value="{{old('bank_name')}}" required="">
				            </div>
			            </div><!-- col -->

			            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
			              	<div class="form-group">
				                <label for="catname">City <span class="text-danger">*</span></label>
				                <input type="text" class="form-control" name="city" id="city" placeholder="Enter City" value="{{old('city')}}" required="">
				            </div>
			            </div>

			            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
			              	<div class="form-group">
				                <label for="catname">Branch <span class="text-danger">*</span></label>
				                <input type="text" class="form-control" name="branch" id="branch" placeholder="Enter Branch" value="{{old('branch')}}" required="">
				            </div>
			            </div>

			            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
			              	<div class="form-group">
				                <label for="catname">State <span class="text-danger">*</span></label>
				                <select name="state" id="state" class="form-control" required="">
				                <option value="">--Select State--</option>
								<option value="Andhra Pradesh" {{(old('state') == 'Andhra Pradesh' ? 'selected' : '')}}>Andhra Pradesh</option>
								<option value="Andaman and Nicobar Islands" {{(old('state') == 'Andaman and Nicobar Islands' ? 'selected' : '')}}>Andaman and Nicobar Islands</option>
								<option value="Arunachal Pradesh" {{(old('state') == 'Arunachal Pradesh' ? 'selected' : '')}}>Arunachal Pradesh</option>
								<option value="Assam" {{(old('state') == 'Assam' ? 'selected' : '')}}>Assam</option>
								<option value="Bihar" {{(old('state') == 'Bihar' ? 'selected' : '')}}>Bihar</option>
								<option value="Chandigarh" {{(old('state') == 'Chandigarh' ? 'selected' : '')}}>Chandigarh</option>
								<option value="Chhattisgarh" {{(old('state') == 'Chhattisgarh' ? 'selected' : '')}}>Chhattisgarh</option>
								<option value="Dadar and Nagar Haveli" {{(old('state') == 'Dadar and Nagar Haveli' ? 'selected' : '')}}>Dadar and Nagar Haveli</option>
								<option value="Daman and Diu" {{(old('state') == 'Daman and Diu' ? 'selected' : '')}}>Daman and Diu</option>
								<option value="Delhi" {{(old('state') == 'Delhi' ? 'selected' : '')}}>Delhi</option>
								<option value="Lakshadweep" {{(old('state') == 'Lakshadweep' ? 'selected' : '')}}>Lakshadweep</option>
								<option value="Puducherry" {{(old('state') == 'Puducherry' ? 'selected' : '')}}>Puducherry</option>
								<option value="Goa" {{(old('state') == 'Goa' ? 'selected' : '')}}>Goa</option>
								<option value="Gujarat" {{(old('state') == 'Gujarat' ? 'selected' : '')}}>Gujarat</option>
								<option value="Haryana" {{(old('state') == 'Haryana' ? 'selected' : '')}}>Haryana</option>
								<option value="Himachal Pradesh" {{(old('state') == 'Himachal Pradesh' ? 'selected' : '')}}>Himachal Pradesh</option>
								<option value="Jammu and Kashmir" {{(old('state') == 'Jammu and Kashmir' ? 'selected' : '')}}>Jammu and Kashmir</option>
								<option value="Jharkhand" {{(old('state') == 'Jharkhand' ? 'selected' : '')}}>Jharkhand</option>
								<option value="Karnataka" {{(old('state') == 'Karnataka' ? 'selected' : '')}}>Karnataka</option>
								<option value="Kerala" {{(old('state') == 'Kerala' ? 'selected' : '')}}>Kerala</option>
								<option value="Madhya Pradesh" {{(old('state') == 'Madhya Pradesh' ? 'selected' : '')}}>Madhya Pradesh</option>
								<option value="Maharashtra" {{(old('state') == 'Maharashtra' ? 'selected' : '')}}>Maharashtra</option>
								<option value="Manipur" {{(old('state') == 'Manipur' ? 'selected' : '')}}>Manipur</option>
								<option value="Meghalaya" {{(old('state') == 'Meghalaya' ? 'selected' : '')}}>Meghalaya</option>
								<option value="Mizoram" {{(old('state') == 'Mizoram' ? 'selected' : '')}}>Mizoram</option>
								<option value="Nagaland" {{(old('state') == 'Nagaland' ? 'selected' : '')}}>Nagaland</option>
								<option value="Odisha" {{(old('state') == 'Odisha' ? 'selected' : '')}}>Odisha</option>
								<option value="Punjab" {{(old('state') == 'Punjab' ? 'selected' : '')}}>Punjab</option>
								<option value="Rajasthan" {{(old('state') == 'Rajasthan' ? 'selected' : '')}}>Rajasthan</option>
								<option value="Sikkim" {{(old('state') == 'Sikkim' ? 'selected' : '')}}>Sikkim</option>
								<option value="Tamil Nadu" {{(old('state') == 'Tamil Nadu' ? 'selected' : '')}}>Tamil Nadu</option>
								<option value="Telangana" {{(old('state') == 'Telangana' ? 'selected' : '')}}>Telangana</option>
								<option value="Tripura" {{(old('state') == 'Tripura' ? 'selected' : '')}}>Tripura</option>
								<option value="Uttar Pradesh" {{(old('state') == 'Uttar Pradesh' ? 'selected' : '')}}>Uttar Pradesh</option>
								<option value="Uttarakhand" {{(old('state') == 'Uttarakhand' ? 'selected' : '')}}>Uttarakhand</option>
								<option value="West Bengal" {{(old('state') == 'West Bengal' ? 'selected' : '')}}>West Bengal</option>
								</select>
				            </div>
			            </div>

			            <div class="col-lg-4 mg-t-10 mg-lg-t-0">
			              	<div class="form-group">
				                <label for="catname">IFSC Code <span class="text-danger">*</span></label>
				                <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" placeholder="Enter IFSC Code" value="{{old('ifsc_code')}}" required="">
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
                <div class="row">
                	<div class="col-lg-4  mg-t-10 mg-lg-t-0">
		              	<div class="form-group">
			                <label for="catname">Display Name <span class="text-danger">*</span></label>
			                <input type="text" class="form-control" name="display_name" id="display_name" placeholder="Enter Display Name" value="{{old('display_name')}}" required="">
			            </div>
			        </div><!-- col -->
			       	<div class="col-lg-4 mg-t-10 mg-lg-t-0">
		              	<div class="form-group">
			                <label for="catname">Business Description <span class="text-danger">*</span></label>
			                <textarea  class="form-control" name="business_description" id="business_description" placeholder="Enter Business Description" required="">{{old('business_description')}}</textarea>  
			            </div>
			        </div><!-- col -->
                </div>
	                
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
                  <div class="row">
                	<div class="col-lg-4 mg-t-10 mg-lg-t-0">
                		<div class="form-group">
			                <label for="catname">Pick Up City <span class="text-danger">*</span></label>
			                <input  class="form-control" name="pickup_city" id="pickup_city" placeholder="Enter Pick Up City" value="{{old('pickup_city')}}" required="">  
			            </div>
                	</div>

                	<div class="col-lg-4 mg-t-10 mg-lg-t-0">	
		              	<div class="form-group">
			                <label for="catname">Pick Up Address <span class="text-danger">*</span></label>
			                <textarea  class="form-control" name="pickup_address" id="pickup_address" placeholder="Enter Pick Up Address" required="">{{old('pickup_address')}}</textarea>
			            </div>
		          	</div><!-- col -->
                  </div>
                </div>
              </div><!-- collapse -->
            </div><!-- card -->

            <button type="submit" class="btn btn-info pd-x-20">Submit</button>
          </div><!-- accordion -->
        </div><!-- card -->
        </form>
      </div><!-- sl-pagebody -->
    </div>
@endsection