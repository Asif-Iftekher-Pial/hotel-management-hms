@extends('backend.master.master')
@section('main_section')

<div class="page-header">
    <div class="row">
        <div class="col-sm-12 mt-5">
            <h3 class="page-title mt-3">Good Morning Soeng Souy!</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h4 class="card-title float-left mt-2">{{ $getData->title }}</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table id="example" class="table table-hover table-center">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Size</th>
                                <th>Service</th>
                                <th class="text-center">Picture</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td class="text-nowrap">
                                        {!! html_entity_decode(substr_replace($getData->roomType->title, '...', 20)) !!}
                                    </td>
                                    <td class="text-nowrap">
                                        <div>BDT-{{ $getData->price }}</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div>{{ $getData->size }}-Ft</div>
                                    </td>
                                    <td class="text-nowrap">{!! html_entity_decode(substr_replace($getData->service->service_title, '...', 20)) !!}</td>
                                    <td class="text-nowrap">
                                        <img src="{{ asset('assets/img/room/'.$getData->photo) }}" style="width: 90px" alt="" srcset="">
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
    
@endsection
{{-- @section('backend_script')

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
    
@endsection --}}