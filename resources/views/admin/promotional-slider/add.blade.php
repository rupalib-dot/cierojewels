@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
    <div class="sl-pagebody">
      <div class="sl-page-title">
    	  <h5>Promotional Slider </h5>
    	</div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Promotional Slider Create</h6>
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

        <form action="{{route('store.promotional-slider')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body pd-20">
                <div class="form-group">
                    <label for="catname">Slider Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="image" id="image" required="">
                    
                </div>
                <div class="form-group">
                    <label for="catname">Slider Link</label>
                    <input type="text" class="form-control" name="link" id="link"  placeholder="Slider Link" value="{{old('link')}}"> 
                </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-info pd-x-20">Submit</button>
            </div>
            </form>
        </div><!-- table-wrapper -->
        </div><!-- card -->
    </div>

    @endsection