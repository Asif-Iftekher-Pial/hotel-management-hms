@foreach ($GetRoom as $item)
    <div class="col-lg-4 col-md-6">
        <div class="room-item">
            <img src="{{ asset('assets/img/room/' . $item->photo) }}" alt="">
            <div class="ri-text">
                <h4>{!! html_entity_decode(substr_replace($item->title, '...', 15)) !!}</h4>
                <h3>{{ $item->price }}$<span>/Pernight</span></h3>
                <table>
                    <tbody>
                        <tr>
                            <td class="r-o">Category:</td>
                            <td>{{ substr_replace($item->roomType->title, '...', 15) }}</td>
                        </tr>
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
                <a href="{{ route('front.room_detail', $item->id) }}" class="primary-btn">More Details</a>
            </div>
        </div>
    </div>
@endforeach
