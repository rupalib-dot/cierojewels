@extends('layouts.app')
@section('content')
<div class="product-category">
        <div class="container">
            @include('common.breadcumb')
            <section class="cateouter">
                <div class="row">
                    @include('common.filter')
                    <div class="col-lg-9 col-md-8" >
                        @include('common.product_top_header')
                        <div class="hm-bestseller" id="product-view">
                            @foreach($data as $row)
                            <div class="col-sm-4">
                              <div class="box">
                                  <div class="boxinner">  
                                      <a href="{{url($row->product_slug)}}">
                                          <img src="{{asset($row->image_one)}}" alt="">
                                          <article>
                                              <div class="title d-flex align-items-center">
                                                  <p class="text-truncate">{{$row->product_name}} ({{$row->product_code}})
                                                  </p>
                                                  <span class="prolike"><img src="{{asset('public/front/images/heart.svg')}}" alt=""></span>
                                              </div>
                                              <span>{{env('currency')}} {{$row->selling_price}}</span>
                                          </article>
                                      </a>
                                  </div>
                              </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
     
@endsection

@section('scripts')
<script>
   
$(document).ready(function(){
  var checkedcategory = [];
  $('body').on('change','#sortby',function(){ 

     if($(this).val() == ''){
      return;
     }else{
       url = '/sortby';
        $.ajax({
          headers:{
            'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('content')
          },
          url: url,
          type:'post',
          data:{'category_id':$('input[name="category_id"]').val(),'category_type':$('input[name="category_type"]').val(),'sortby':$(this).val()},
          success:function(data){
            $('#product-view').html('');
            $('#product-view').html(data);
          }
        });
     }
  });


  $('body').on('click','.filtercategory',function(){
    var filtercategory = $('input[type="checkbox"][name="filtercategory\\[\\]"]:checked').map(function() { return this.value; }).get();

    url ="{{url('/sortbycategory/')}}";
    $.ajax({
      headers:{
        'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('content')
      },
      url: url,
      type:'post',
      data:{category:filtercategory},
      success:function(data){
        $('#product-view').html('');
        $('#product-view').html(data);
      }

     });
  });

  $('body').on('click','.filterprice',function(){
    var filterprice =  $(this).val();
    url = '/sortbyprice';
    $.ajax({
      headers:{
        'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('content')
      },
      url: url,
      type:'post',
      data:{price:filterprice},
      success:function(data){
        $('#product-view').html('');
        $('#product-view').html(data);
      }

     });
  });
})
</script>
@endsection
