@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div id="alert">
                @include('components.alert')
            </div>
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Users</h6>
                    <button class="btn bg-gradient-dark btn-sm float-end mb-0" data-bs-toggle="modal" data-bs-target="#send-registration-link">
                        Send Registration Link
                    </button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <user-list :users="{{$users}}"></user-list>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" tabindex="-1" id="send-registration-link">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send Registration Link</h5>
                    <button type="button" class="btn-close reg-modal-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('users.sendlink') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label mt-md-4">Email</label>
                                <div class="input-group">
                                    <input id="email" name="email" class="form-control @error('email') is-invalid @enderror" type="text" value="{{ old('email') }}"  required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn bg-gradient-primary m-0 ms-2">Send Link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<style>
    .reg-modal-close {
        color: black;
    }
</style>
@endpush
