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
        <div class="row">
            @foreach ($GetRoom as  $item)
            <div class="col-lg-4 col-md-6">
                <div class="room-item">
                    <img src="" alt="">
                    <div class="ri-text">
                        <h4>{{ $item->title }}</h4>
                        <h3>{{ $item->price }}$<span>/Pernight</span></h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="r-o">Size:</td>
                                    <td>{{ $item->size }} ft</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Services:</td>
                                    <td>{{ $item->service->service_title }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ $item->id }}" class="primary-btn">More Details</a>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-lg-12">
                <div class="room-pagination">
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">Next <i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Rooms Section End -->

    
@endsection