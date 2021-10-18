@if(!empty($midbanner))
<div class="hm-colstone-jewellery ">
    <a href="{{(!empty($midbanner->link) ? $midbanner->link : 'javascript:void(0)')}}">
        <figure class="position-relative">
            <img src="{{$midbanner->image}}" alt="Mid Banner" />
            <figcaption class="position-absolute d-flex justify-content-center align-items-center flex-column">
                <h2>Special Offers</h2>
                <span class="text-uppercase text-white">Shop Now</span>
            </figcaption>
        </figure>
    </a>
</div>
@endif