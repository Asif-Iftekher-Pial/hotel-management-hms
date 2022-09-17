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
                            {{-- <input type="hidden" name="room_id" id="room_id" value="{{ $item->room_id }}"> --}}
                            <input type="hidden" name="booking_id" value="{{ $item->id }}">
                        </div>
                        @if ($item->payment_status == 'unpaid')
                        <a href="{{ route('pay_bill',[$item->room_id,$item->id]) }}" class="btn btn-warning btn-block"> Pay Bill</a>
                        @else
                            {{-- <span><i class="fas fa-envelope-open-dollar"></i>Paid</span> --}}
                            <button class="btn  btn-success btn-block"><i class="fa fa-credit-card-alt"></i> Already Paid</button>

                        @endif
                        
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
