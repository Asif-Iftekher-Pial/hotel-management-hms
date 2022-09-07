@extends('backend.master.master')
@section('main_section')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12 mt-5">
                <h3 class="page-title mt-3">Good Morning Soeng Souy!</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">All Stuff</li>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Stuff </h5>
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
                                                <label>Full Name</label>
                                                <input class="form-control" type="text" name="full_name"
                                                    placeholder="Customer name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select class="form-control" name="department_id" id="exampleFormControlSelect1">
                                                    <option value="" selected>Select Department</option>
                                                    @foreach($allDept as $department)
                                                    <option value="{{ $department->id }}">{{ $department->title }}</option>
                                                    @endforeach
                                                  </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Bio</label>
                                                <textarea name="bio" id="summernote" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Salary Type</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="salary_type" id="exampleRadios1" value="daily">
                                                    <label class="form-check-label" for="exampleRadios1">
                                                      Daily
                                                    </label>
                                                  </div>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="salary_type" id="exampleRadios2" value="monthly">
                                                    <label class="form-check-label" for="exampleRadios2">
                                                     Monthly
                                                    </label>
                                                  </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Salary Amount</label>
                                                <input type="number" class="form-control" name="salary_amt" id="salary_amt">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">Upload</span>
                                                </div>
                                                <div class="custom-file">
                                                  <input type="file" class="custom-file-input"  multiple name="photo" id="photo"
                                                  placeholder="Choose photo" accept="image/*">
                                                  <label class="custom-file-label" for="inputGroupFile01">Upload Photo</label>
                                                </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Staff </h5>
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
                                                <label>Full Name</label>
                                                <input class="form-control" type="text" name="full_name" id="full_name"
                                                    placeholder="Customer name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select class="form-control" name="department_id" id="department_id">
                                                    <option value="" selected>Select Department</option>
                                                    @foreach($allDept as $department)
                                                    <option value="{{ $department->id }}">{{ $department->title }}</option>
                                                    @endforeach
                                                  </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Bio</label>
                                                <textarea class="bio" name="bio" id="summernote" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Salary Type</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="salary_type" id="salary_type" value="daily">
                                                    <label class="form-check-label" for="exampleRadios1">
                                                      Daily
                                                    </label>
                                                  </div>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="salary_type" id="salary_type" value="monthly">
                                                    <label class="form-check-label" for="exampleRadios2">
                                                     Monthly
                                                    </label>
                                                  </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Salary Amount</label>
                                                <input type="number" class="form-control" name="salary_amt" id="salary_amount">
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
    {{-- view modal --}}
    <div class="modal fade modal-view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="show_name" > </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="salary type">Salary Type:</label>
                                <p id="show_salary_type"></p>
                               </div>
                               <div class="col-lg-6">
                                <label for="salary amount">Salary Amount:</label>
                                <p id="show_salary_amn"></p>
                            </div>
                        </div>

                        <h4>Bio:</h4>
                        <p id="show_bio"></p>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End view modal --}}
    <div class="row">
        <div class="col-md-12 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h4 class="card-title float-left mt-2">All Stuff</h4>
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target=".create-modal">
                        <span class="fas fa-plus"></span> Add Stuff
                    </button>
                </div>
                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-center">
                            <thead>
                                <tr>
                                    <th>#Sl</th>
                                    <th>Photo</th>
                                    <th>Full Name</th>
                                    <th class="text-center">Department</th>
                                    
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getData as $key => $item)
                                    <tr>
                                        <th class="text-nowrap">{{ $key + 1 }}</th>
                                        
                                        <td class="text-nowrap">
                                            <img src="{{ asset('assets/img/staff/'.$item->photo) }}" style="width: 100px"  alt="" srcset="">
                                        </td>
                                        <td class="text-nowrap">
                                            <div>{{ $item->full_name }}</div>
                                        </td>
                                        <td class="text-nowrap">
                                            <div>{{ $item->department->title }}</div>
                                        </td>
                                       
                                        <td class="d-flex">
                                            
                                            <button class="btn btn-sm btn-primary mr-2 viewButton"
                                                value="{{ $item->id }}"data-toggle="modal"
                                                data-target=".modal-view" ><span class="fas fa-eye"></span>
                                            </button>
                                            <button class="btn btn-sm btn-warning mr-2 editButton"
                                                value="{{ $item->id }}"data-toggle="modal"
                                                data-target=".modal-edit"><span class="fas fa-pen"></span>
                                            </button>
                                            <form action="{{ route('staff.destroy', $item->id) }}" method="post">
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

            //  image preview for create customer
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
            // multiple image preview for edit customer

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


            // create new customer

            $('#createForm').on('submit', function(e) {
                e.preventDefault();
                //  console.log('ok');
                $('.saveButton').html('<span class="spinner-border spinner-border-sm"></span>')
                $.ajax({
                    type: "post",
                    url: "{{ route('staff.store') }}",
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

            // status 
            // $('input[name=toggle]').change(function() {
            //     var mode = $(this).prop('checked')
            //     var id = $(this).val();
            //     $.ajax({
            //         type: "post",
            //         url: "{{ route('roomStatus') }}",
            //         data: {
            //             _token: '{{ csrf_token() }}',
            //             mode: mode,
            //             id: id
            //         },
            //         success: function(response) {
            //             // console.log(response);
            //             if (response.status == 200) {
            //                 const Toast = Swal.mixin({
            //                     toast: true,
            //                     position: 'top-end',
            //                     showConfirmButton: false,
            //                     timer: 3000,
            //                     timerProgressBar: true,
            //                     didOpen: (toast) => {
            //                         toast.addEventListener('mouseenter', Swal
            //                             .stopTimer)
            //                         toast.addEventListener('mouseleave', Swal
            //                             .resumeTimer)
            //                     }
            //                 })
            //                 Toast.fire({
            //                     icon: 'success',
            //                     title: response.message
            //                 })
            //             }
            //         }
            //     });
            // });


            // view
            $('.viewButton').click(function (e) { 
                e.preventDefault();
                var id =$(this).val();
                var url="{{ route('staff.show',':id') }}";
                url = url.replace(':id',id);
                $.ajax({
                    type: "get",
                    url: url,
                    success: function (response) {
                        // console.log(response);
                        $('#show_name').text(response.full_name)
                        $('#show_salary_type').text(response.salary_type)
                        $('#show_salary_amn').text('BDT: '+response.salary_amt)
                        $('#show_bio').html(response.bio).text()
                    }
                });
            });

            // edit
            $(document).ready(function() {
                $('.editButton').click(function(e) {
                    e.preventDefault();
                    var id = $(this).val();
                    var asset_path = '{{ asset('assets/img/staff/') }}'
                    var url =
                    "{{ route('staff.edit', ':id') }}"; //resource route  parameter passed
                    url = url.replace(':id', id); //resource route  parameter passed

                    $.ajax({
                        type: "get",
                        url: url, //passing id with route name
                        success: function(response) {
                            // console.log(response);
                            $('#id').val(response.id);
                            $('#full_name').val(response.full_name);
                            $('#department_id').val(response.department_id);
                            $('.bio').val(response.bio);
                            $('#salary_type').val(response.salary_type);
                            $('#salary_amount').val(response.salary_amt);
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
                    var url = "{{ route('staff.update', ':id') }}"
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
                            console.log(response);
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
