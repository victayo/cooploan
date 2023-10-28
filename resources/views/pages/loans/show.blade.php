@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Your Profile'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="https://ui-avatars.com/api/?name={{$user->fullName}}&color=7F9CF5&background=EBF4FF" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $user->fullName }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{$employment->job_title ?? ''}}, {{$employment->department ?? ''}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <form role="form" method="POST" action={{ route('users.update', $user->mainone_id) }}>
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Edit Profile</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-uppercase text-sm">User Information</p>
                            <div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">First name</label>
                                            <input class="form-control" type="text" name="firstname"  value="{{ old('firstname', $user->firstname) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Middle name</label>
                                            <input class="form-control" type="text" name="username" value="{{ old('middlename', auth()->user()->middlename) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Last name</label>
                                            <input class="form-control" type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-sm-12 col-md-6">
                                        <label class="form-label">Gender</label>
                                        <div class="input-group">
                                            <select class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender', $user->gender) }}" required>
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label">Date of birth</label>
                                        <div class="input-group">
                                            <input id="dob" name="dob" class="form-control @error('dob') is-invalid @enderror" type="date" value="{{ old('dob', $user->dob) }}" required>
                                            @error('dob')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label mt-md-4">Monthly Savings</label>
                                        <div class="input-group">
                                            <span class="input-group-text">NGN</span>
                                            <input type="number" class="form-control @error('save_amount') is-invalid @enderror" name="save_amount" aria-label="Amount" min="{{$min_save_amount}}" value="{{ old('save_amount', $user->save_amount) }}" required>
                                            @error('save_amount')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                             @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label mt-md-4">Mainone ID</label>
                                        <div class="input-group">
                                            <input id="mainone_id" name="mainone_id" class="form-control @error('mainone_id') is-invalid @enderror" type="text" value="{{ old('mainone_id', $user->mainone_id) }}" readonly>
                                            @error('mainone_id')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label mt-md-4">Email</label>
                                            <input class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Contact Information</p>
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <label class="form-label mt-md-4">Country</label>
                                    <div class="input-group">
                                        <input id="country" name="country" class="form-control @error('country') is-invalid @enderror" type="text" value="{{ old('country', $user->country) }}" required>
                                        @error('country')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label class="form-label mt-4">State</label>
                                    <div class="input-group">
                                        <input id="state" name="state" class="form-control @error('state') is-invalid @enderror" type="text" value="{{ old('state', $user->state) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label class="form-label mt-4">City</label>
                                    <div class="input-group">
                                        <input id="city" name="city" class="form-control @error('city') is-invalid @enderror" type="text" value="{{ old('city', $user->city) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label class="form-label mt-4">Phone Number</label>
                                    <div class="input-group">
                                        <input id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" type="tel"
                                            value="{{ old('phone', $user->phone) }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label mt-md-4">Address</label>
                                    <div class="input-group">
                                        <textarea rows="3" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $user->address )}}"></textarea>
                                        @error('address')
                                            <div class="invalid-feedback" required>
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Employment Details</p>
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label mt-md-4">Resumption Date</label>
                                    <div class="input-group">
                                        <input id="resumption_date" name="resumption_date" class="form-control @error('resumption_date') is-invalid @enderror"
                                            type="date" value="{{ old('resumption_date', $employment->resumption_date ?? '') }}"  required>
                                        @error('resumption_date')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label mt-4">Department</label>
                                    <div class="input-group">
                                        <input id="department" name="department" class="form-control @error('department') is-invalid @enderror" type="text"
                                            value="{{ old('department', $employment->department ?? '') }}" required>
                                        @error('department')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label mt-4">Job Title</label>
                                    <div class="input-group">
                                        <input id="job_title" name="job_title" class="form-control @error('job_title') is-invalid @enderror" type="text"
                                            value="{{ old('job_title', $employment->job_title ?? '') }}" required>
                                        @error('job_title')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Next of Kin Information</p>
                            <div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label mt-4">First Name</label>
                                        <div class="input-group">
                                            <input id="nok_firstname" name="nok_firstname" class="form-control @error('nok_firstname') is-invalid @enderror"
                                                type="text" value="{{ old('nok_firstname', $nok->firstname ?? '') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label mt-4">Last Name</label>
                                        <div class="input-group">
                                            <input id="nok_lastname" name="nok_lastname" class="form-control @error('nok_lastname') is-invalid @enderror" type="text" value="{{ old('nok_lastname', $nok->lastname ?? '') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label mt-md-4">Date of birth</label>
                                        <div class="input-group">
                                            <input id="nok_dob" name="nok_dob" class="form-control @error('nok_dob') is-invalid @enderror" type="date" value="{{ old('nok_dob', $nok->dob ?? '') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label mt-4">Email Address</label>
                                        <div class="input-group">
                                            <input id="nok_email" name="nok_email" class="form-control @error('nok_email') is-invalid @enderror" type="email" value="{{ old('nok_email', $nok->email ?? '') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label mt-4">Phone</label>
                                        <div class="input-group">
                                            <input id="nok_phone" name="nok_phone" class="form-control @error('nok_phone') is-invalid @enderror" type="tel" value="{{ old('nok_phone', $nok->phone ?? '') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <label class="form-label">Address</label>
                                        <div class="input-group">
                                            <textarea rows="3" name="nok_address" class="form-control @error('nok_address') is-invalid @enderror" value="{{ old('nok_address', $nok->address ?? '`') }}" required></textarea>
                                            @error('nok_address')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <user-summary user="{{$user}}"></user-summary>
            </div>
        </div>
    </div>
@endsection
