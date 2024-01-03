@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Fees Report'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div id="alert">
                @include('components.alert')
            </div>
            <div class="mb-4">
                <div class="pb-0">
                    <h6>Reports</h6>
                </div>
                <div class="px-0 pt-0 pb-2">
                    <div class="mb-3">
                        <fees :type="'membership'"></fees>
                    </div>
                    <div class="card mb-3">
                        <fees :type="'loan-processing'"></fees>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
