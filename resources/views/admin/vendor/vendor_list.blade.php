@extends('admin.admin_layouts')
@section('admin_content')
  <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Seller List</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Seller</h6>
          <br>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-5p"> Name</th>
                  <th class="wd-15p"> Email</th>
                  <th class="wd-10p"> Mobile No</th>
                  <th class="wd-15p">Email Verified </th>
                  <th class="wd-5p">Business Verified</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $row)
                <tr>
                  <td>{{$row->name}}</td>
                  <td>{{$row->email}}</td>
                  <td>{{$row->phone}}</td>
                  <td>{{($row->email_verified_at != null ? $row->email_verified_at : 'NO')}}</td>
                  <td>{{($row->seller_detail_verification == '1' ? 'Verificartion Complete' : 'Verificartion ImComplete')}}</td>
                  <td>
                    <a href="{{ URL::to('edit/seller/'.$row->id) }}"  target="_blank"class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></a>
                    <a href="{{ URL::to('delete/seller/'.$row->id) }}"  target="_blank"class="btn btn-sm btn-danger" title="Delete" id="delete"><i class="fa fa-trash"></i></a>
                    <a href="{{ URL::to('view/business-profile/'.$row->id) }}"  target="_blank"class="btn btn-sm btn-warning" title="View Business Profile"><i class="fa fa-eye"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
      </div><!-- sl-pagebody -->
  </div>



@endsection
