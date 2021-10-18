@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <div class="sl-pagebody">
          <div class="sl-page-title">
              <h5>Subcategory Table</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Subcategory List
                <a href="#" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3">Add New</a>
            </h6>
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

              <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                    <th class="wd-15p">ID</th>
                    <th class="wd-15p">Category name</th>
                    <th class="wd-15p">Category Slug</th>
                    <th class="wd-15p">Parent Category Name</th>
                    <th class="wd-15p">Status</th>
                    <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($subcategory as $row)
                <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->category_name}}</td>
                <td><a href="{{url($row->category_slug)}}">{{$row->category_slug}}</a> </td>
                <td>{{(isset($row->parentCategory) ?  $row->parentCategory->category_name : '')}}</td>
                <td>{{($row->status == '1' ? 'Active' : 'Deactive')}}</td>
                <td>
                    <a href="{{url('edit/subcategory/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <a href="{{url('delete/subcategory/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                </td>
                </tr>
                @endforeach
            </tbody>
            </table>
            </div><!-- table-wrapper -->
            </div><!-- card -->
        </div>
    </div>


             <!-- LARGE MODAL -->
     <div id="modaldemo3" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
              <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Subcategory Add</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            {{-- form --}}
            <form action="{{route('store.subcategory')}}" method="POST">
            @csrf
            <div class="modal-body pd-20">
                <div class="form-group">
                    <label for="catname">Category Name</label>
                    <input type="text" class="form-control" name="category_name" id="catname" placeholder="Category Name" id="category_name" value="{{old('category_name')}}">
                </div>

                <div class="form-group">
                    <label for="category_image">Category Url</label>
                    <input type="text" name="category_slug" id="category_slug" class="form-control"  placeholder="Category Url" required="" value="{{old('category_slug')}}">
                </div>

                <div class="form-group">
                    <label for="catid">Parent Category</label>
                    <select name="parent_id" id="parent_id" class="form-control"  required="">
                    @foreach ($category as $row)
                        <option value="{{$row->id}}" {{(old('parent_id') == $row->id ? 'selected' : '')}}>{{$row->category_name}}</option>
                    @endforeach
                </select>
                </div>

                <div class="form-group">
                    <label for="category_title">Category Title</label>
                    <textarea type="text" name="category_title" id="category_title" class="form-control"  placeholder="Category Title" required="">{{old('category_title')}}</textarea>
                </div>

                <div class="form-group">
                    <label for="category_title">Category Keyword</label>
                    <textarea type="text" name="category_keyword" id="category_keyword" class="form-control"  placeholder="Category Keyword" required="">{{old('category_keyword')}}</textarea>
                </div>

                <div class="form-group">
                    <label for="category_title">Category Description</label>
                    <textarea type="text" name="category_description" id="category_description" class="form-control"  placeholder="Category Description" required="">{{old('category_description')}}</textarea>
                </div>

                <div class="form-group">
                    <label for="catname">Status</label>
                    <select  class="form-control" name="status" id="status">
                        <option value="">--Select Status</option>
                        <option value="1" {{(old('status') == '1' ? 'selected' : '')}}>Active</option>
                        <option value="0" {{(old('status') == '0' ? 'selected' : '')}}>Deactive</option>
                    </select>   
                </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-info pd-x-20">Submit</button>
              <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
            </div>
            </form>
          </div>
        </div><!-- modal-dialog -->
      </div><!-- modal -->



@endsection
