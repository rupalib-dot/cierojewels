@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Category Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Category List
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
                            <th class="wd-15p">Category Image</th>
                            <th class="wd-15p">Category Url</th>
                            <th class="wd-15p">Status</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->category_name}}</td>
                            <td>@if($row->category_image)<img src="{{asset($row->category_image)}}" width="100" height="100">@else {{"N/A"}} @endif</td>
                            <td><a href="{{url($row->category_slug) }}">{{$row->category_slug}}</a></td>
                            <td>{{($row->status == '1' ? 'Active' : 'Deactive')}}</td>
                            <td>
                                <a href="{{url('edit/category/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{url('delete/category/'.$row->id) }}" class="btn btn-sm btn-danger"
                                    id="delete">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->


        <!-- LARGE MODAL -->
        <div id="modaldemo3" class="modal fade">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content tx-size-sm">
                    <div class="modal-header pd-x-20">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Category Add</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    {{-- form --}}
                    <form action="{{route('store.category')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body pd-20">
                            <div class="form-group">
                                <label for="catname">Category Name</label>
                                <input type="text" class="form-control" name="category_name" id="catname" placeholder="Enter Category Name" required="" value="{{old('category_name')}}">
                            </div>  

                            <div class="form-group">
                                <label for="category_image">Category Image</label>
                                <input type="file" name="category_image" id="category_image" class="form-control" required>
                                @if($errors->has('category_image'))
                                <span class="text-danger">{{$errors->first('category_image')}}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="category_image">Category Url</label>
                                <input type="text" name="category_slug" id="category_slug" class="form-control"  placeholder="Category Url" required="" value="{{old('category_slug')}}">
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
                                <select  class="form-control" name="status" id="status" required="">
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
