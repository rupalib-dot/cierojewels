@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
    <div class="sl-pagebody">
      <div class="sl-page-title">
    	  <h5>Childcategory Update</h5>
    	</div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Childcategory Update</h6>
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

        <form action="{{url('update/childcategory/'.$data->id)}}" method="POST">
            @csrf
    
            <div class="modal-body pd-20">
                <div class="form-group">
                    <label for="catname">Child Category Name</label>
                    <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter Category Name" value="{{old('category_name',$data->category_name)}}">
                </div>


                <div class="form-group">
                    <label for="catname">Category URL</label>
                    <input type="text" class="form-control" name="category_slug" id="category_slug" placeholder="Enter Category URL" required="" value="{{old('category_slug',$data->category_slug)}}">
                </div>

                <div class="form-group">
                    <label for="catid">Parent Category </label>
                    <select name="parent_id" class="form-control" id="parent_id">
                        <option value="">--Select Category--</option>
                        @foreach ($category as $row)
                            <option value="{{$row->id}}" {{(old('parent_id',$data->parent_id) == $row->id ? 'selected' : '')}}>{{$row->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                

                <div class="form-group">

                    <label for="catname">Sub Category</label>
                    <select  class="form-control" name="subparent_id" id="subparent_id">
                        <option value="">--Select Sub Category</option>
                    </select>
                    
                </div>

                <div class="form-group">
                    <label for="category_title">Category Title</label>
                    <textarea type="text" name="category_title" id="category_title" class="form-control"  placeholder="Category Title" required="">{{old('category_title',$data->category_title)}}</textarea>
                </div>

                <div class="form-group">
                    <label for="category_title">Category Keyword</label>
                    <textarea type="text" name="category_keyword" id="category_keyword" class="form-control"  placeholder="Category Keyword" required="">{{old('category_keyword',$data->category_keyword)}}</textarea>
                </div>

                <div class="form-group">
                    <label for="category_title">Category Description</label>
                    <textarea type="text" name="category_description" id="category_description" class="form-control"  placeholder="Category Description" required="">{{old('category_description',$data->category_description)}}</textarea>
                </div>

                <div class="form-group">
                    <label for="catname">Status</label>
                    <select  class="form-control" name="status" id="status">
                        <option value="">--Select Status</option>
                        <option value="1" {{(old('status',$data->status) == '1' ? 'selected' : '')}}>Active</option>
                        <option value="0" {{(old('status',$data->status) == '0' ? 'selected' : '')}}>Deactive</option>
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


@section('scripts')
<script>

    function getSubCategory(parentCat){
        if(parentCat != ''){
            
            oldSubmenu = '{{old('subparent_id',$data->subparent_id)}}';
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url:"{{route('get-sub-categories')}}",
                data:{'parentCat':parentCat},
                dataType:'json',
                success:function(response) {
                    if(response.status == 'true'){
                        
                        var option = '<option value="">--Select Sub Category</option>';
                         $.each(response.data,function(key,value){
                            
                            if(oldSubmenu == value.id){
                               var select = "selected";
                            }else{
                                var select = '';
                            }

                            
                            option +='<option value="'+value.id+'" '+select+'>'+value.category_name+'</option>'
                         });

                         
                        $('#subparent_id').html('');
                        $('#subparent_id').html(option);
                         
                    }
                }

            })
        }
    }


    $(document).ready(function(){
        $('#parent_id').change(function(){
            var parentCat  = $(this).val();
            var list = getSubCategory(parentCat);   
        })

        if ($('#parent_id').val() != '') {
            var parentCat  = $('#parent_id').val();
            var list = getSubCategory(parentCat); 
        }
    });
</script>
@endsection