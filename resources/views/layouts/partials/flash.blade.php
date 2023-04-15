@if (session('success'))
    <div class="alert alert-success text-white">
        {{ session('success') }}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning text-white">
        {{ session('warning') }}
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger text-white">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

