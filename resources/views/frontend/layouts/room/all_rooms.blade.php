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

<!-- Rooms Section Begin -->
<section class="rooms-section spad">
    <div class="container">
        <div class="row" id="allRooms">
            @include('frontend.layouts.includes.allRoomInclude')
        </div>
        <div class="col-lg-12 loaderGif" style="display: none">
            <div class="text-center">
                <img src="{{ asset('front/Ajax_loader/loader.gif') }}" style="max-width: 11%; " alt=""
                    srcset="">
            </div>
        </div>
    </div>
</section>
<!-- Rooms Section End -->

    
@endsection

@section('frontEnd_Script')
<script>
    $(document).ready(function() {
        // alert('ok');
        function loadMoreData(page) {
            $.ajax({
                type: "get",
                url: '?page=' + page,
                beforeSend: function() {
                    $('.loaderGif').show()
                }
            })
            .done(function(response) {
                if (response.allRoomView == '') {
                    $('.loaderGif').html('<h3 class="text-center text-danger">No more room found!</h3>');
                    return;
                }else{
                    // console.log(response);
                    $('.loaderGif').hide();
                    $('#allRooms').append(response.allRoomView)
                }
            })
            .fail(function() {
                console.log('Something went wrong!Please try again');
            });
        }


        var page = 1;
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() + 120 >= $(document).height()) {
                page++;
                loadMoreData(page)
            }
        });

    });
</script>
    
@endsection