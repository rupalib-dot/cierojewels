@extends('admin.admin_layouts')
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
    <div class="sl-pagebody">
      <div class="sl-page-title">
    	  <h5>Promotional Slider Table</h5>
    	</div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Promotional Slider List
            <a href="{{route('promotional-slider.create')}}" class="btn btn-sm btn-warning">Add New</a>
        </h6>
        <br>

        <div class="table-wrapper">

          <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Slider Image</th>
                <th class="wd-15p">Slider Link</th>
                <th class="wd-20p">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sliders as $row)
            <tr>
            <td>{{$row->id}}</td>
            <td><img src="{{URL::to($row->image)}}" height="40px" width="50px"></td>
            <td>{{$row->link}}</td>
            <td>
                <a href="{{route('promotional-slider.edit',$row->id) }}" class="btn btn-sm btn-info">Edit</a>
                <a href="{{route('promotional-slider.delete',$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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
