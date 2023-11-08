@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Loan Request'])

    <div class="container-fluid my-5 py-2">
        <div class="d-flex justify-content-center mb-5">
            <div class="col-lg-9 mt-lg-0 mt-4">
                <new-loan :users="{{$users}}" :tenures="{{$tenures}}"></new-loan>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/user.js') }}" defer></script>
@endpush
