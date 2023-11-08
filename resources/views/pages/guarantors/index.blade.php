@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Loan Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div id="alert">
                @include('components.alert')
            </div>
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Guarantee Requests</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Guarantee Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount Requested </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tenure (months)</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date Requested
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date Approved/Rejected
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guarantees as $guarantee)
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $guarantee->user->fullname }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$guarantee->amount}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$guarantee->loan->tenure}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold text-capitalize mb-0">{{$guarantee->status}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{$guarantee->created_at}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{$guarantee->updated_date}}</p>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    <a class="btn btn-behance btn-sm m-0 ms-2" href="{{route('guarantor.approve', $guarantee->id)}}">
                                                        Approve
                                                    </a>
                                                </p>
                                                <p class="text-sm font-weight-bold mb-0 ps-2">
                                                    <a class="btn btn-danger btn-sm m-0 ms-2" href="{{route('guarantor.reject', $guarantee->id)}}">
                                                        Reject
                                                    </a>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
