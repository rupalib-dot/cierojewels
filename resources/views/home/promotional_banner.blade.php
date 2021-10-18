@if(count($promotionalslider) > 0)
<div class="store-slider">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @forelse($promotionalslider as $key => $value)
            <div class="carousel-item {{($key == 0 ? 'active' : '')}}">
                <img class="d-block w-100" src="{{asset($value->image)}}" alt="First slide" />
            </div>
            @empty

            @endforelse
            
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><img src="{{asset('public/front/images/left-arrow.png')}}" alt="left-arrow" /></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><img src="{{asset('public/front/images/right-arrow.png')}}" alt="left-arrow" /></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
@endif