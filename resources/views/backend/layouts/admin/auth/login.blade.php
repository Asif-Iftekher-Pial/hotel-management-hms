<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hotel Dashboard</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/feathericon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left"> <img class="img-fluid" src="{{ asset('assets/img/logo.png') }}" alt="Logo"> </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>
                            <p class="account-subtitle">Access to our dashboard</p>
                            @include('backend.layouts.errors.errormessage')
                            <form action="{{ route('loginSubmit') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" type="text" name="email"
                                        @if (Cookie::has('backendcookieNameEmail')) value="{{ Cookie::get('backendcookieNameEmail') }}" @endif
                                        placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password"
                                        @if (Cookie::has('backendcookieNamePassword')) value="{{ Cookie::get('backendcookieNamePassword') }}" @endif
                                        placeholder="Password">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="rememberMe"
                                        id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Remember Password?</label>
                                </div>
                                <div class="form-group mt-3">
                                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                                </div>
                            </form>
                            <div class="text-center forgotpass"><a href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="login-or"> <span class="or-line"></span> <span class="span-or">or</span> </div>
                            <div class="social-login"> <span>Login with</span> <a href="#" class="facebook"><i
                                        class="fab fa-facebook-f"></i></a><a href="#" class="google"><i
                                        class="fab fa-google"></i></a> </div>
                            <div class="text-center dont-have">Don’t have an account? <a
                                    href="register.html">Register</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    {{-- error notification --}}
    <script>
        setTimeout(function() {
            $('#alert').slideUp();
        }, 4000);
    </script>
    <script>
        @if (Session::has('T-messege'))
            var type = "{{ Session::get('alert-type') }}"
            switch (type) {
                case 'error':
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'error',
                        title: '{{ Session::get('T-messege') }}'
                    })
                    break;
            }
        @endif
    </script>
    <script>
        @if (Session::has('T-messege'))
            var type = "{{ Session::get('alert-type') }}"
            switch (type) {
                case 'success':
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'warning',
                        title: '{{ Session::get('T-messege') }}'
                    })
                    break;
            }
        @endif
    </script>

</body>

</html>
