@extends('frontend.master.master')
@section('front_main')
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-text">
                        <h2>Login</h2>
                        <form  action="{{ route('front.customerLogin') }}" method="POST" class="contact-form">
                            @csrf
                            @include('frontend.layouts.errors.errormessage')
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="email" class="form-group">Email</label>
                                    <input type="email" name="email"  @if (Cookie::has('frontendcookieNameEmail')) value="{{ Cookie::get('frontendcookieNameEmail') }}" @endif placeholder="Your Email">
                                </div>
                                <div class="col-lg-6">
                                    <label for="password" class="form-group">Password</label>
                                    <input type="password" name="password"  @if (Cookie::has('frontendcookieNamePassword')) value="{{ Cookie::get('frontendcookieNamePassword') }}" @endif placeholder="Your password">
                                </div>
                                <div class="col-lg-12 d-flex" style="height: 45px;margin-top: -25px;">
                                    <input style="width: 3%" type="checkbox" @if (Cookie::has('frontendcookieNameEmail')) checked @endif name="rememberme">
                                    <label class="form-check-label" for="flexCheckDefault" style="padding-top: 13px;
                                    padding-left: 5px;">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <button type="submit">Login Now</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-text">
                        <h2>Registration</h2>
                        <ul id="save_msgList">

                        </ul>
                        <form  id="register_customer" class="contact-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="" class="form-group">Full Name</label>
                                    <input type="text" name="full_name" id="" placeholder="Your full name">
                                </div>
                                <div class="col-lg-6">
                                    <label for="email" class="form-group">Email</label>
                                    <input type="email" name="email" placeholder="Your Email">
                                </div>

                                <div class="col-lg-6">
                                    <label for="address" class="form-group">Address</label>
                                    <input type="text" name="address" placeholder="Your Address">
                                </div>
                                <div class="col-lg-6">
                                    <label for="" class="form-group">Mobile</label>
                                    <input type="number" name="mobile" placeholder="Your Mobile">
                                </div>
                                <div class="col-lg-6">
                                    <label for="" class="form-group">Password</label>
                                    <input type="password" name="password" placeholder="Your Password">
                                </div>
                               
                                <div class="col-lg-12" style="margin-left: 14px; height: 50px;">
                                    <input type="file" class="custom-file-input" name="photo" id="photo" multiple>
                                    <label class="custom-file-label" for="customFile">Upload Profile Picture</label>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mt-1">
                                        <div class="images-preview-div"> </div>
                                    </div>
                                </div>
                            </div>
                            <button class="mt-2" type="submit" id="registerButton"
                                style="padding: 10px;
                            font-size: 15px;
                            ">Register
                                Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('frontEnd_Script')
    <script>
        
        $(document).ready(function() {
             // multiple image preview for create customer
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

           

            $('#register_customer').on('submit', function(e) {
                e.preventDefault();
                // // console.log('ok');
                // $('#registerButton').text('Registering...')
                $('#registerButton').html(
                    '<span class="fa fa-spinner fa-spin" style="font-size: 25px;"></span>')
                $.ajax({
                    type: "POST",
                    url: "{{ route('front.registration') }}",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 200) {
                            $('#registerButton').text('REGISTER NOW');
                            $('#save_msgList').html(
                                ""); //if any validation error previously will be cleared
                            $('#save_msgList').removeClass(
                                'alert alert-danger'
                                ); //if any validation error previously will be cleared
                            $('#register_customer').trigger(
                                "reset"); //this will clear all fields
                            $('#thumb-output').text(''); //this will clear image fields
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
                        } else {
                            $('#save_msgList').html("");
                            $('#save_msgList').addClass('alert alert-danger');
                            $.each(response.error, function(key, err_value) {
                                $('#save_msgList').append('<li>' + err_value + '</li>');
                            });
                            $('#register_customer').trigger(
                                "reset"); //this will clear all fields
                            $('#registerButton').text('REGISTER NOW');
                        }
                    }
                });
            });
        });
    </script>
@endsection
