<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('assets/js/chart.morris.js') }}"></script>
{{-- <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script> --}}
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.jqueryui.min.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrapToggle/bootstrap4-toggle.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
{{-- dataTable --}}

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true
        });
    });
</script>

{{-- error notification --}}
<script>
    setTimeout(function() {
        $('#alert').slideUp();
    }, 4000);
</script>
<script>
    $(document).ready(function() {
        $('#summernote,#summernoteTwo,#summernoteThree,#summernoteFour').summernote({
        placeholder: 'Write something..',
        tabsize: 2,
        height: 100
      });
    });
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

@yield('backend_script')
