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
                        <form method="POST" action="https://argon-dashboard-pro-laravel.creative-tim.com/user-management/new"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="MBjTmbezHhkvRSgyELLBIni7MA9gCnM8odL4vPy4">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">First Name</label>
                                    <div class="input-group">
                                        <input id="firstname" name="firstname" class="form-control" type="text"
                                            placeholder="Firstname" value="" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Last Name</label>
                                    <div class="input-group">
                                        <input id="lastname" name="lastname" class="form-control" type="text"
                                            placeholder="Lastname" value="" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <input id="password" name="password" class="form-control" type="password"
                                            placeholder="Password" onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <input id="confirm-password" name="confirm-password" class="form-control"
                                            type="password" placeholder="Confirm Password" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="form-label">Role</label>
                                <select name="role" id="choices-role" class="form-control" hidden="" tabindex="-1">
                                    <option value="">Role</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-6">
                                    <label class="form-label mt-4">Gender</label>
                                    <select class="form-control" name="gender" id="choices-gender" hidden="" tabindex="-1">
                                        <option value="">Choose</option>
                                    </select>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-5 col-5">
                                            <label class="form-label mt-4">Birth Date</label>
                                            <select class="form-control" name="choices-month" id="choices-month" hidden="" tabindex="-1">
                                                <option value="">Month</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 col-3">
                                            <label class="form-label mt-4">Day</label>
                                            <select class="form-control" name="choices-day" id="choices-day" hidden="" tabindex="-1">
                                                <option value="">Day</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3 col-4">
                                            <label class="form-label mt-4">Year</label>
                                            <select class="form-control" name="choices-year" id="choices-year" hidden="" tabindex="-1">
                                                <option value="">Year</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label mt-4">Email</label>
                                    <div class="input-group">
                                        <input id="email" name="email" class="form-control" type="email"
                                            placeholder="example@email.com" value="" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label mt-4">Confirmation Email</label>
                                    <div class="input-group">
                                        <input id="confirmation" name="confirmation" class="form-control"
                                            type="email" placeholder="example@email.com" value=""
                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label mt-4">Location</label>
                                    <div class="input-group">
                                        <input id="location" name="location" class="form-control" type="text"
                                            value="" placeholder="Sydney, A" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label mt-4">Phone Number</label>
                                    <div class="input-group">
                                        <input id="phone" name="phone" class="form-control" type="number"
                                            value="" placeholder="+40 735 631 620" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <label class="form-label mt-4">Language</label>
                                    <select class="form-control" name="language" id="choices-language" hidden=""
                                        tabindex="-1">
                                        <option value="">Choose</option>
                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label mt-4">Skills</label>
                                    <input class="form-control" id="skills" name="skills" type="text"
                                        placeholder="Enter your skills" value="" onfocus="focused(this)"
                                        onfocusout="defocused(this)">
                                </div>
                                <div class="d-flex flex-column">
                                    <label class="mt-4 form-label" for="avatar">Add Image</label>
                                    <input type="file" name="avatar" accept="image/*" id="avatar"
                                        class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <a href="https://argon-dashboard-pro-laravel.creative-tim.com/user-management"
                                    class="btn btn-light m-0">Back</a>
                                <button type="submit" class="btn bg-gradient-primary m-0 ms-2">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>2023,
                            made with <i class="fa fa-heart" aria-hidden="true"></i> by
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                                Tim</a>
                            &amp;
                            <a href="https://www.updivision.com" class="font-weight-bold"
                                target="_blank">UPDIVISION</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.updivision.com" class="nav-link text-muted"
                                    target="_blank">UPDIVISION</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                    target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                    target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                    target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                    target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection

@push('js')
    <script src="{{asset('assets/js/user.js')}}" defer></script>
@endpush
