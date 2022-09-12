@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@elseif ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" id="alertt" role="alert">
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    @endforeach
</div>
@endif