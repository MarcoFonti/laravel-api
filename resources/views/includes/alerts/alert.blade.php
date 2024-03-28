@session('message')
    <div class="alert alert-{{ session('type') }} alert-dismissible fede show m-4">
        {{ $value }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endsession

