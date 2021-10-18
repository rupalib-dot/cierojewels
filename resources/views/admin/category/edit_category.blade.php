@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
    <div class="sl-pagebody">
      <div class="sl-page-title">
    	  <h5>Category Update</h5>
    	</div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Category Update</h6>
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

        <form action="{{url('update/category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body pd-20">
                <div class="form-group">
                    {{-- <input type="hidden" name="id" id="{{$category->id)}}"> --}}
                    <label for="catname">Category Name</label>
                    <input type="text" class="form-control" name="category_name" id="catname" value="{{old('category_name',$category->category_name)}}" required="">
                </div>

                <div class="form-group">
                    <label for="category_image">Category Image</label>
                    <input type="file" name="category_image" id="category_image" class="form-control" >
                    @if($category->category_image)
                    <img src="{{asset($category->category_image)}}" width="100" height="100">
                    @endif
                    @if($errors->has('category_image'))
                    <span class="text-danger">{{$errors->first('category_image')}}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="category_image">Category Url</label>
                    <input type="text" name="category_slug" id="category_slug" class="form-control"  placeholder="Category Url" required="" value="{{old('category_slug',$category->category_slug)}}">
                </div>

                <div class="form-group">
                    <label for="category_title">Category Title</label>
                    <textarea type="text" name="category_title" id="category_title" class="form-control"  placeholder="Category Title" required="">{{old('category_title',$category->category_title)}}</textarea>
                </div>

                <div class="form-group">
                    <label for="category_keyword">Category Keyword</label>
                    <textarea type="text" name="category_keyword" id="category_keyword" class="form-control"  placeholder="Category Keyword" required="">{{old('category_keyword',$category->category_keyword)}}</textarea>
                </div>

                <div class="form-group">
                    <label for="category_description">Category Description</label>
                    <textarea type="text" name="category_description" id="category_description" class="form-control"  placeholder="Category Description" required="">{{old('category_description',$category->category_description)}}</textarea>
                </div>


                <div class="form-group">
                    <label for="catname">Status</label>
                    <select  class="form-control" name="status" id="status" required="">
                        <option value="">--Select Status</option>
                        <option value="1" {{(old('status',$category->status) == '1' ? 'selected' : '')}}>Active</option>
                        <option value="0" {{(old('status',$category->status) == '0' ? 'selected' : '')}}>Deactive</option>
                    </select>
                    
                </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-info pd-x-20">Update</button>
              <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div><!-- table-wrapper -->
        </div><!-- card -->
    </div>

    @endsection