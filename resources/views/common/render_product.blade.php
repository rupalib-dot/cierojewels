                        
                        <div class="hm-bestseller">
                            @foreach($data as $row)
                            <div class="box">
                                <div class="boxinner">
                                    <a href="{{url($row->product_slug)}}">
                                        <img src="{{asset($row->image_one)}}" alt="">
                                        <article>
                                            <div class="title d-flex align-items-center">
                                                <p class="text-truncate">{{$row->product_name}} ({{$row->product_code}})
                                                </p>
                                                <span class="prolike"><img src="{{asset('public/front/images/heart.svg')}}" alt=""></span>
                                            </div>
                                            <span>{{env('currency')}} {{$row->selling_price}}</span>
                                        </article>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>