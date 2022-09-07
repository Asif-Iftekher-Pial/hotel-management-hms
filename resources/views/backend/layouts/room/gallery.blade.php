@extends('backend.master.master')
@section('main_section')
    {{-- <div class="page-header">
    <div class="row">
        <div class="col-sm-12 mt-5">
            <h3 class="page-title mt-3">Good Morning Soeng Souy!</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active">Rooms</li>
            </ul>
        </div>
    </div>
</div> --}}
    <section class="container mt-5">
        <h1 class="my-4 mt-5 text-center  image_title">{{ $galleries->title }}</h1>
        <div class="row gallery">
            
            {{-- @dd(count($galleries->room_type_image)) --}}
            @if (count($galleries->room_type_image) > 0)
                @foreach ($galleries->room_type_image as $picture)
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">

                        <a href="{{ asset('assets/img/roomTypeImages/' . $picture->photo) }}">
                            <figure><img class="img-fluid img-thumbnail"
                                    src="{{ asset('assets/img/roomTypeImages/' . $picture->photo) }}" alt="Random Image">
                            </figure>
                        </a>
                        <p><button class="btn btn-sm btn-danger delete-image" value="{{ $picture->id }}"><span
                                    class="fas fa fa-trash"></span></button></p>
                    </div>
                @endforeach
            @else
                <h3>No images found for {{ $galleries->title }}</h3>
            @endif


        </div>


        <div class="col-lg-12">
            @include('backend.layouts.errors.errormessage')
            <form action="{{ route('roomTypeImagesEdit',$galleries->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input class="form-control" type="text" id="title" name="title" value="{{ $galleries->title }}"
                                        placeholder="Room name">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input class="form-control" type="number" id="price" name="price" value="{{ $galleries->price }}"
                                        placeholder="Room Price">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Detail</label>
                                    <textarea name="detail" class="detail" id="summernote" value="{{ $galleries->detail }}" ></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  multiple name="imgs[]" id="editphoto"
                                      placeholder="Choose photo" accept="image/*">
                                      <label class="custom-file-label" for="inputGroupFile01">Upload more photo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-1">
                                    <div class="edit-images"> </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </div>
            </form>
        </div>
    </section>

@endsection
@section('backend_script')
    <script>
        $(document).ready(function() {
            // multiple image preview for edit 

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
                $('#editphoto').on('change', function() {
                    previewImages(this, 'div.edit-images');
                });
            });


            $('.delete-image').on('click', function(e) {
                e.preventDefault();
                var id = $(this).val();
                var url = "{{ route('roomTypeImagesDelete', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: "get",
                    url: url,
                    success: function(response) {
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
                                title: 'deleted successfully!'
                            })
                            window.setTimeout(function() {
                                location.reload(true)
                            }, 3100)
                        } else {
                            alert('something went wrong')
                        }

                    }
                });

            });


            $(document).ready(function() {
                $(".gallery").magnificPopup({
                    delegate: "a",
                    type: "image",
                    tLoading: "Loading image #%curr%...",
                    mainClass: "mfp-img-mobile",
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,
                            1
                        ] // Will preload 0 - before current, and 1 after the current image
                    },
                    image: {
                        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
                    }
                });
            });

        });
    </script>
@endsection
