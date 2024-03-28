{{-- TOAST --}}
@session('toast-message')
    <div class="toast-container position-fixed bottom-0 end-0 p-3 ">
        <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">{{ session('toast-title') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body d-flex align-items-center justify-content-between">
                {{ session('toast-body') }}

            @session('toast-method')
                @if (session('toast-method' === 'GET'))
                    <a href="{{ session('toast-ruote') }}"
                        class="btn btn-sm btn-{{ session('toast-button-type', 'primary') }}">{{ session('toast-button-label') }}</a>
                @endif
                <form action="{{ session('toast-ruote') }}" method="POST">
                    @csrf
                    @method(session('toast-method'))
                    <button
                        class="btn btn-sm btn-{{ session('toast-button-type', 'primary') }}">{{ session('toast-button-label') }}</button>
                </form>
            @endsession
            </div>
        </div>
    </div>
@endsession

