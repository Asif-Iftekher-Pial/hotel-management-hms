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
    @include('backend.layouts.errors.errormessage')
    {{-- Modal --}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Room Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <form action="{{ route('room.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
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
                                                    placeholder="Room Price">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Detail</label>
                                                <textarea name="detail" id="summernote"></textarea>
                                            </div>
                                        </div>

                                        {{-- <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" id="sel" name="status">
                                                    <option selected>Select</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label>File Upload</label>
                                                <div class="custom-file mb-3">
                                                    <input type="file" class="custom-file-input" id="file-input"
                                                        multiple name="room_image">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                <div id="thumb-output"></div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit RoomType </h5>
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
                                <ul id="save_msgList">

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
                                                    placeholder="Room Price">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Detail</label>
                                                <textarea name="detail" class="detail" id="summernote"></textarea>
                                            </div>
                                        </div>

                                        {{-- <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label>File Upload</label>
                                                <div class="custom-file mb-3">
                                                    <input type="file" class="custom-file-input" id="file-input"
                                                        multiple name="room_image">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                <div id="thumb-output"></div>
                                            </div>
                                        </div> --}}
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
                    <h4 class="card-title float-left mt-2">Booking</h4>
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target=".bd-example-modal-lg">
                        <span class="fas fa-plus"></span> Add New Room
                    </button>
                </div>
                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-center">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Detail</th>
                                    {{-- <th class="text-center">Status</th> --}}
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allRoomTypes as $item)
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>{{ substr_replace($item->title, '...', 20) }}</div>
                                        </td>
                                        <td class="text-nowrap">
                                            <div>BDT-{{ $item->price }}</div>
                                        </td>
                                        <td class="text-nowrap">{!! html_entity_decode(substr_replace($item->detail, '...', 20)) !!}</td>
                                        {{-- <td class="text-center">
                                            <input type="checkbox" name="toggle" value="{{ $item->id }}"
                                                data-toggle="toggle" {{ $item->status == 'active' ? 'checked' : '' }}
                                                data-on="Active" data-off="Inactive" data-onstyle="success"
                                                data-offstyle="danger">
                                        </td> --}}
                                        <td class="d-flex">
                                            <button class="btn btn-sm btn-warning mr-2 editButton"
                                                value="{{ $item->id }}"data-toggle="modal"
                                                data-target=".modal-edit"><span class="fas fa-pen"></span>
                                            </button>
                                            <form action="{{ route('room.destroy', $item->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-sm btn-danger deleteButton"
                                                    value="{{ $item->id }}">
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
                    // console.log(id);
                    var url = "{{ route('room.edit', ':id') }}"; //resource route  parameter passed
                    url = url.replace(':id', id); //resource route  parameter passed
                    $.ajax({
                        type: "get",
                        // url: 'room/' + id + '/edit', //hard code url
                        url: url,
                        success: function(response) {
                            // console.log(response);
                            $('#title').val(response.title);
                            $('#price').val(response.price);
                            $('.detail').val(response.detail);
                            $('#status').val(response.status);
                            $('#id').val(response.id);
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
                    $.ajax({
                        type: "post",
                        url: 'room/' + id,
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
