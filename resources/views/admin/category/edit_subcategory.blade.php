@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
    <div class="sl-pagebody">
      <div class="sl-page-title">
    	  <h5>Subcategory Update</h5>
    	</div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Subcategory Update</h6>
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

        <form action="{{url('update/subcategory/'.$subcategory->id)}}" method="POST">
            @csrf
            <div class="modal-body pd-20">
                <div class="form-group">
                    <label for="catname">Category Name</label>
                    <input type="text" class="form-control" name="category_name"  placeholder="Category Name" id="category_name" value="{{old('category_name',$subcategory->category_name)}}">
                </div>

                <div class="form-group">
                    <label for="category_image">Category Url</label>
                    <input type="text" name="category_slug" id="category_slug" class="form-control"  placeholder="Category Url" required="" value="{{old('category_slug',$subcategory->category_slug)}}">
                </div>


                <div class="form-group">
                    <label for="catid">Parent Category</label>
                    <select name="parent_id" id="parent_id" class="form-control">
                    @foreach ($category as $row)
                        <option value="{{$row->id}}" <?php if($row->id == old('parent_id',$subcategory->parent_id)) {
                            echo "selected";
                        } ?> >{{$row->category_name}}</option>
                    @endforeach
                </select>
                </div>

                <div class="form-group">
                    <label for="category_title">Category Title</label>
                    <textarea type="text" name="category_title" id="category_title" class="form-control"  placeholder="Category Title" required="">{{old('category_title',$subcategory->category_title)}}</textarea>
                </div>

                <div class="form-group">
                    <label for="category_title">Category Keyword</label>
                    <textarea type="text" name="category_keyword" id="category_keyword" class="form-control"  placeholder="Category Keyword" required="">{{old('category_keyword',$subcategory->category_keyword)}}</textarea>
                </div>

                <div class="form-group">
                    <label for="category_title">Category Description</label>
                    <textarea type="text" name="category_description" id="category_description" class="form-control"  placeholder="Category Description" required="">{{old('category_description',$subcategory->category_description)}}</textarea>
                </div>

                <div class="form-group">
                    <label for="catname">Status</label>
                    <select  class="form-control" name="status" id="status">
                        <option value="">--Select Status</option>
                        <option value="1" {{(old('status',$subcategory->status) == '1' ? 'selected' : '')}}>Active</option>
                        <option value="0" {{(old('status',$subcategory->status) == '0' ? 'selected' : '')}}>Deactive</option>
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
