<div class="top-nav">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <ul class="tn-left">
                    <li><i class="fa fa-phone"></i> (12) 345 67890</li>
                    <li><i class="fa fa-envelope"></i> info.colorlib@gmail.com</li>
                </ul>
            </div>
            <div class="col-lg-7">
                <div class="tn-right d-flex">
                    <div class="top-social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-tripadvisor"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </div>
                    <a href="#" class="bk-btn">Reserved({{ App\Models\Booking::where('customer_id',Auth::guard('customer')->user()->id)->count() }})</a>
                    <div class="language-option">
                        @if(Auth::guard('customer')->user())
                            <img src="{{ asset('assets/img/customer/'.Auth::guard('customer')->user()->photo) }}" alt="" style="  width: 36px;
                            height: 37px;}">
                            <span>{{ Auth::guard('customer')->user()->full_name }} <i class="fa fa-angle-down"></i></span>
                            <div class="flag-dropdown">
                                <ul>
                                    <li><a href="#">Profile</a></li>
                                    <li><a href="#">My Rooms({{ App\Models\Booking::where('customer_id',Auth::guard('customer')->user()->id)->count() }})</a></li>
                                    <li><a href="{{ route('front.customerLogout') }}">Logout</a></li>
                                </ul>
                            </div>
                        @else
                            <img src="{{ asset('front/img/flag.jpg') }}" alt="">
                            <a href="{{ route('front.login') }}" class="btn btn-success">Login</a>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>