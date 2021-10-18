@if(count($shopbycategory) > 0)
<div class="shop-category-section">
    <div class="row">
      <div class="col-sm-12">
        <h2 class="main-heading text-center">Shop by category</h2>

        <ul>
            @foreach($shopbycategory as  $key => $row)
            <li>
                <div class="category-box clearfix">
                <figure><div class="col-sm-12"><img src="{{asset('public/front/images/shop-category-01.jpg')}}" alt="shop-category-01"></div></figure>
                <h4 class="category-title"><a href="{{url($row->category_slug)}}">{{$row->category_name}} </a></h4>
                </div>
            </li>
            @endforeach
        </ul>

      </div>
    </div>
</div>
@endif