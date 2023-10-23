@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Add New User'])

    <div class="container-fluid my-5 py-2">
        <div class="d-flex justify-content-center mb-5">
            <div class="col-lg-9 mt-lg-0 mt-4">

                <div class="card mt-4" id="basic-info">
                    <div class="card-header">
                        <h5>New User</h5>
                    </div>
                    <div class="card-body pt-0">
                        <form method="POST" action="{{route('users.store')}}">
                            @csrf
                            <fieldset class="mt-4 p-3">
                                <legend>APPLICANT INFORMATION</legend>
                                <div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <label class="form-label mt-md-4">First Name</label>
                                            <div class="input-group">
                                                <input id="firstname" name="firstname" class="form-control @error('firstname') is-invalid @enderror" type="text"
                                                    placeholder="Firstname" value="{{ old('firstname') }}" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" required>
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
                                                <input id="lastname" name="lastname" class="form-control @error('lastname') is-invalid @enderror" type="text"
                                                    placeholder="Lastname" value="{{ old('lastname') }}" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" required >
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
                                                <input id="dob" name="dob" class="form-control @error('dob') is-invalid @enderror" type="date"
                                                    onfocus="focused(this)" onfocusout="defocused(this)" value="{{ old('dob') }}" required>
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
                                                <input id="mainone_id" name="mainone_id" class="form-control @error('mainone_id') is-invalid @enderror" type="text"
                                                    placeholder="Mainone ID" onfocus="focused(this)" value="{{ old('mainone_id') }}"
                                                    onfocusout="defocused(this)" required>
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
                                                <input id="email" name="email" class="form-control @error('email') is-invalid @enderror" type="email"
                                                    placeholder="example@mainone.net" value="{{ old('email') }}"
                                                    onfocus="focused(this)" onfocusout="defocused(this)" required>
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
                                                <input id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" type="tel"
                                                    value="{{ old('phone') }}" placeholder="+40 735 631 620" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" required>
                                                @error('phone')
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
                                                <input id="country" name="country" class="form-control @error('country') is-invalid @enderror" type="text"
                                                    placeholder="Country" onfocus="focused(this)" value="{{ old('country') }}"
                                                    onfocusout="defocused(this)" required>
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
                                                <input id="city" name="city" class="form-control @error('city') is-invalid @enderror" type="text"
                                                    value="{{ old('city') }}" placeholder="City" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" required>
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
                                            <input id="resumption_date" name="resumption_date" class="form-control @error('resumption_date') is-invalid @enderror"
                                                type="date" value="{{ old('resumption_date') }}" onfocus="focused(this)"
                                                onfocusout="defocused(this)" required>
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
                                            <input id="department" name="department" class="form-control @error('department') is-invalid @enderror" type="text"
                                                value="{{ old('department') }}" onfocus="focused(this)" onfocusout="defocused(this)" required>
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
                                            <input id="job_title" name="job_title" class="form-control @error('job_title') is-invalid @enderror" type="text"
                                                value="{{ old('job_title') }}" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                            @error('job_title')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <label class="form-label mt-4">How Long?</label>
                                        <div class="input-group">
                                            <input id="how_long" name="how_long" class="form-control @error('how_long') is-invalid @enderror" type="number" min="1"
                                                value="{{ old('how_long') }}" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                            @error('how_long')
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
                                    <div class="col-md-4 col-sm-12">
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
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label mt-4">Monthly Savings (Amount in words)</label>
                                        <div class="input-group">
                                            <input id="save_amount_words" name="save_amount_words" class="form-control @error('save_amount_words') is-invalid @enderror" type="text"
                                                value="{{ old('job_title') }}" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                            @error('save_amount_words')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                             @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label mt-4">Membership/Entrance Fee:
                                            N{{ $membership_fee }}</label>
                                        <div class="input-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="membership_fee"
                                                    id="membership_fee_yes" value="yes" checked>
                                                <label class="form-check-label" for="membership_fee_yes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="membership_fee"
                                                    id="membership_fee_no" value="no">
                                                <label class="form-check-label" for="membership_fee_no">No</label>
                                            </div>
                                        </div>
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
                                    <input id="consent" class="form-check-input" type="checkbox" value="{{ old('consent') }}" name="consent" required>
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
@endsection

@push('js')
    <script src="{{ asset('assets/js/user.js') }}" defer></script>
@endpush
