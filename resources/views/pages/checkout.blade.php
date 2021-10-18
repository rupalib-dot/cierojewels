@extends('layouts.app')
@section('links')
<style>
.error{
    color: red;
}
</style>
@endsection
@section('content')
<!-- Start Middle Part -->
    <div class="cartpage checkoutpage">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                </ol>
            </nav>
            <h1>Checkout</h1>
            <div class="row">
                <div class="col-md-8">
                    
                    <div class="checkout-outer">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Shipping & Billing Detail
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body shbill-detail d-flex flex-wrap justify-content-between">
                                        <form id="shipping-address-form" method="post" action="{{route('payment.process')}}" style="width: 100%;">
                                            @csrf
                                        <div class="form-group" style="float: left;">
                                            <input type="text" id="name" class="form-control" placeholder="Name" name="name">
                                            @if($errors->has('name'))
                                            <span class="text-danger">{{$errors->first('name')}}</span>
                                            @endif

                                        </div>

                                        <div class="form-group" style="float: left;"> 
                                            <input type="text" class="form-control" name="mobile_no" placeholder="Mobile" name="mobile_no" value="{{old('mobile_no')}}">
                                            @if($errors->has('mobile_no'))
                                            <span class="text-danger">{{$errors->first('mobile_no')}}</span>
                                            @endif
                                        </div>
                                        
                                        <div class="form-group" style="float: left;">
                                            <input type="text" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
                                            @if($errors->has('email'))
                                            <span class="text-danger">{{$errors->first('email')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group" style="float: left;">
                                            <input type="text" class="form-control" placeholder="Pincode" name="pincode" value="{{old('pincode')}}"> 
                                            @if($errors->has('pincode'))
                                            <span class="text-danger">{{$errors->first('pincode')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group" style="float: left;">
                                            <input type="text" class="form-control" placeholder="City" name="city" value="{{old('city')}}">
                                            @if($errors->has('city'))
                                            <span class="text-danger">{{$errors->first('city')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group form-group-address w-100" >
                                            <textarea class="form-control" placeholder="Address" name="address" value="{{old('address')}}"></textarea>
                                            @if($errors->has('address'))
                                            <span class="text-danger">{{$errors->first('address')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group w-100 mt-2">
                                            <button type="submit" id="make-payment" class="btn btn-brand text-uppercase"> Proceed to payment</button> 
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="cart-ordetail">
                        <h3>Price details</h3>
                        <div class="prbox">
                            <p class="d-flex justify-content-between">Price ({{Cart::count()}}) <span>{{env('currency')}} {{Cart::subtotal()}}</span></p>
                            <p class="d-flex justify-content-between">Delivery Fee <span>{{env('currency')}} 0</span></p>
                        </div>
                        <div class="prbox order-total">
                        	@php $delivery_charge = 0;  @endphp
                            <p class="d-flex justify-content-between">Total <span>{{env('currency')}} {{Cart::subtotal() + $delivery_charge}}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Footer -->
@endsection

@section('scripts')
<script src="{{asset('public/front/js/jquery.validate.min.js')}}"></script>
<script>
$(document).ready(function() {
  $("#shipping-address-form").on("submit",
    function(e) {
    e.preventDefault();
    $(this).validate({
        rules: {
            name: {
              required: true
            },
            email: {
              required: true,
              email: true
            },
            
            mobile_no: {
              required: true
            },
            pincode: {
                      required: true
                    },
            city: {
              required: true
            },
            address: {
              required: true
            }
        
        },
        

    });
    
    
  });
})
</script>
@endsection