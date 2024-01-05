@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Your Profile'])
    <user-badge :user="{{$user}}"></user-badge>
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <view-user :user="{{$user}}" :save_amount="{{$min_save_amount}}"></view-user>
    </div>

      <!-- Approve profile modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal1Label">Approve Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Approve</button>
            </div>
        </div>
    </div>
</div>

<!-- Decline profile modal -->
<div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal2Label">Decline Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Decline</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script>
        // window.user = @json(auth()->user());
        // console.log(window.user);
    </script>
@endpush

