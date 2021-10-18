@extends('admin.admin_layouts')

@section('admin_content')

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap-tagsinput.css')}}">

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">Starlight</a>
      <span class="breadcrumb-item active">Business Profile Detail</span>
    </nav>
    
    @if(isset($data->verification_data) && $data->verification_data->seller_detail_verification == '0')
    <div class="col-xs-12" >
      <h3 class="btn-info">Your details are under verification.Our team will contact you soon.</h3>
    </div>
    $data->verification_data->seller_detail_verification = 
    @endif
    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title"> Business Detail</h6>
        @if(!empty($data))
        <div class="form-layout">
          <div class="row mg-b-25">
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Business Name <span class="tx-danger">*</span></label>
                <br>
                <strong>{{$data->business_name}}</strong>
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">GSTIN / Provisional ID Number <span class="tx-danger">*</span></label>
                 <br>
                <strong>{{$data->gst}}</strong>
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Registered Business Address <span class="tx-danger">*</span></label>
                <br>
                <strong>{{$data->register_business_address}}</strong>
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">Business Type  <span class="tx-danger">*</span></label>
                 <br>
                <strong>@if($data->business_type == 'pvt')
                  {{'Private Limited Company'}}
                  @elseif($data->business_type == 'sp')
                  {{'Sole Proprietorship'}}
                  @endif
                </strong>
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">PAN : <span class="tx-danger">*</span></label>
                 <br>
                <strong>{{$data->pan}}</strong>
              </div>
            </div>
            <br><hr>

          </div><!-- row -->
       </div><!-- card -->
       

     </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->

    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title"> Bank Details</h6>
       
        <div class="form-layout">
          <div class="row mg-b-25">
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Account Holder Name <span class="tx-danger">*</span></label>
                <br>
                <strong>{{$data->acc_holder_name}}</strong>
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Account Number <span class="tx-danger">*</span></label>
                 <br>
                <strong>{{$data->account_number}}</strong>
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Bank Name <span class="tx-danger">*</span></label>
                <br>
                <strong>{{$data->bank_name}}</strong>
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">City  <span class="tx-danger">*</span></label>
                 <br>
                <strong>{{$data->city}}</strong>
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">Branch : <span class="tx-danger">*</span></label>
                 <br>
                <strong>{{$data->branch}}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">State : <span class="tx-danger">*</span></label>
                 <br>
                <strong>{{$data->state}}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">IFSC Code : <span class="tx-danger">*</span></label>
                 <br>
                <strong>{{$data->ifsc_code}}</strong>
              </div>
            </div>


            <br><hr>

          </div><!-- row -->
       </div><!-- card -->

     </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->

    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title"> Display information</h6>
       
        <div class="form-layout">
          <div class="row mg-b-25">
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Display Name <span class="tx-danger">*</span></label>
                <br>
                <strong>{{$data->display_name}}</strong>
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Business Description <span class="tx-danger">*</span></label>
                 <br>
                <strong>{{$data->business_description}}</strong>
              </div>
            </div><!-- col-4 -->
            <br><hr>

          </div><!-- row -->
       </div><!-- card -->
     </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->

    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Pick Up Detail</h6>
       
        <div class="form-layout">
          <div class="row mg-b-25">
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Pickup City <span class="tx-danger">*</span></label>
                <br>
                <strong>{{$data->pickup_city}}</strong>
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Pickup Address <span class="tx-danger">*</span></label>
                 <br>
                <strong>{{$data->pickup_address}}</strong>
              </div>
            </div><!-- col-4 -->
            <br><hr>
          </div><!-- row -->
       </div><!-- card -->

     </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    @else
     <div>
       {{'You have not filled any details yet'}}
     </div>
     @endif
    




@endsection
