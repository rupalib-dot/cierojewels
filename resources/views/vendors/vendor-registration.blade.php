@extends('layouts.app')

@section('content')

                <!--------------- Log-in & Register Form --------------->

<!--------------- Log-in Form --------------->
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_styles.css')}}"> --}}

    <div class="contact_form">
        <div class="container">
            <div class="row">
                 <div class="col-lg-5 offset-lg-3" style="border: 1px solid grey; padding: 20px;">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center">Seller Sign Up</div>

                        <form action="{{route('submit-vendor-registration')}}" id="seller_registration_form" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Full Name </label>
                                <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Full Name " name="name"  value="{{old('name')}}">
                                @if($errors->has('name'))
                                  <span class="text-danger">{{$errors->first('name')}}</span>
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone </label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  aria-describedby="emailHelp" placeholder="Phone ">
                                @if($errors->has('phone'))
                                  <span class="text-danger">{{$errors->first('phone')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email </label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  aria-describedby="emailHelp" placeholder="Email " >

                                @if($errors->has('email'))
                                  <span class="text-danger">{{$errors->first('email')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control"  aria-describedby="emailHelp" placeholder="Password" name="password" >

                                @if($errors->has('password'))
                                  <span class="text-danger">{{$errors->first('password')}}</span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirm Password</label>
                                <input type="password" class="form-control"  aria-describedby="emailHelp" placeholder="Re-type Password" name="password_confirmation" >
                            </div>
                            <div class="contact_form_button">
                                <button type="submit" class="btn btn-info">SignUp</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="panel"></div>
    </div>

@endsection
