@extends('frontend.master.master')

@section('front_main')
    <!-- Hero Section Begin -->
    @include('frontend.partials.carousel')
    <!-- Hero Section End -->

    <!-- About Us Section Begin -->
    <section class="aboutus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <div class="section-title">
                            <span>About Us</span>
                            <h2>Intercontinental LA <br />Westlake Hotel</h2>
                        </div>
                        <p class="f-para">Sona.com is a leading online accommodation site. We’re passionate about
                            travel. Every day, we inspire and reach millions of travelers across 90 local websites in 41
                            languages.</p>
                        <p class="s-para">So when it comes to booking the perfect hotel, vacation rental, resort,
                            apartment, guest house, or tree house, we’ve got you covered.</p>
                        <a href="#" class="primary-btn about-btn">Read More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-pic">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="{{ asset('front/img/about/about-1.jpg') }}" alt="">
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ asset('front/img/about/about-2.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section End -->
    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Room Types</span>
                        <h2>Check Out</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($roomType as $data)
                    <div class="col-lg-4">

                        <div class="blog-item set-bg" data-setbg="{{ asset('assets/img/roomTypeImages/' . $test) }}">
                            {{-- <div>
                        <img style="max-width: 50%" src="{{ asset('front/img/blog/blog-2.jpg') }}" alt="">

                        </div> --}}
                            <div class="bi-text">
                                <span class="b-tag">$ {{ $data->price }}</span>
                                <h4><a href="{{ $data->id }}">{{ $data->title }}</a></h4>
                                <div class="b-time"><i class="icon_clock_alt"></i> {!! html_entity_decode(substr_replace($data->detail, '...', 20)) !!}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    <!-- Services Section End -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What We Do</span>
                        <h2>Discover Our Services</h2>
                        <i class="flaticon-036-parking"></i>
                        <i class="flaticon-033-dinner"></i>
                        <i class="flaticon-012-cocktail"></i>
                        <i class="flaticon-044-clock-1"></i>
                        <i class="flaticon-026-bed"></i>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($getService as $value)
                    <div class="col-lg-4 col-sm-6">
                        <div class="service-item">

                            <i class="flaticon-024-towel"></i>
                            <i class="flaticon-012-cocktail"></i>
                            <h4>{{ $value->service_title }}</h4>
                            <p>{!! html_entity_decode(substr_replace($value->service_detail, '...', 20)) !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Home Room Section Begin -->
    <section class="hp-room-section">
        <div class="container-fluid">
            <div class="hp-room-items">
                <div class="row">
                    @foreach ($getRooms as $room)
                        <div class="col-lg-3 col-md-6">
                            <div class="hp-room-item set-bg" data-setbg="{{ asset('assets/img/room/' . $room->photo) }}">
                                <div class="hr-text">
                                    <h3>{!! html_entity_decode(substr_replace($room->title, '...', 15)) !!}</h3>
                                    <h2>{{ $room->price }}$<span>/Pernight</span></h2>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="r-o">Size:</td>
                                                <td>{{ $room->size }} ft</td>
                                            </tr>
                                            <tr>
                                                <td class="r-o">Services:</td>
                                                <td>{!! html_entity_decode(substr_replace($room->service->service_detail, '...', 15)) !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href=" {{ route('front.room_detail', $room->id) }} " class="primary-btn">More
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Home Room Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Testimonials</span>
                        <h2>What Customers Say?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="testimonial-slider owl-carousel">
                        @foreach ($testimonials as $testimonial)
                            <div class="ts-item">
                                <p>{{ $testimonial->customer_review }}</p>
                                <div class="ti-author">
                                    <div class="rating">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($testimonial->star > $i)
                                                <i class="icon_star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <h5> - {{ $testimonial->customer->full_name }}</h5>
                                </div>
                                <img src="{{ asset('front/img/testimonial-logo.png') }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Hotel News</span>
                        <h2>Our Blog & Event</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="{{ asset('front/img/blog/blog-1.jpg') }}">
                        <div class="bi-text">
                            <span class="b-tag">Travel Trip</span>
                            <h4><a href="#">Tremblant In Canada</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 15th April, 2019</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="{{ asset('front/img/blog/blog-2.jpg') }}">
                        <div class="bi-text">
                            <span class="b-tag">Camping</span>
                            <h4><a href="#">Choosing A Static Caravan</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 15th April, 2019</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="{{ asset('front/img/blog/blog-3.jpg') }}">
                        <div class="bi-text">
                            <span class="b-tag">Event</span>
                            <h4><a href="#">Copper Canyon</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 21th April, 2019</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog-item small-size set-bg" data-setbg="{{ asset('front/img/blog/blog-wide.jpg') }}">
                        <div class="bi-text">
                            <span class="b-tag">Event</span>
                            <h4><a href="#">Trip To Iqaluit In Nunavut A Canadian Arctic City</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 08th April, 2019</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item small-size set-bg" data-setbg="{{ asset('front/img/blog/blog-10.jpg') }}">
                        <div class="bi-text">
                            <span class="b-tag">Travel</span>
                            <h4><a href="#">Traveling To Barcelona</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 12th April, 2019</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
