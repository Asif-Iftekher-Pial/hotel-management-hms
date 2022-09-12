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
                            <select class="custom-select" id="inputGroupSelect03" name="customer_id">
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
                            <select class="custom-select room-select" name="room_id" id="inputGroupSelect03">
                                
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


        // create 

        $('#createForm').on('submit', function(e) {
                e.preventDefault();
                //  console.log('ok');
                $('.saveButton').html('<span class="spinner-border spinner-border-sm"></span>')
                $.ajax({
                    type: "post",
                    url: "{{ route('bookings.store') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        // console.log(response)
                        if (response.status == 200) {
                            $('.create-modal').modal('hide');
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter',
                                        Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave',
                                        Swal
                                        .resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            })
                            window.setTimeout(function() {
                                location.reload(true)
                            }, 2100)
                        } else {
                            $('#save_msgList').html("");
                            $('#save_msgList').addClass('alert alert-danger');
                            $.each(response.error, function(key, err_value) {
                                $('#save_msgList').append('<li>' +
                                    err_value + '</li>');
                            });

                        }
                    }
                });
            });

    });
</script>
    
@endsection