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
                                                <input id="firstname" name="firstname" class="form-control" type="text"
                                                    placeholder="Firstname" value="" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label class="form-label mt-4">Middle Name</label>
                                            <div class="input-group">
                                                <input id="middlename" name="middlename" class="form-control" type="text"
                                                    placeholder="Middlename" value="" onfocus="focused(this)"
                                                    onfocusout="defocused(this)">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label class="form-label mt-4">Last Name</label>
                                            <div class="input-group">
                                                <input id="lastname" name="lastname" class="form-control" type="text"
                                                    placeholder="Lastname" value="" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <label class="form-label mt-4">Gender</label>
                                            <select class="form-control" name="gender" id="choices-gender" required>
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label class="form-label mt-md-4">Date of birth</label>
                                            <div class="input-group">
                                                <input id="dob" name="dob" class="form-control" type="date"
                                                    onfocus="focused(this)" onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label mt-md-4">Mainone ID</label>
                                            <div class="input-group">
                                                <input id="mainone_id" name="mainone_id" class="form-control" type="text"
                                                    placeholder="Mainone ID" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label mt-4">Email</label>
                                            <div class="input-group">
                                                <input id="email" name="email" class="form-control" type="email"
                                                    placeholder="example@mainone.net" value=""
                                                    onfocus="focused(this)" onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label mt-4">Phone Number</label>
                                            <div class="input-group">
                                                <input id="phone" name="phone" class="form-control" type="tel"
                                                    value="" placeholder="+40 735 631 620" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label mt-md-4">Country</label>
                                            <div class="input-group">
                                                <input id="country" name="country" class="form-control" type="text"
                                                    placeholder="Country" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label mt-4">State</label>
                                            <div class="input-group">
                                                <input id="state" name="state" class="form-control" type="text"
                                                    placeholder="State" value="" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label mt-4">City</label>
                                            <div class="input-group">
                                                <input id="city" name="city" class="form-control" type="text"
                                                    value="" placeholder="City" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <label class="form-label">Address</label>
                                            <div class="input-group">
                                                <textarea rows="3" class="form-control" required></textarea>
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
                                            <input id="resumption_date" name="resumption_date" class="form-control"
                                                type="date" value="" onfocus="focused(this)"
                                                onfocusout="defocused(this)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <label class="form-label mt-4">Department</label>
                                        <div class="input-group">
                                            <input id="department" name="department" class="form-control" type="text"
                                                value="" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <label class="form-label mt-4">Job Title</label>
                                        <div class="input-group">
                                            <input id="job_title" name="job_title" class="form-control" type="text"
                                                value="" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <label class="form-label mt-4">How Long?</label>
                                        <div class="input-group">
                                            <input id="how_long" name="how_long" class="form-control" type="number" min="1"
                                                value="" onfocus="focused(this)" onfocusout="defocused(this)" required>
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
                                            <input type="number" class="form-control" aria-label="Amount" min="{{$min_save_amount}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label mt-4">Monthly Savings (Amount in words)</label>
                                        <div class="input-group">
                                            <input id="job_title" name="job_title" class="form-control" type="text"
                                                value="" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label mt-4">Membership/Entrance Fee:
                                            N{{ $membership_fee }}</label>
                                        <div class="input-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="membership_fee"
                                                    id="membership_fee_yes" value="yes">
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
                                            <input id="nok_firstname" name="nok_firstname" class="form-control"
                                                type="text" placeholder="Firstname" value=""
                                                onfocus="focused(this)" onfocusout="defocused(this)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label mt-4">Last Name</label>
                                        <div class="input-group">
                                            <input id="nok_lastname" name="nok_lastname" class="form-control"
                                                type="text" placeholder="Lastname" value=""
                                                onfocus="focused(this)" onfocusout="defocused(this)" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label mt-md-4">Date of birth</label>
                                        <div class="input-group">
                                            <input id="nok_dob" name="nok_dob" class="form-control" type="date"
                                                onfocus="focused(this)" onfocusout="defocused(this)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label mt-4">Email Address</label>
                                        <div class="input-group">
                                            <input id="nok_email" name="nok_email" class="form-control" type="email"
                                                placeholder="example@example.com" value="" onfocus="focused(this)"
                                                onfocusout="defocused(this)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label mt-4">Phone</label>
                                        <div class="input-group">
                                            <input id="nok_phone" name="nok_phone" class="form-control" type="tel"
                                                value="" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label mt-md-4">Country</label>
                                        <div class="input-group">
                                            <input id="country" name="country" class="form-control" type="text"
                                                placeholder="Country" onfocus="focused(this)"
                                                onfocusout="defocused(this)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label mt-4">State</label>
                                        <div class="input-group">
                                            <input id="state" name="state" class="form-control" type="text"
                                                placeholder="State" value="" onfocus="focused(this)"
                                                onfocusout="defocused(this)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label class="form-label mt-4">City</label>
                                        <div class="input-group">
                                            <input id="city" name="city" class="form-control" type="text"
                                                value="" placeholder="City" onfocus="focused(this)"
                                                onfocusout="defocused(this)" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row mt-4">
                                <div class="form-check col-12">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault" required>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I confirm that the information provided in this form is accurate and complete.
                                    </label>
                                </div>
                            </div>





                            <div class="d-flex justify-content-end mt-4">
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
