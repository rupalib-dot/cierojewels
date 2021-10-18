@if(count($dealoftheday) > 0)
<div class="trending-products">
    <h2 class="main-heading text-center">Deals Of The Day</h2>
    <div class="projects-slide">
        <div class="projects-slider">
            @foreach($dealoftheday as  $row)
            <div class="products-item">
                <a href="{{url($row->product_slug)}}" target="_blank">
                <figure>
                    <div class="col-sm-12"><img src="{{$row->image_one}}" alt="Product Image" /></div>
                </figure>
                <div class="products-info">
                    <h4 class="products-title text-truncate">{{$row->product_name}} </h4>
                    <div class="price">{{env('currency')}} {{$row->selling_price}} {{-- <span>$49.99</span> --}}</div>
                </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif