@extends('layouts.app')
@section('content')
<div class="product-detail">
        <div class="container">
            @include('common.breadcumb')

            <div class="detail-top row">
                <div class="left-part col-md-6 col-xl-5">
                    <div class="position-relative probox-outer">
                        <ul class="slider thumbbx slider-nav list-inline py-0">
                            <li><img src="{{asset($product->image_one)}}" alt=""></li>
                            <li><img src="{{asset($product->image_two)}}" alt=""></li>
                            <li><img src="{{asset($product->image_three)}}" alt=""></li>
                        </ul>
                        <ul class="slider slider-for list-inline">
                                    <li><img src="{{asset($product->image_one)}}" class="demo-img pos-center img-zoom1"></li>
                                    <li><img src="{{asset($product->image_two)}}" class="demo-img pos-center img-zoom2"></li>
                                    <li><img src="{{asset($product->image_three)}}" class="demo-img pos-center img-zoom3"></li>
                                
                            {{-- <li><img src="{{asset($product->image_two)}}" ></li>
                            <li><img src="{{asset($product->image_three)}}"></li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-xl-6 right-part">
                    <h1 class="position-relative">{{$product->product_name}}
                        <small class="procode d-block">Product SKU: {{$product->product_sku}}</small>
                        <a href="javascript:void(0)" class="detail-like position-absolute"><img src="{{asset('public/front/images/heart.svg')}}"
                                alt=""></a>
                    </h1>
                    <h2 class="proprice">{{env('currency')}}{{$product->selling_price}}/-</h2>
                    <h5 class="proprice mr01">MRP {{env('currency')}}{{$product->mrp}} <span>({{$product->discount}}% off)</span></h5>
                    <div class="selqty d-flex align-items-center">
                        <span class="mr-2">Select Quantity:</span>
                        <div class="sp-quantity d-flex">
                            <div class="sp-minus fff"> <a class="ddd" href="javascript:void(0)"><span>-</span></a>
                            </div>
                            <div class="sp-input">
                                <input type="text" class="quntity-input" value="1" disabled />
                            </div>
                            <div class="sp-plus fff"> <a class="ddd" href="javascript:void(0)"><span>+</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="buybtns justify-content-between mt-4">
                        <a href="javascript:void(0)" class="text-uppercase addcart-btn" data-productid="{{$product->id}}">Add to Cart</a>
                        <a href="javascript:void(0)" class="text-uppercase buy-btn btn-brand" >Buy Now</a>
                    </div>
                    <div class="check-delivery mt-4">
                        <strong><i class="fas fa-map-marker-alt"></i> Check delivery in your area</strong>
                        <form class="position-relative">
                            <input type="text" placeholder="Enter Pincode">
                            <input type="submit" value="Check" class="btn position-absolute">
                        </form>
                    </div>
                    <div id="accordion" class="mt-4">
                        <div class="card">
                            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                Product Detail
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <ul class="list-inline">
                                        <li><strong>Sales Package</strong> {{$product->sales_package}}</li>
                                        <li><strong>Product SKU</strong> {{$product->product_sku}}</li>
                                        <li><strong>Gross Weight</strong> {{$product->gross_weight}} GMS</li>
                                        <li><strong>Material</strong> {{$product->material}}</li>
                                        <li><strong>Colors</strong> {{implode(', ',$product_color)}}</li>
                                        <li><strong>Sizes</strong> {{implode(', ',$product_size)}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo"
                                aria-controls="collapseTwo">
                                Product Description
                            </div>

                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordion">
                                <div class="card-body">
                                    {!!$product->product_details!!}
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree"
                                aria-controls="collapseThree">
                                Returns and Exchange
                            </div>

                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <p class="mb-2"><strong>15 days free Return & Exchange</strong></p>
                                    <p class="mb-0">If you are not 100% satisfied with your purchase we will gladly
                                        accept return of the products within 15 days from the date of delivery and will
                                        issue a refund of amount paid for the products. You can also exchange the
                                        product if you get it in different size or damaged in transit.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php  $similarproduct = App\Model\Admin\Product::where('childcategory_id',$product->childcategory_id)->where('id','!=',$product->id)->limit(20)->get(); @endphp
            @if(count($similarproduct) > 0)

            <div class="hm-bestseller mt-5">
                <h2 class="main-heading text-center">Similar Products</h2>
                <div class="multiple-items">
                	@foreach($similarproduct as $row)
                    <div class="box">
                        <div class="boxinner">
                            <a href="{{$row->product_slug}}">
                                <img src="{{$product->image_one}}" alt="">
                                <article>
                                    <p class="text-truncate">{{$row->product_name}} ({{$row->product_sku}})</p>
                                    <span>{{env('currency')}}. {{$product->selling_price}}</span>
                                </article>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
             @endif
        </div>
</div>
@endsection

@section('scripts')

<script src="{{asset('public/frontend/js/blowup.js')}}"></script>
<script src="{{asset('public/frontend/js/prism.js')}}"></script>

<script>
$(document).ready(function(){

    $('.addcart-btn').click(function(){
        var productid = $(this).data('productid');
        if(productid != ''){
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('content')
                },
                url:'{{route('insert.into.cart')}}',
                data:{productid:productid},
                method:'post',
                dataType:'json',
                success:function(response){
                    if(response.type == 'success'){

                        $('#cart-count').text(response.cartcount);
                        toastr.success(response.message);

                    }
                }

            })
        }

    })

   
    $(".img-zoom1").blowup({
        background : "#FCEBB6",
        scale:2,
        width : 250,
        height : 250
    });
    $(".img-zoom2").blowup({
        background : "#FCEBB6",
        scale:2,
        width : 250,
        height : 250
    });
    $(".img-zoom3").blowup({
        background : "#FCEBB6",
        scale:2,
        width : 250,
        height : 250
    });

    /*$('.my-zoom-1').WMZoom();*/
});

</script>
@endsection

