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
                    <h6>Loans</h6>
                    <a href="{{route('loans.create')}}" class="btn bg-gradient-dark btn-sm float-end mb-0">Request for Loan</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Loan ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Loan Amount</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Loan Tenure</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date Requested
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date Approved
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loans as $loan)
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $loan->id }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$loan->loan_amount}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$loan->tenure}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold text-capitalize mb-0">{{$loan->status}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{$loan->created_at}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{$loan->date_approved}}</p>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    <a class="btn bg-gradient-primary btn-sm m-0 ms-2" href="{{route('loans.show', $loan->id)}}">
                                                        <i class="fa fa-eye" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="View Loan" aria-label="View Loan"></i>
                                                    </a>
                                                </p>
                                                <p class="text-sm font-weight-bold mb-0 ps-2">
                                                    <a class="btn bg-gradient-faded-warning btn-sm m-0 ms-2" href="{{route('loans.edit', $loan->id)}}">
                                                        <i class="fa fa-pen text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="Edit Loan" aria-label="Edit Loan"></i>
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
