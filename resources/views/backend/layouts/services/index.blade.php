@extends('backend.master.master')
@section('main_section')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12 mt-5">
                <h3 class="page-title mt-3">Good Morning Soeng Souy!</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">All Room Services</li>
                </ul>
            </div>
        </div>
    </div>
    @include('backend.layouts.errors.errormessage')
    {{-- create Modal --}}
    <div class="modal fade create-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Service </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                                                <label>Service Title</label>
                                                <input class="form-control" type="text" name="service_title"
                                                    placeholder="service_title">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Detail</label>
                                                <textarea name="service_detail" id="summernote" cols="30" rows="10"></textarea>
                                            </div>
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
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}
    {{-- edit modal --}}
    <div class="modal fade modal-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Service </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <form id="updateForm" method="post">
                            @method('put')
                            @csrf
                            <div class="row">
                                <ul id="update_validation_error">

                                </ul>
                                <input type="hidden" name="id" id="id">
                                <div class="col-lg-12">
                                    <div class="row formtype">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Service Name</label>
                                                <input class="form-control" type="text" id="service_title" name="service_title"
                                                    placeholder="service_title">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Service Detail</label>
                                                <textarea class="form-control service_detail" name="service_detail" id="summernote" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary updateButton">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End edit modal --}}
    <div class="row">
        <div class="col-md-12 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h4 class="card-title float-left mt-2">All Services</h4>
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target=".create-modal">
                        <span class="fas fa-plus"></span> Add Service
                    </button>
                </div>
                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-center">
                            <thead>
                                <tr>
                                    <th>#Sl</th>
                                    <th>Service Name</th>
                                    <th class="text-center">Service Detail</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getData as $key => $item)
                                    <tr>
                                        <th class="text-nowrap">{{ $key + 1 }}</th>
                                        <td class="text-nowrap">
                                            <div>{{ substr_replace($item->service_title, '...', 20) }}</div>
                                        </td>
                                        <td class="text-nowrap">
                                            <div>{!! html_entity_decode(substr_replace($item->service_detail, '...', 20)) !!}</div>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-warning mr-2 editButton"
                                                value="{{ $item->id }}"data-toggle="modal"
                                                data-target=".modal-edit"><span class="fas fa-pen"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('backend_script')
    <script>
        $(document).ready(function() {



            // create new dept

            $('#createForm').on('submit', function(e) {
                e.preventDefault();
                //  console.log('ok');
                $('.saveButton').html('<span class="spinner-border spinner-border-sm"></span>')
                $.ajax({
                    type: "post",
                    url: "{{ route('service.store') }}",
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



            // edit
            $(document).ready(function() {
                $('.editButton').click(function(e) {
                    e.preventDefault();
                    var id = $(this).val();
                    var url =
                    "{{ route('service.edit', ':id') }}"; //resource route  parameter passed
                    url = url.replace(':id', id); //resource route  parameter passed
                    $.ajax({
                        type: "get",
                        url: url, //passing id with route name
                        success: function(response) {
                            // console.log(response.mobile);
                            $('#id').val(response.id);
                            $('#service_title').val(response.service_title);
                            $('.service_detail').val(response.service_detail);
                        }
                    });
                });

                // update
                $('#updateForm').on('submit', function(e) {
                    e.preventDefault();
                    var id = $('#id').val();
                    // console.log(id);
                    $('.updateButton').html(
                        '<span class="spinner-border spinner-border-sm"></span>')
                    var url = "{{ route('service.update', ':id') }}"
                    url = url.replace(':id', id);
                    $.ajax({
                        type: "post",
                        url: url,
                        data: new FormData(this),
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            if (response.status == 200) {
                                $("#updateForm")[0].reset();
                                $('.modal-edit').modal('hide');
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
                                // location.reload(true);
                            } else {
                                // alert('problem');
                                $('#update_validation_error').html("");
                                $('#update_validation_error').addClass(
                                    'alert alert-danger');
                                $.each(response.error, function(key, err_value) {
                                    $('#update_validation_error').append(
                                        '<li>' +
                                        err_value + '</li>');
                                });
                                $('.updateButton').text('Update')
                            }
                        }
                    });
                });
            });


            // delete
            $(document).on('click', '.deleteButton', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var id = $(this).val();
                // console.log(id);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-info',
                        cancelButton: 'btn btn-danger mr-3'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your file is safe :)',
                            'error'
                        )
                    }
                })
            });
        });
    </script>
@endsection
