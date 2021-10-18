<div class="header-topstrip text-center text-white">
        Free Shipping on orders above Rs. 499/-
</div>

<header>  
    <div class="container">
        <div class="header-top">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="logo">
                            <a href="{{route('frontindex')}}"><img src="{{asset('public/front/images/logo.svg')}}" alt="logo" /></a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="search-header">
                            <input type="text" placeholder="Search for products..." />
                            <button class="btn-search position-absolute"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                 <div class="col-sm-3">
        
                       <div class="top-list-icon">
                         <ul>
                            <li>
                            @if(!Auth::check())
                                <a href="{{route('login')}}"><img src="{{asset('public/front/images/user.svg')}}" alt="" /></a>
                            @else
                            <a   href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('public/front/images/user.svg')}}" alt="" /></a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <a class="dropdown-item" href="{{route('user.profile')}}">Profile</a>
                              <a class="dropdown-item" href="{{route('user.order-list')}}">order List</a>
                              <a class="dropdown-item" href="{{route('user.wishlist')}}">Wishlist</a>
                              <a class="dropdown-item" href="{{route('user.logout')}}">Logout</a>
                            </div>
                            @endif
                            </li>
                            <li>
                                <a href="#"><img src="{{asset('public/front/images/heart.svg')}}" alt="" /><span class="badge badge-warning" id="wishlist-count">0</span></a>
                            </li>
                            <li>
                                <a href="{{route('show.cart')}}"><img src="{{asset('public/front/images/cart.svg')}}" alt="" /><span class="badge badge-warning" id="cart-count"> {{ (Cart::count() > 0 ? Cart::count() : 0) }}</span></a>
                            </li>
                        </ul>
                       </div>
                    </div>
                </div>
        </div>


      <div class="header-bottom" id="myHeader">
 
        <div class="row">
          <div class="col-12">
            <div class="bottom-parent">
              <div class="menu-bar">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
                <div class="collapse navbar-collapse iphonNav nav-top navigation clearfix" id="myNavbar">
                  <div class="menu-top-menu-container">
                    <ul>
            					@php $menus =  App\Model\Admin\Category::with(['subCategory'])->orderBy('category_name','asc')->where(['status'=>'1','category_type' => 'parent_category'])->get();
                      @endphp
                      @forelse($menus as $menu)
                      <li class="top-level-link submenuclick1">
                        <a class="mega-menu" href="{{url($menu->category_slug)}}">{{$menu->category_name}}</a>
                        <div class="sub-menu-block slideToggle1">
                          <div class="row">
                            <div class="col-sm-9">
                              <ul class="sub-menu-lists">
                               @if(isset($menu->subCategory) && count($menu->subCategory) > 0)
                               @foreach($menu->subCategory as  $subcategory)
                                <li class="sub-menu-title">
                                    <h4><a href="{{url($subcategory->category_slug)}}">{{$subcategory->category_name}}</a></h4>
                                    <ul>
                                      @if(isset($subcategory->childCategory) && count($subcategory->childCategory) > 0)
                                      @foreach($subcategory->childCategory as  $childcategory)
                                        <li><a href="{{url($childcategory->category_slug)}}">{{$childcategory->category_name}} </a></li>
                                      @endforeach
                                      @endif
                                    </ul>
                                </li>
                                @endforeach
                                @endif
                              </ul>
                            </div>
  
                            <div class="col-sm-3">
                                <div class="mega-menu-card">
                                    <figure><img src="{{$menu->category_image}}" alt=""></figure>
                                </div>
                            </div>
                          </div>
                          
                        </div>
                      </li>
                      @empty

                      @endforelse
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>

<header>