@extends('layouts.app')

@section('content')
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Welcome to Coop!</h1>
                        {{-- <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for free.</p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="d-flex justify-content-center mb-5">
                    <div class="col-lg-9 mt-lg-0 mt-4">

                        <div class="card mt-4" id="basic-info">
                            <div class="card-body pt-0">
                                <form method="POST" action="{{route('register.perform')}}">
                                    @csrf
                                    <input type="hidden" name="expires_at" value="{{$expires}}" />
                                    <input type="hidden" name="signature" value="{{$signature}}" />
                                    <input type="hidden" name="url_email" value="{{$email}}" />
                                    <fieldset class="mt-4 p-3">
                                        <legend>APPLICANT INFORMATION</legend>
                                        <div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="form-label mt-md-4">First Name</label>
                                                    <div class="input-group">
                                                        <input id="firstname" name="firstname" class="form-control @error('firstname') is-invalid @enderror" type="text" placeholder="Firstname" value="{{ old('firstname') }}" required>
                                                        @error('firstname')
                                                            <div class="invalid-feedback">
                                                                {{$message}}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="form-label mt-4">Middle Name</label>
                                                    <div class="input-group">
                                                        <input id="middlename" name="middlename" class="form-control" type="text"
                                                            placeholder="Middlename" value="{{ old('middlename') }}" onfocus="focused(this)"
                                                            onfocusout="defocused(this)" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="form-label mt-4">Last Name</label>
                                                    <div class="input-group">
                                                        <input id="lastname" name="lastname" class="form-control @error('lastname') is-invalid @enderror" type="text" placeholder="Lastname" value="{{ old('lastname') }}" required >
                                                        @error('lastname')
                                                            <div class="invalid-feedback">
                                                                {{$message}}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <label class="form-label mt-4">Gender</label>
                                                    <div class="input-group">
                                                        <select class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required>
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
                                                    <label class="form-label mt-md-4">Date of birth</label>
                                                    <div class="input-group">
                                                        <input id="dob" name="dob" class="form-control @error('dob') is-invalid @enderror" type="date" value="{{ old('dob') }}" required>
                                                        @error('dob')
                                                            <div class="invalid-feedback">
                                                                {{$message}}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4 col-sm-12">
                                                    <label class="form-label mt-md-4">Mainone ID</label>
                                                    <div class="input-group">
                                                        <input id="mainone_id" name="mainone_id" class="form-control @error('mainone_id') is-invalid @enderror" type="text" placeholder="Mainone ID" value="{{ old('mainone_id') }}" required>
                                                        @error('mainone_id')
                                                            <div class="invalid-feedback">
                                                                {{$message}}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <label class="form-label mt-4">Email</label>
                                                    <div class="input-group">
                                                        <input id="email" name="email" class="form-control @error('email') is-invalid @enderror" type="email" value="{{ $email }}" readonly>
                                                        @error('email')
                                                            <div class="invalid-feedback">
                                                                {{$message}}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <label class="form-label mt-4">Phone Number</label>
                                                    <div class="input-group">
                                                        <input id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" type="tel" value="{{ old('phone') }}"  required>
                                                        @error('phone')
                                                            <div class="invalid-feedback">
                                                                {{$message}}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="form-label mt-md-4">Password</label>
                                                    <div class="input-group">
                                                        <input id="password" name="password" class="form-control @error('password') is-invalid @enderror" type="password" value="{{ old('password') }}" autocomplete="current-password" required>
                                                        @error('password')
                                                            <div class="invalid-feedback">
                                                                {{$message}}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="form-label mt-4">Confirm Password</label>
                                                    <div class="input-group">
                                                        <input id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" type="password" value="{{ old('password_confirmation') }}" autocomplete="current-password" required>
                                                        @error('password_confirmation')
                                                            <div class="invalid-feedback">
                                                                {{$message}}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4 col-sm-12">
                                                    <label class="form-label mt-md-4">Country</label>
                                                    <div class="input-group">
                                                        <input id="country" name="country" class="form-control @error('country') is-invalid @enderror" type="text" placeholder="Country" value="{{ old('country') }}" required>
                                                        @error('country')
                                                            <div class="invalid-feedback">
                                                                {{$message}}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <label class="form-label mt-4">State</label>
                                                    <div class="input-group">
                                                        <input id="state" name="state" class="form-control @error('state') is-invalid @enderror" type="text"
                                                            placeholder="State" value="{{ old('state') }}" onfocus="focused(this)"
                                                            onfocusout="defocused(this)" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <label class="form-label mt-4">City</label>
                                                    <div class="input-group">
                                                        <input id="city" name="city" class="form-control @error('city') is-invalid @enderror" type="text" value="{{ old('city') }}" placeholder="City" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <label class="form-label">Address</label>
                                                    <div class="input-group">
                                                        <textarea rows="3" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"></textarea>
                                                        @error('address')
                                                            <div class="invalid-feedback" required>
                                                                {{$message}}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="mt-4 p-3">
                                        <legend>EMPLOYMENT INFORMATION</legend>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-12">
                                                <label class="form-label mt-md-4">Resumption Date</label>
                                                <div class="input-group">
                                                    <input id="resumption_date" name="resumption_date" class="form-control @error('resumption_date') is-invalid @enderror" type="date" value="{{ old('resumption_date') }}" required>
                                                    @error('resumption_date')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="form-label mt-4">Department</label>
                                                <div class="input-group">
                                                    <input id="department" name="department" class="form-control @error('department') is-invalid @enderror" type="text" value="{{ old('department') }}" required>
                                                    @error('department')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <label class="form-label mt-4">Job Title</label>
                                                <div class="input-group">
                                                    <input id="job_title" name="job_title" class="form-control @error('job_title') is-invalid @enderror" type="text" value="{{ old('job_title') }}" required>
                                                    @error('job_title')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3">
                                                <label class="form-label mt-4">Are you a Contract Staff?</label>
                                                <div class="input-group">
                                                    <select class="form-control @error('contract_staff') is-invalid @enderror" name="contract_staff" value="{{ old('contract_staff') }}" required>
                                                        <option value="">---</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                    @error('contract_staff')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="mt-4 p-3">
                                        <legend>AUTHORITY TO DEBIT MY SALARY ACCOUNT AS FOLLOWS</legend>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <label class="form-label mt-md-4">Monthly Savings</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">NGN</span>
                                                    <input type="number" class="form-control @error('save_amount') is-invalid @enderror" name="save_amount" aria-label="Amount" min="{{$min_save_amount}}" value="{{ old('save_amount') }}" required>
                                                    @error('save_amount')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                     @enderror
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <strong class="text-sm text-danger text-monospace">A Membership/Entrance Fee of NGN{{ $membership_fee }} will be charged. This is a one-time payment.</strong>
                                            </div>
                                        </div>
                                    </fieldset>


                                    <fieldset class="mt-4 p-3">
                                        <legend class="w-auto px-2">Next of Kin</legend>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <label class="form-label mt-4">First Name</label>
                                                <div class="input-group">
                                                    <input id="nok_firstname" name="nok_firstname" class="form-control @error('nok_firstname') is-invalid @enderror"
                                                        type="text" placeholder="Firstname" value="{{ old('nok_firstname') }}"
                                                        onfocus="focused(this)" onfocusout="defocused(this)" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label class="form-label mt-4">Last Name</label>
                                                <div class="input-group">
                                                    <input id="nok_lastname" name="nok_lastname" class="form-control @error('nok_lastname') is-invalid @enderror"
                                                        type="text" placeholder="Lastname" value="{{ old('nok_lastname') }}"
                                                        onfocus="focused(this)" onfocusout="defocused(this)" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <label class="form-label mt-md-4">Date of birth</label>
                                                <div class="input-group">
                                                    <input id="nok_dob" name="nok_dob" class="form-control @error('nok_dob') is-invalid @enderror" type="date"
                                                        onfocus="focused(this)" onfocusout="defocused(this)" value="{{ old('nok_dob') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label class="form-label mt-4">Email Address</label>
                                                <div class="input-group">
                                                    <input id="nok_email" name="nok_email" class="form-control @error('nok_email') is-invalid @enderror" type="email"
                                                        placeholder="example@example.com" value="{{ old('nok_email') }}" onfocus="focused(this)"
                                                        onfocusout="defocused(this)" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label class="form-label mt-4">Phone</label>
                                                <div class="input-group">
                                                    <input id="nok_phone" name="nok_phone" class="form-control @error('nok_phone') is-invalid @enderror" type="tel"
                                                        value="{{ old('nok_phone') }}" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <label class="form-label">Address</label>
                                                <div class="input-group">
                                                    <textarea rows="3" name="nok_address" class="form-control @error('nok_address') is-invalid @enderror" value="{{ old('nok_address') }}" required></textarea>
                                                    @error('nok_address')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <div class="row mt-4">
                                        <div class="form-check col-12">
                                            <input id="consent" class="form-check-input" type="checkbox" value="true" name="consent" required>
                                            <label class="form-check-label" for="consent">
                                                I confirm that the information provided in this form is accurate and complete.
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <a class="btn bg-gradient-danger m-0 ms-2" href="{{route('users.index')}}">Cancel</a>
                                        <button type="submit" class="btn bg-gradient-primary m-0 ms-2">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts.footers.guest.footer')
@endsection
