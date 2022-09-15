@extends('backend.master.master')
@section('main_section')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12 mt-5">
                <h3 class="page-title mt-3">Good Morning Soeng Souy!</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Rooms</li>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Room </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <form id="createForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <ul id="save_msgList">

                                </ul>
                                <div class="col-lg-12">
                                    <div class="row formtype">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input class="form-control" type="text" name="title"
                                                    placeholder="Room name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input class="form-control" type="number" name="price"
                                                    placeholder="Room price">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Size</label>
                                                <input class="form-control" type="number" name="size"
                                                    placeholder="Room size">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Room Type</label>
                                                <select class="form-control" id="room_type_id" name="room_type_id">
                                                    <option value="">Select</option>
                                                    @foreach ($allRoomTypes as $item)
                                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Room Service</label>
                                                <select class="form-control" id="room_service_id" name="room_service_id">
                                                    <option value="">Select</option>
                                                    @foreach ($roomService as $service)
                                                        <option value="{{ $service->id }}">{{ $service->service_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" id="sel" name="status">
                                                    <option value="">Select</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="file" class="form-control" name="photo" id="photo"
                                                    placeholder="Choose photo" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mt-1">
                                                <div class="images-preview-div"> </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Room </h5>
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
                                                <label>Title</label>
                                                <input class="form-control" type="text" id="title" name="title"
                                                    placeholder="Room name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input class="form-control" type="number" id="price" name="price"
                                                    placeholder="Room price">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Size</label>
                                                <input class="form-control" type="number" id="size" name="size"
                                                    placeholder="Room size">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Room Type</label>
                                                <select class="form-control" id="room_type_id" name="room_type_id">
                                                    <option value="">Select</option>
                                                    @foreach ($allRoomTypes as $item)
                                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Room Service</label>
                                                <select class="form-control" id="room_service_id" name="room_service_id">
                                                    <option value="">Select</option>
                                                    @foreach ($roomService as $service)
                                                        <option value="{{ $service->id }}">{{ $service->service_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" id="status" name="status">
                                                    {{-- <option selected>Select</option> --}}
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="file" class="form-control" name="photo"
                                                    id="Edit_photo" placeholder="Choose photo">
                                            </div>
                                            {{-- @error('photo')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror --}}
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mt-1">
                                                <div class="edit-images"> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mt-1">
                                                <label>Previous photo</label>
                                                <div id="previous-images"></div>
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
                    <h4 class="card-title float-left mt-2">All Rooms</h4>
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target=".create-modal">
                        <span class="fas fa-plus"></span> Add Room
                    </button>
                </div>
                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-center">
                            <thead>
                                <tr>
                                    <th>#Sl</th>
                                    <th>Title</th>
                                    <th>Room Type</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $key=>$item)
                                    <tr>
                                        <th class="text-nowrap">{{ $key+1 }}</th>
                                        <td class="text-nowrap">
                                            <div>{{ substr_replace($item->title, '...', 20) }}</div>
                                        </td>
                                        <td class="text-nowrap">
                                            <div>{{ substr_replace($item->roomType->title, '...', 20) }}</div>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="toggle" value="{{ $item->id }}"
                                                data-toggle="toggle" {{ $item->status == 'active' ? 'checked' : '' }}
                                                data-on="Active" data-off="Inactive" data-onstyle="success"
                                                data-offstyle="danger">
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('room.show', $item->id) }}" class="btn btn-primary btn-sm mr-2"><span class="fas fa-eye"></span></a>

                                            <button class="btn btn-sm btn-warning mr-2 editButton"
                                                value="{{ $item->id }}"data-toggle="modal"
                                                data-target=".modal-edit"><span class="fas fa-pen"></span>
                                            </button>
                                            <form action="{{ route('destroyRoom',$item->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-sm btn-danger deleteButton" value="{{ $item->id }}">
                                                    <span class="fas fa-trash"></span>
                                                </button>
                                            </form>
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
             // multiple image preview 
             $(function() {
                var previewImages = function(input, imgPreviewPlaceholder) {
                    if (input.files) {
                        var filesAmount = input.files.length;
                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();
                            reader.onload = function(event) {
                                $($.parseHTML('<img style="width:70px;">')).attr('src', event.target.result).appendTo(
                                    imgPreviewPlaceholder);
                            }
                            reader.readAsDataURL(input.files[i]);
                        }
                    }
                };
                $('#photo').on('change', function() {
                    previewImages(this, 'div.images-preview-div');
                });
            });

            // multiple image preview 

            $(function() {
                var previewImages = function(input, imgPreviewPlaceholder) {
                    if (input.files) {
                        var filesAmount = input.files.length;
                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();
                            reader.onload = function(event) {
                                $($.parseHTML('<img style="width:70px;">')).attr('src', event.target.result).appendTo(
                                    imgPreviewPlaceholder);
                            }
                            reader.readAsDataURL(input.files[i]);
                        }
                    }
                };
                $('#Edit_photo').on('change', function() {
                    previewImages(this, 'div.edit-images');
                });
            });

            // create new room

            $('#createForm').on('submit', function(e) {
                e.preventDefault();
                //  console.log('ok');
                $('.saveButton').html('<span class="spinner-border spinner-border-sm"></span>')
                $.ajax({
                    type: "post",
                    url: "{{ route('createRoom') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        // console.log(response);
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
                        }else{
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

            // status 
            $('input[name=toggle]').change(function() {
                var mode = $(this).prop('checked')
                var id = $(this).val();
                $.ajax({
                    type: "post",
                    url: "{{ route('roomStatus') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        mode: mode,
                        id: id
                    },
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
                                title: response.message
                            })
                        }
                    }
                });
            });

            // edit
            $(document).ready(function() {
                $('.editButton').click(function(e) {
                    e.preventDefault();
                    var id = $(this).val();
                    var asset_path = '{{ asset('assets/img/room/') }}'
                    var url = "{{ route('editRoom', ":id") }}"; //resource route  parameter passed
                    url = url.replace(':id', id); //resource route  parameter passed
                    $.ajax({
                        type: "get",
                        url: url ,//passing id with route name
                        success: function(response) {
                            //  console.log(response.room_type.title);
                            $('#title').val(response.title);
                            $('#price').val(response.price);
                            $('#size').val(response.size);
                            $('#price').val(response.price);
                            $('#room_type_id').val(response.room_type.title);
                            $('#room_service_id').val(response.service.service_title);
                            $('#status').val(response.status);
                            $('#id').val(response.id);
                            $('#previous-images').html(
                                '<img style="width:100px;" src="'+asset_path+'/'+response.photo+'">');
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
                        var url = "{{ route('roomUpdate',":id") }}"
                        url = url.replace(':id',id);
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
                                $('#update_validation_error').addClass('alert alert-danger');
                                $.each(response.error, function(key, err_value) {
                                    $('#update_validation_error').append(
                                        '<li>' +err_value + '</li>');
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
