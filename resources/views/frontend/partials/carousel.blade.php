<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="hero-text">
                    <h1>Sona A Luxury Hotel</h1>
                    <p>Here are the best hotel booking sites, including recommendations for international
                        travel and for finding low-priced hotel rooms.</p>
                    <a href="#" class="primary-btn">Discover Now</a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                <div class="booking-form">
                    <h3>Booking Your Hotel</h3>
                    <form action="{{ route('frontavailableRooms') }}" method="get">
                        
                        <div class="check-date ">
                            <label for="date-in">Check In:</label>
                            <input type="date" class="checkinDate" name="checkinDate" >
                            <i class="icon_calendar"></i>
                        </div>
                        <div class="check-date">
                            <label for="date-out">Check Out:</label>
                            <input type="date" name="checkoutDate" id="date-out">
                            <i class="icon_calendar"></i>
                        </div>
                        <button type="submit">Available Room</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="{{ asset('front/img/hero/hero-1.jpg') }}"></div>
        <div class="hs-item set-bg" data-setbg="{{ asset('front/img/hero/hero-2.jpg') }}"></div>
        <div class="hs-item set-bg" data-setbg="{{ asset('front/img/hero/hero-3.jpg') }}"></div>
    </div>
</section>

@section('frontEnd_Script')
<script>
    $(document).ready(function () {
        // $('.checkinDate').on('blur',function (e) { 
        //     e.preventDefault();
        //     var checkinDate =$(this).val();
        //     //   console.log(checkinDate);
        //     var url = "{{ route('frontavailableRooms', ":checkinDate") }}";
        //     url = url.replace(':checkinDate', checkinDate);
        //     // console.log(checkinDate);
        //     $.ajax({
        //         type: "get",
        //         url: url,
        //         dataType: "json",
        //         // beforeSend: function(){
        //         //     $('.room-select').html('<option>---Loading---</option>');
        //         // },
        //         success: function (response) {
        //             // console.log(response);
        //             var html='';
        //             $.each(response.data, function (index, row) { 
        //                  html+='<option value="'+row.id+'">'+row.title+'</option>'
        //             });
        //             $('.room-select').html(html);
        //         }
        //     });
        // });


    });
</script>
    
@endsection