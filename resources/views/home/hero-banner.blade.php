@if(count($homeslider) > 0)
<section class="hm-banner">
    <div id="carouselExampleFade" class="carousel slide carousel-fade pointer-event" data-ride="carousel">
        <div class="carousel-inner">
            @forelse($homeslider as $key => $value)

            <div class="carousel-item {{($key == 0 ? 'active' : '')}}">
                <a href="{{(isset($value->banner_url)  ? url($value->banner_url) : 'javascript:void(0)')}}" target="_blank"><img src="{{asset($value->banner_image)}}" alt="Banner Image" /></a> 
            </div>
            @empty

            @endforelse
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><img src="{{asset('public/front/images/left-arrow.png')}}" alt="left-arrow" /></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><img src="{{asset('public/front/images/right-arrow.png')}}" alt="right-arrow" /></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
@endif


