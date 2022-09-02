@extends('backend.master.master')
@section('main_section')
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h4 class="card-title text-center mt-4">{{ $getData->full_name }}</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table id="example" class="table table-hover table-center">
                        <thead>
                            <tr>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Photo</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td class="text-nowrap text-center">
                                        <div>{{ $getData->mobile }}</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div>{{ $getData->address }}</div>
                                    </td>
                                    <td class="text-center">
                                        <img style="height: 60px;width:60px" src="{{ asset('assets/img/customer/'.$getData->photo) }}" alt="{{ $getData->full_name }}">
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