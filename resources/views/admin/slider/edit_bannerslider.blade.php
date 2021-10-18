@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
    <div class="sl-pagebody">
      <div class="sl-page-title">
    	  <h5>Banner Slider Update</h5>
    	</div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Banner Slider Update</h6>
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

        <form action="{{url('update/banner-slider/'.$slider->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body pd-20">
                <div class="form-group">
                    <label for="catname">Slider Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="banner_image" id="banner_image">
                    <img src="{{URL::to($slider->banner_image)}}" style="height:40px; width:50px;">
                </div>
                <div class="form-group">
                    <label for="catname">Slider Link</label>
                    <input type="text" class="form-control" name="banner_link" id="banner_link" value="{{$slider->banner_link}}" placeholder="Slider Link"> 
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