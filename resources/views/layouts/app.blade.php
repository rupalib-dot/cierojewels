@php
    $setting=DB::table('sitesetting')->first();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token"  content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Ciero Artificial Jewelry: 100% Made in India - Shop for Imitation Jewellery and fashion jewelry at India &amp; Company. Choose a fashionable look from our collection, including traditional jewellery, pearls, meenakari, kundan jewellery, CZ diamond and more at amazing prices now!">
    <meta name="keywords" content="Imitation Jewellery, Artificial Jewellery, artificial jewellery online, Indian Fashion Jewellery, Imitation Jewellery online, women's fashion jewelry, artificial earrings online, jewellery artificial online, imitation jewellery online india, artificial jewellery online india, cheap jewellery online, indian artificial jewellery online, buy jewelry online, jewellery for women, latest jewellery 2021, jewellery online">
    <link rel="icon" href="{{asset('public/assets/front/images/favicon.png')}}" type="images/png" sizes="16x16">
    <title>Artificial Jewellery | Imitation Jewellery Online | Indian Fashion Jewelry{{-- {{config('app.name |  Laravel')}} --}}</title>

    <link rel="shortcut icon" href="images/favicon.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" />
    
    <link href="{{asset('public/front/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/front/css/font-awesome.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('public/front/css/owl.carousel.min.css')}} "/>
    <link rel="stylesheet" href="{{asset('public/backend/css/toastr.min.css')}}">
    <link href="{{asset('public/front/css/main.css')}}" rel="stylesheet" />
    <link href="{{asset('public/front/css/menu.css')}}" rel="stylesheet" />
    @yield('links')
    <style>
        .products-item figure img{
            width: 100%;
        }
        .slick-slide img {
            display: block;
            object-fit: contain;
            width: 100%;
            height: 239px;
        }
    </style>
</head>
<body>
    @include('layouts.front.header')
    @yield('content')
    @include('layouts.front.footer')
    
    <script src="{{asset('public/front/js/jquery-3.5.1.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="{{asset('public/front/js/slick.min.js')}}"></script>
    <script src="{{asset('public/front/js/webslidemenu.js')}}"></script>
    <script src="{{asset('public/front/js/main.js')}}"></script>
    <script src="{{asset('public/front/js/owl.carousel.js')}}"></script>
    <script src="{{asset('public/backend/js/toastr.min.js')}}"></script>
    @yield('scripts')
</body>
</html>