@if(count($recent_view) > 0)
<div class="recently-section">
    <h2 class="main-heading text-center">recently viewed </h2>

    <div class="recently-list">
        <ul>
          @foreach($recent_view as $row)
            <li>
                <div class="recently-box">
                    <figure><div class="col-sm-12"><img src="{{$row->image_one}}" alt="" /></div></figure>
                   <div class="recently-info">
                
                    <h4 class="recently-title text-truncate"><a href="{{$row->product_slug}}" tabindex="0">{{$row->product_name}}</a></h4>
                    {{-- <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div> --}}
                    <div class="price"><strong>{{env('currency')}} {{$row->selling_price}}</strong>{{-- <span>$49.99</span> 50%off --}}</div>
                   </div>
                </div>
            </li>
          @endforeach
        </ul>

        <div class="recently-btn">
           <button> View All</button>
        </div>
    </div>

</div>

@endif