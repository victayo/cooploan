<div class="px-4 pt-4">
    @if ($message = session()->has('success'))
        <div class="d-flex alert alert-success alert-dismissible fade show" role="alert">
            <p class="text-white mb-0">{{ session()->get('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
    @endif
    @if ($message = session()->has('error'))
        <div class="d-flex alert alert-danger alert-dismissible fade show" role="alert">
            <p class="text-white mb-0">{{ session()->get('error') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
    @endif
</div>
