<footer class="footer">
            <div class="footer-top">
                <div class="container topbox">
                    <div class="row">
                        <div class="box col-xl-3 col-lg-2">
                            <h3 class="text-uppercase footer-cltitle">Jewellery</h3>
                            <ul class="list-inline mb-0 footer-clbox">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Shipping Policy</a></li>
                                <li><a href="#">Return/Exchange Policy</a></li>
                                <li><a href="#">Cancellation Policy</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Blog</a></li>
                            </ul>
                        </div>
                        <div class="box col-xl-3 col-lg-2">
                            <h3 class="text-uppercase footer-cltitle">CUSTOMER SERVICE</h3>
                            <ul class="list-inline mb-0 footer-clbox">
                                <li><a href="#">Login</a></li>
                                <li><a href="#">Register</a></li>
                                <li><a href="{{route('vendor-registration')}}">Seller Registration</a></li>
                                <li><a href="{{route('admin.login')}}">Seller Login</a></li>
                                <li><a href="#">Refer and Earn</a></li>
                                <li><a href="#">Size Guide - Ring</a></li>
                                <li><a href="#">Size Guide - Bangle</a></li>
                            </ul>
                        </div>
                        <div class="box col-xl-2 col-lg-3 focontact">
                            <h3 class="text-uppercase footer-cltitle">CONTACT US</h3>
                            <div class="footer-clbox">
                                <ul class="list-inline">
                                    <li>
                                        <a href="mailto:care@jewellery.com"><i class="far fa-envelope"></i> care@jewellery.com</a>
                                    </li>
                                    <li>
                                        <a href="tel:7793021511"><i class="fas fa-mobile-alt"></i> +91 7793021511</a>
                                    </li>
                                    <li>
                                        <a href="mailto:care@jewellery.com"><i class="far fa-paper-plane"></i> Get In Touch</a>
                                    </li>
                                </ul>
                                <ul class="social list-inline d-flex mb-0">
                                    <li>
                                        <a href="{{env('FacebookLink')}}"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{env('TwitterLink')}}"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{env('InstagramLink')}}"><i class="fab fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{env('Youtube')}}"><i class="fab fa-youtube"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{env('GoogleLocation')}}"><i class="fa fa-map-marker"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5">
                            <section class="fo-offershopping">
                                <h3 class="text-uppercase">Subscribe for Deals & Offers</h3>
                                <form class="subform d-flex">
                                    <input type="text" placeholder="Sign up for email newsletters" />
                                    <input type="submit" value="Join" class="btn-submit" />
                                </form>
                                <h3 class="text-uppercase mt-4">100% Secure Shopping</h3>
                                <ul class="shicon list-inline d-flex mb-0">
                                    <li><img src="{{asset('public/front/images/shopping1.jpg')}}" alt="" /></li>
                                    <li><img src="{{asset('public/front/images/shopping2.jpg')}}" alt="" /></li>
                                    <li><img src="{{asset('public/front/images/shopping3.jpg')}}" alt="" /></li>
                                    <li><img src="{{asset('public/front/images/shopping4.jpg')}}" alt="" /></li>
                                    <li><img src="{{asset('public/front/images/shopping5.jpg')}}" alt="" /></li>
                                </ul>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container footer-bottom">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <p class="mb-0">&copy; Jewellery, All Rights Reserved.</p>
                        </div>
                        <ul class="col-md-6 d-flex justify-content-end list-inline mb-0">
                            <li><a href="#">Disclaimer</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer> 