@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
    <div class="sl-pagebody">
      <div class="sl-page-title">
    	  <h5>Coupon Update</h5>
    	</div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Coupon Update</h6>
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

        <form action="{{url('update/coupon/'.$coupon->id)}}" method="POST">
            @csrf
            <div class="modal-body pd-20">
                <div class="form-group">
                    <label for="catname">Coupon Code</label>
                    <input type="text" class="form-control" name="coupon" id="catname" value="{{$coupon->coupon}}">
                </div>
                <div class="form-group">
                    <label for="catname1">Coupon Discount</label>
                    <input type="text" class="form-control" name="discount" id="catname1" value="{{$coupon->discount}}">
                </div>

                <div class="form-group">
                    <label>Search Category</label>
                    {{-- <input type="hidden" name="category_id" id="category_id" value="{{$coupon->category}}" disabled=""> --}}
                    <input type="text" name="category" class="form-control" placeholder="Search Category" id="search_category" value="{{$category->category_name}}" disabled="">
                    <ul id="searchResult"></ul>
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

@section('scripts')
<script>
$(document).ready(function(){
    $('#search_category').keyup(function(){
        var searchCat = $(this).val();
        if(searchCat != ''){
            
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('content')
                },
                url:"{{route('get-category-by-serach')}}",
                data:{searchCat:searchCat},
                method:'POST',
                dataType:'json',
                success:function(response){
                    var len = response.length;
                            $("#searchResult").empty();
                            for( var i = 0; i<len; i++){
                                var id = response[i]['id'];
                                var name = response[i]['category_name'];

                                $("#searchResult").append("<li value='"+id+"'>"+name+"</li>");

                            }

                            $("#searchResult li").bind("click",function(){
                                $('#search_category').val($(this).text());
                                $('#category_id').val($(this).attr('value'))
                                $("#searchResult").empty();
                            });
                   
                }
            })
        }
    });


})
</script>
@endsection