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

@endsection

@push('js')
    <script>
        // window.user = @json(auth()->user());
        // console.log(window.user);
    </script>
@endpush

