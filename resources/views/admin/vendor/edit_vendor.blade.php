@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
    <div class="sl-pagebody">
      <div class="sl-page-title">
    	  <h5>Vendor Update</h5>
    	</div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Vendor Update</h6>
        <br>
        <div class="table-wrapper">
{{-- validation error --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
{{--End validation error --}}

        <form action="{{url('update/seller/'.$data->id)}}" method="POST">
            @csrf
            <div class="modal-body pd-20">
                <div class="form-group">
                    <label for="sellername">Seller Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$data->name}}" placeholder="Seller Name"> 
                </div>
                <div class="form-group">
                    <label for="catname">Seller Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="email" id="email" value="{{$data->email}}" placeholder="Seller Email"> 
                </div>

                <div class="form-group">
                    <label for="catname">Seller Mobile No <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{$data->phone}}" placeholder="Seller Mobile No"> 
                </div>

                <div class="form-group">
                    <label for="catname">Seller Business Status <span class="text-danger">*</span></label>
                    <select name="seller_detail_verification" class="form-control">
                        <option value="">--Select Status--</option>
                        <option value="1" {{(old('seller_detail_verification',$data->seller_detail_verification) == '1' ?  'selected' : '')}}>Verified</option>
                        <option value="0" {{(old('seller_detail_verification',$data->seller_detail_verification) == '0' ?  'selected' : '')}}>Not Verified</option>
                    </select>
                </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-info pd-x-20">Update</button>
            </div>
            </form>
        </div><!-- table-wrapper -->
        </div><!-- card -->
    </div>

    @endsection