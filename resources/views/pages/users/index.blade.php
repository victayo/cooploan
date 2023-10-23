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
                    <a href="{{route('users.create')}}" class="btn bg-gradient-dark btn-sm float-end mb-0">Add User</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employee ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Create Date</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$user->mainone_id}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$user->fullName}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$user->email}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold text-capitalize mb-0">{{$user->status}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{$user->created_at}}</p>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    <a class="btn bg-gradient-primary btn-sm m-0 ms-2" href="{{route('users.show', $user->mainone_id)}}">
                                                        <i class="fa fa-pen" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="View User" aria-label="View User"></i>
                                                    </a>
                                                </p>
                                                <p class="text-sm font-weight-bold mb-0 ps-2">
                                                    <a class="btn bg-gradient-danger btn-sm m-0 ms-2" href="#">
                                                        <i class="fa fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true" data-bs-original-title="View User" aria-label="View User"></i>
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
