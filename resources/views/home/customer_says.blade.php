{{-- @if(count($customer_says) > 0)
<section class="tester_new text-center">
  <h2 class="main-heading text-center">Customer Says</h2>
  <div class="container">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        @foreach($customer_says as $key  => $value)
        @if()
        <div class="carousel-item  {{(isset($key) == 0 ? 'active' : '')}}">
            <div class="row">
                <div class="col-lg-6">
                    <div class="imgname">
                        <img src="images/testimonials1.png" alt="" class="d-block mx-auto" />
                        {{(isset($value->Customer) ? $value->Customer->name : '')}}
                    </div>
                    <blockquote class="position-relative">
                        {{$value->review}}
                    </blockquote>
                    <span class="proname">

                        @for($i = 0; $i > $value->rating ; $i > 0)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        @endfor
                    </span>
                </div>

                <div class="col-lg-6">
                    <div class="imgname">
                        <img src="images/testimonials1.png" alt="" class="d-block mx-auto" />
                        Divya Menon
                    </div>
                    <blockquote class="position-relative">
                        I buy my daughters birthday gift every year at bluestone.. and my daughter really loves it.. I really appreciate the products delivered as before the said date and even the quality of the product..
                    </blockquote>
                    <span class="proname">The Brave Ladybird Pendant For Kids</span>
                </div>
            
            </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

@endif --}}