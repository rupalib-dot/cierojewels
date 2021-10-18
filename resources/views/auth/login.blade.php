@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row" style="margin-top: 50px;">
        <div class="col-lg-6 offset-lg-3">
            <div class="checkout-outer">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Login 
                        </div>

                            <div class="card-body shbill-detail d-flex flex-wrap justify-content-between">
                                <form action="{{route('login')}}" style="width:100%;" method="post"> @csrf
                                    <input type="hidden" name="previous_url" value="{{url()->previous()}}">
                                    <div class="form-group" style="width:100%;">
                                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}" required="">
                                    </div>
                                    @if($errors->has('email'))
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                    @endif
                                    <div class="form-group" style="width:100%;">
                                        <input type="password" class="form-control" placeholder="Password" name="password" required="">
                                    </div>
                                    @if($errors->has('password'))
                                    <span class="text-danger">{{$errors->first('password')}}</span>
                                    @endif

                                    <div class="alreday-account text-center">
                                        <p class="mb-0">Do not have an account with us? <a href="{{route('register')}}">Sign Up</a></p>
                                    </div>
                                    <div class="form-group w-100 mt-2">
                                        <button type="submit" class="btn btn-brand text-uppercase">Log In</button>
                                        
                                    </div>
                                </form>
                            </div>
                    </div>
                   
                </div>
            </div>
        </div> 
    </div>
    
</div>

@endsection
