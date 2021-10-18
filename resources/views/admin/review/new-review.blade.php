@extends('admin.admin_layouts')
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
    <div class="sl-pagebody">
      <div class="sl-page-title">
    	  <h5>New Review Table</h5>
    	</div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
        

        <div class="table-wrapper">
            
          @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            
          <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">User Name</th>
                <th class="wd-15p">Product Name</th>
                <th class="wd-15p">Product Image</th>
                <th class="wd-15p">Comment</th>
                <th>Rating</th>
                <th class="wd-20p">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $index => $row)
            <tr>
            <td>{{++ $index }}</td>
            <td>{{(isset($row->Customer) ? $row->Customer->name : 'N/A') }}</td>
            <td>{{(isset($row->Product) ? $row->Product->product_name : 'N/A') }}</td>
            <td>
                @if(isset($row->Product))
                <img src="{{URL::to($row->Product->image_one)}}" height="40px" width="50px">
                @else
                'N/A'
                @endif
            </td>

            <td>{{$row->review}}</td>
            <td>{{$row->rating}}</td>   
            <td>   

                <a  href="{{route('comment.update',$row->id) }}" class="btn btn-sm btn-info">Approve</a>
                <a href="{{route('comment.delete',$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
            </td>
            </tr>
            @endforeach
        </tbody>
        </table>
        </div><!-- table-wrapper -->
        </div><!-- card -->
    </div>
</div>
@endsection
