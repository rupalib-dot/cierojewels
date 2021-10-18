@extends('layouts.app')
@section('content')


    <!-- Cart -->

    <div class="cartpage">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                </ol>
            </nav>
            <h1 id="my-cart-count">My Cart ({{cart::count()}})</h1>
            <div class="row">
                <div class="col-md-8">
                    <div class="cart-table">
                   
                        @foreach($cart as $row)
                        
                        <div class="box d-flex justify-content-between product-box" data-rowid="{{$row->rowId}}" >
                            <div class="leftbar d-flex">
                                <div class="left-imgheading">
                                    <div class="itemimg"><img src="{{asset($row->options['image'])}}" alt="{{$row->options['image']}}"></div>
                                </div>
                                {{-- {{url($row->options['url'])}} --}}
                                <div class="right-text">
                                    <h2 class="mb-0"><a href="{{url($row->options['url'])}}">{{$row->name}}</a></h2>
                                    <p class="textsize productqty">Qty: {{$row->qty}}</p>
                                    <p class="textprice">{{env('currency')}} {{$row->price}}</p>
                                    <div class="bottombar d-flex align-items-center">
                                        <div class="sp-quantity d-flex">
                                            <div class="sp-minus fff"> <a class="ddd cartquant"
                                                    href="javascript:void(0)" ><span >-</span></a>
                                            </div>
                                            <div class="sp-input">
                                                <input type="text" class="quntity-input" min="1" value="{{$row->qty}}" disabled />
                                            </div>
                                            <div class="sp-plus fff"> <a class="ddd cartquant"
                                                    href="javascript:void(0)" ><span>+</span></a>
                                            </div>
                                        </div>
                                        {{-- <a href="#" class="linktxt">Save for later</a> --}}
                                        <a href="javascript:void(0)" class="linktxt remove-cart">Remove</a>
                                    </div>
                                </div>
                            </div>
                            @if(!empty($row->options['coupen_id']) && $row->options['coupen_applied'] == 0)
                            <div class="rightbar">
                                <p>
                                    <span>Coupen Code :</span>
                                    <span class="coupen_id" data-coupen_id="{{$row->options['coupen_id']}}" >{{$row->options['coupen_code']}}</span> &nbsp; 

                                    <a class="btn apply_coupen" style="padding: 5px 12px;"> Apply</a> 
                                </p>
                            </div>
                            @endif
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cart-ordetail">
                        <h3>Price details</h3>
                        <div class="prbox">
                            <p class="d-flex justify-content-between">Total Products  <span id="cart-total-count">{{cart::count()}}</span></p>
                            {{-- <p class="d-flex justify-content-between">Delivery Fee <span>{{env('currency')}} {{Cart::total()}}</span></p> --}}
                        </div>
                        <div class="prbox order-total">
                            <p class="d-flex justify-content-between">Total <span id="cart-subtotal">{{env('currency')}} {{cart::Subtotal()}}</span></p>
                        </div>
                    </div>
                    <a href="{{route('user.checkout')}}" class="btnpro-checkout btn btn-brand">
                        Check Out
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){
    $('.remove-cart').click(function(){
        var $this = $(this);
        var id =  $this.parents('.product-box').data('rowid');
        var url = '{{url('remove/cart')}}'+'/'+id;
        $.ajax({
          headers:{
            'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('content')
          },
          url: url,
          type:'get',
          dataType:'json',
          success:function(data){
            $('#my-cart-count').text('My Cart ('+data.totalproduct+')');
            $('#cart-total-count').text(data.totalproduct);
            $('#cart-subtotal').text(data.cartsubtotal);
            $('#cart-count').text(data.totalproduct);
            $this.parents('.product-box').remove();
            toastr.success(data.message);
          }
        });
    })

    $('.cartquant').click(function(){
        $this = $(this)
        var qty = $this.parents('.sp-quantity').find('.quntity-input').val();
        var rowid =  $this.parents('.product-box').data('rowid');
        var url = '{{route('update.cartitem')}}';
        
        $.ajax({
          headers:{
            'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('content')
          },
          url: url,
          type:'post',
          data:{productid:rowid,qty:qty},
          dataType:'json',
          success:function(data){
            $('#my-cart-count').text('My Cart ('+data.totalproduct+')');
            $('#cart-total-count').text(data.totalproduct);
            $('#cart-subtotal').text(data.cartsubtotal);
            $('#cart-count').text(data.totalproduct);
            $this.parents('.product-box').find('.productqty').text('Qty: '+qty);
            toastr.success(data.message);
          }
        });
    })

    $('.apply_coupen').click(function(e){
        $this = $(this);
        e.preventDefault();
        var coupen_id = $this.siblings('.coupen_id').data('coupen_id');
        var id = $this.parents('.product-box').data('rowid');
        $.ajax({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('content')
            },
            url:"{{route('apply-coupen')}}",
            type:'post',
            data:{coupen_id:coupen_id,row_id:id},
            dataType:'json',
            success:function(response){
                $this.parents('.product-box').find('.textprice').text('₹ '+response.discounted_price);
                
                $('#cart-subtotal').text('₹ '+response.cart_subtotal);
            },
        })


    })

})


</script>
@endsection
