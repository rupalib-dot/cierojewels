@extends('layouts.app')
@section('content')
@php
$trendingproduct = App\Model\Admin\Product::where('trend','1')->limit(15)->get();
$dealoftheday = App\Model\Admin\Product::where('dealoftheday','1')->where('is_approved','1')->limit(15)->get();
$bestseller = App\Model\Admin\Product::where('best_seller','1')->where('is_approved','1')->limit(15)->get();
$whatsnew = App\Model\Admin\Product::where('whats_new','1')->where('is_approved','1')->limit(15)->get();
$homeslider = App\Model\Admin\BannerSlider::all();
$promotionalslider  = App\Model\Admin\Promotionalslider::all();
$midbanner = App\Model\Admin\Midslide::orderBy('id','desc')->first();
$customer_says = App\Model\Admin\Review::with('Customer')->orderBy('id','desc')->limit(10)->get();
$shopbycategory = App\Model\Admin\ChildCategory::orderBy('id','desc')->where('status', '1')->limit(10)->get();
$recent_view = App\Model\Admin\Product::where('recently_view','1')->where('is_approved','1')->limit(10)->get();
@endphp

@include('home.hero-banner')
<div class="container">
@include('home.trending-product')
@include('home.whats_new')
@include('home.deal_of_the_day')
@include('home.promotional_banner')
@include('home.customer_says')
@include('home.our_feature') 
@include('home.shop_by_category')
@include('home.products_video')
@include('home.recently_viewed')
</div>
@endsection