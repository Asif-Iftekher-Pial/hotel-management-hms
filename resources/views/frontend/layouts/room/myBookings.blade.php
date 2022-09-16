@extends('frontend.master.master')
@section('front_main')
    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Hotel News</span>
                        <h2>My Rooms</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($myBooking as $item)
                    <div class="col-lg-4">
                        <div class="blog-item set-bg mb-0" data-setbg="{{ asset('assets/img/room/'.$item->withroom->photo) }}">
                            <div class="bi-text">
                                <span
                                    class="b-tag">{{ App\Models\RoomType::where('id', $item->withroom->room_type_id)->pluck('title')->first() }}</span>
                                <h4><a href="{{ $item->withroom->id }}">{{ $item->withroom->title }}</a></h4>
                                <div class="b-time"><i class="icon_clock_alt"></i>
                                    {{ carbon\Carbon::parse($item->created_at)->format('D-M-Y') }}</div>
                            </div>
                        </div>
                        {{-- <a href="#" class="btn btn-success btn-block">Pay Bill</a> --}}
                        <button class="your-button-class" id="sslczPayBtn" token="if you have any token validation"
                            postdata="your javascript arrays or objects which requires in backend"
                            order="If you already have the transaction generated for current order"
                            endpoint="/pay-via-ajax"> Pay Now
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
