@extends('backend.master.master')
@section('main_section')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12 mt-5">
            <h3 class="page-title mt-3">Good Morning Soeng Souy!</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active">Create Booking</li>
            </ul>
        </div>
    </div>
</div>
@include('backend.layouts.errors.errormessage')
<div class="col-lg-12">
    <form id="createForm">
        @csrf
        <div class="row">
            <ul id="save_msgList">

            </ul>
            <div class="col-lg-12">
                <div class="row formtype">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Customers</label>
                            <select class="custom-select" id="inputGroupSelect03">
                                <option value="" selected>---- Select Customer ----</option>
                                @foreach ($allCustomers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->full_name }}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Check In Date</label>
                            <input type="date" class="form-control checkinDate" name="checkin">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Check Out Date</label>
                            <input type="date" class="form-control" name="checkout">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Available Rooms</label>
                            <select class="custom-select room-select" id="inputGroupSelect03">
                                
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Total Adults</label>
                            <input type="number" class="form-control" min="1" name="total_adults" id="total_adults">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Total Childrens</label>
                            <input type="number" class="form-control" min="1" name="total_children" id="total_children">
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary saveButton">Save</button>
        </div>
    </form>
</div>
    
@endsection

@section('backend_script')

<script>
    $(document).ready(function () {
        $('.checkinDate').on('blur',function (e) { 
            e.preventDefault();
            var checkinDate =$(this).val();
            var url = "{{ route('availableRooms', ":checkinDate") }}";
            url = url.replace(':checkinDate', checkinDate);
            // console.log(checkinDate);
            $.ajax({
                type: "get",
                url: url,
                dataType: "json",
                beforeSend: function(){
                    $('.room-select').html('<option>---Loading---</option>');
                },
                success: function (response) {
                    // console.log(response);
                    var html='';
                    $.each(response.data, function (index, row) { 
                         html+='<option value="'+row.id+'">'+row.title+'</option>'
                    });
                    $('.room-select').html(html);
                }
            });
        });
    });
</script>
    
@endsection