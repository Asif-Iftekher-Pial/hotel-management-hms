@extends('backend.master.master')
@section('main_section')
<div class="row">
    <div class="col-md-12 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h4 class="card-title float-left mt-2">All Salary</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table id="example" class="table table-hover table-center">
                        <thead>
                            <tr>
                                <th>#Sl</th>
                                <th>Staff Name</th>
                                <th>Amount</th>
                                <th>Payment Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allSalaries as $key => $item)
                                <tr>
                                    <th class="text-nowrap">{{ $key + 1 }}</th>
                                    
                                    <td class="text-nowrap">
                                        {{ $item->staff->full_name }}
                                    </td>
                                    <td class="text-nowrap">
                                        <div>{{ $item->amount }}</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <div>{{ $item->payment_date }}</div>
                                    </td>
                                   
                                    <td class="d-flex">
                                        
                                        {{-- <button class="btn btn-sm btn-primary mr-2 viewButton"
                                            value="{{ $item->id }}"data-toggle="modal"
                                            data-target=".modal-view" ><span class="fas fa-eye"></span>
                                        </button>
                                        <button class="btn btn-sm btn-warning mr-2 editButton"
                                            value="{{ $item->id }}"data-toggle="modal"
                                            data-target=".modal-edit"><span class="fas fa-pen"></span>
                                        </button> --}}
                                        <form action="{{ route('Salarydestroy', $item->id) }}" method="post">
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
</script>
    
@endsection