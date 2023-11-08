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
                                            <p class="text-sm font-weight-bold text-capitalize mb-0">
                                                @switch($guarantee->status)
                                                    @case('pending')
                                                        <span class="badge badge-secondary">{{$guarantee->status}}</span>
                                                        @break
                                                    @case('approved')
                                                        <span class="badge badge-success">{{$guarantee->status}}</span>
                                                        @break
                                                    @case('rejected')
                                                        <span class="badge badge-danger">{{$guarantee->status}}</span>
                                                        @break
                                                    @default

                                                @endswitch
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{$guarantee->created_at->format("M j, Y g:i a")}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{$guarantee->updated_at->format("M j, Y g:i a")}}</p>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    @if ($guarantee->status == 'pending')
                                                        <button class="btn btn-behance btn-sm m-0 ms-2" onclick="approveGuarantee('approve', {{$guarantee->id}})">Approve</button>
                                                    @else
                                                        <button class="btn btn-behance btn-sm m-0 ms-2" onclick="approveGuarantee('approve', {{$guarantee->id}})" disabled>Approve</button>
                                                    @endif
                                                </p>
                                                <p class="text-sm font-weight-bold mb-0 ps-2">
                                                    @if ($guarantee->status == 'pending')
                                                        <button class="btn btn-danger btn-sm m-0 ms-2" onclick="approveGuarantee('reject', {{$guarantee->id}})">Reject</button>
                                                    @else
                                                        <button class="btn btn-danger btn-sm m-0 ms-2" onclick="approveGuarantee('reject', {{$guarantee->id}})" disabled>Reject</button>
                                                    @endif
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

@push('js')
    {{-- <script src="{{ asset('assets/js/guarantor.js') }}" defer></script> --}}
    <script>
        function approveGuarantee(action, id){
            if(window.confirm('Are you sure you want to '+action+'?')){
                axios.post(`/api/guarantor/${action}/${id}`, {}).then(response => {
                    let data = response.data;
                    if(data.status == 'success'){
                        location.reload();
                    }
                })
            }
        }
    </script>
@endpush
