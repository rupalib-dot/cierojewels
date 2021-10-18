
@if(count($whatsnew) > 0)
<div class="hm-whatsnew">
    <h2 class="main-heading text-center">Whats New</h2>

    <div class="whatsnew-slider">
      @foreach($whatsnew as $index => $row)
            <div class="whatsnew-box">
                <a href="{{$row->product_slug}}" target="_blank">
                    <figure><div class="col-sm-12"><img src="{{$row->image_one}}" alt="" /></div></figure>
                    <figcaption>
                        <h2 class="text-truncate">{{$row->product_name}}</h2>
                        <span class="text-uppercase text-white">Shop Now</span>
                    </figcaption>
                </a>
            </div>  
      @endforeach  
    </div>

    @include('home.mid_bannner')
</div>
@endif