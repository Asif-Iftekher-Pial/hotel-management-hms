@extends('frontend.master.master')
@section('front_main')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Our Rooms</h2>
                        <div class="bt-option">
                            <a href="{{ route('front.home') }}">Home</a>
                            <span>Rooms</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->
    <!-- Button trigger modal -->
    @if (Auth::guard('customer')->user())
        <!-- Modal -->
        <div class="modal fade bookingModal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="room-booking">
                            <h3>Your Reservation</h3>
                            <form id="reservationForm" method="POST">
                                <ul id="validation_error">

                                </ul>
                                @csrf
                                <input type="hidden" id="room_id" name="room_id" value="{{ $getRoom->id }}">
                                <input type="hidden" id="customer_id" name="customer_id"
                                    value="{{ Auth::guard('customer')->user()->id }}">

                                <div class="check-date">
                                    <label for="date-in">Check In:</label>
                                    <input type="date" id="date-in" name="checkin">
                                    <i class="icon_calendar"></i>
                                </div>
                                <div class="check-date">
                                    <label for="date-out">Check Out:</label>
                                    <input type="date" id="date-out" name="checkout">
                                    <i class="icon_calendar"></i>
                                </div>
                                <div class="select-option">
                                    <label for="guest">Adults:</label>
                                    <select id="guest" name="total_adults">
                                        <option value="1">1 Adults</option>
                                        <option value="2">2 Adults</option>
                                        <option value="3">3 Adults</option>
                                        <option value="4">4 Adults</option>
                                        <option value="5">5 Adults</option>
                                    </select>
                                </div>
                                <div class="select-option">
                                    <label for="room">Children:</label>
                                    <select id="room" name="total_children">
                                        <option value="1">1 Child</option>
                                        <option value="2">2 Child</option>
                                        <option value="3">3 Child</option>
                                        <option value="4">4 Child</option>
                                        <option value="5">5 Child</option>
                                    </select>
                                </div>
                                <button type="submit" id="bookButton">Book Room</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Room Details Section Begin -->
    <section class="room-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="room-details-item">
                        <img src="{{ asset('assets/img/room/' . $getRoom->photo) }}" alt="">
                        <div class="rd-text">
                            <div class="rd-title">
                                <h3> {{ substr_replace($getRoom->title, '...', 15) }}</h3>
                                <div class="rdt-right">
                                    {{-- <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div> --}}
                                    @if (Auth::guard('customer')->user())
                                        {{-- <a href="{{ $getRoom->id }}">Booking Now</a> --}}
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Booking
                                        </a>
                                    @else
                                        <h5>Need Reservation? <a href="{{ route('front.login') }}">Click here..</a></h5>
                                    @endif
                                </div>
                            </div>
                            <h2>{{ $getRoom->price }}$<span>/Pernight</span></h2>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Category:</td>
                                        <td>{{ substr_replace($getRoom->roomType->title, '...', 20) }} ft</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>{{ $getRoom->size }} ft</td>
                                    </tr>

                                    <tr>
                                        <td class="r-o">Services:</td>
                                        <td>{{ substr_replace($getRoom->service->service_title, '...', 20) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="f-para">{{ $getRoom->service->service_detail }}
                            </p>

                        </div>
                    </div>
                    <div class="rd-reviews">
                        <h4>Reviews</h4>
                        @foreach ($reviews as $review)
                            @php
                                
                            @endphp
                            <div class="review-item">
                                <div class="ri-pic">
                                    <img src="{{ asset('assets/img/customer/' . $review->customer->photo) }}" alt="">
                                </div>
                                <div class="ri-text">
                                    <span>{{ \Carbon\Carbon::parse($review->created_at)->format('D M Y') }}</span>
                                    <div class="rating">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($review->star > $i)
                                                <i class="icon_star"></i>
                                                {{-- <i class="icon_star"></i>pial --}}
                                            @endif
                                        @endfor
                                    </div>
                                    <h5>{{ $review->customer->full_name }}</h5>
                                    <p>{{ $review->customer_review }}</p>
                                </div>
                            </div>
                        @endforeach


                    </div>

                    @if (Auth::guard('customer')->user())
                        <div class="review-add">
                            <h4>Add Review</h4>
                            <form id="reviewForm" class="ra-form" method="POST">
                                @csrf
                                <div class="row">
                                    <input type="hidden" id="this_room_id" name="room_id" value="{{ $getRoom->id }}">
                                    <input type="hidden" id="this_customer_id" name="customer_id"
                                        value="{{ Auth::guard('customer')->user()->id }}">
                                    <div class="col-lg-12">
                                        <div>
                                            <h5>You Rating:</h5>
                                            <div class="rating d-flex">
                                                <i class="icon_star"></i>
                                                <div style="width: 50px;">
                                                    <input type="radio" class="small-size" name="star"
                                                        value="1" style="height:20px" id="" checked>
                                                </div>
                                                <i class="icon_star"></i>
                                                <div style="width: 50px;">
                                                    <input type="radio" class="small-size" name="star"
                                                        value="2" style="height:20px" id="">
                                                </div>
                                                <i class="icon_star"></i>
                                                <div style="width: 50px;">
                                                    <input type="radio" class="small-size" name="star"
                                                        value="3" style="height:20px" id="">
                                                </div>
                                                <i class="icon_star"></i>
                                                <div style="width: 50px;">
                                                    <input type="radio" class="small-size" name="star"
                                                        value="4" style="height:20px" id="">
                                                </div>
                                                <i class="icon_star"></i>
                                                <div style="width: 50px;">
                                                    <input type="radio" class="small-size" name="star"
                                                        value="5" style="height:20px" id="">
                                                </div>
                                            </div>
                                        </div>
                                        <textarea placeholder="Your Review" name="customer_review"></textarea>
                                        <button type="submit" id="submitButton">Submit Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <p>What to add your review? <a class="customColor h5" style="background-color: #0000003b;"
                                href="{{ route('front.login') }}">Click here..</a></p>
                    @endif







                </div>
                <div class="col-lg-4">
                    <div class="room-booking">
                        <h3>Your Reservation</h3>
                        <form id="chkReservation" method="POST">
                            @csrf
                            <div class="check-date">
                                <label for="date-in">Check In:</label>
                                <input type="date" class="date" name="checkin" id="date-in">
                                <i class="icon_calendar"></i>
                            </div>
                            <input type="hidden" name="room_id" id="room_id" value="{{ $getRoom->id }}">
                            <div class="check-date">
                                <label for="date-out">Check Out:</label>
                                <input type="date" class="date" name="checkout" id="date-out">
                                <i class="icon_calendar"></i>
                            </div>
                            <button type="submit">Check Availability</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Room Details Section End -->
@endsection
@section('frontEnd_Script')
    <script>
        $(document).ready(function() {


            // Room Booking
            $(document).on('submit', '#reservationForm', function(e) {
                e.preventDefault();
                var room_id = $('#room_id').val();
                var customer_id = $('#customer_id').val();
               
                $('#bookButton').html(
                    '<span class="fa fa-spinner fa-spin" style="font-size: 25px;"></span>')
                // alert(customer_id);
                $.ajax({
                    type: "post",
                    url: "{{ route('customer-booking.store') }}",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(response) {
                        //  console.log(response);
                        if (response.status == 200) {
                            $('.bookingModal').modal('hide');
                            Swal.fire(
                                'Congratulation!',
                                response.message,
                                'success'
                            )
                            $('#ajaxRender').html(response.headerRender);
                            $('#bookButton').text('Book Room')

                        } else if (response.status == 400) {
                            Swal.fire(
                                'Oops!',
                                response.message,
                                'error'
                            )
                            $('#bookButton').text('Book Room')
                        } else {
                            
                            Swal.fire({
                                title: '<strong>Information Required!</strong>',
                                icon: 'warning',
                                html: $.each(response.error, function (key, error_value) { 
                                    
                                    '<br>'+error_value
                            }),
                                showCloseButton: true,
                                showCancelButton: true,
                                focusConfirm: false,
                                
                            })
                            $('#bookButton').text('Book Room')
                        }

                    }
                });

            });

            // room availability check
            $('#chkReservation').on('submit', function(e) {
                e.preventDefault();
                var id = $('#room_id').val();
                //  alert(id)
                $.ajax({
                    type: "post",
                    url: "{{ route('checkAvailability') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 200) {
                            Swal.fire(
                                'Congratulation!',
                                response.message,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Oops!',
                                response.message,
                                'error'
                            )
                        }
                    }
                });
            });

            // review submit
            $('#reviewForm').on('submit', function(e) {
                e.preventDefault();
                // console.log('ok');
                $('#submitButton').html(
                    '<span class="fa fa-spinner fa-spin" style="font-size: 25px;"></span>')
                $.ajax({
                    type: "post",
                    url: "{{ route('customer-review.store') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 200) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'success',
                                title: response.msg
                            })
                        }
                        $('#submitButton').text('submit now')
                        $('#reviewForm').trigger("reset"); //this will clear all fields
                        location.reload();
                    }
                });
            });

        });
    </script>
@endsection
