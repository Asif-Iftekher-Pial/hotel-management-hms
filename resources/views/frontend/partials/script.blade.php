 <!-- Js Plugins -->
 <script src="{{ asset('front/js/jquery-3.3.1.min.js') }}"></script>
 <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
 <script src="{{ asset('front/js/jquery.nice-select.min.js') }}"></script>
 <script src="{{ asset('front/js/jquery-ui.min.js') }}"></script>
 <script src="{{ asset('front/js/jquery.slicknav.js') }}"></script>
 <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
 <script src="{{ asset('front/js/main.js') }}"></script>
 <script src="{{ asset('front/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
 {{-- error notification --}}
<script>
    setTimeout(function() {
        $('#alert').slideUp();
    }, 4000);
</script>
 {{-- toastr notification --}}
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
                    icon: 'success',
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
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>

 @yield('frontEnd_Script')

 