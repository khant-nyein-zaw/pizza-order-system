@extends('admin.layouts.master')

@section('title', 'Admin List Page')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- Delete success notification -->
                @if (session('deleteSuccess'))
                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                        <strong>{{ session('deleteSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Admin List</h2>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="h4 pb-2 mb-4 text-primary border-bottom border-primary">
                        Total Admins - {{ $admins->total() }}
                    </div>
                    <form class="form-header" action="{{ route('admin#list') }}" method="get">
                        @csrf
                        <input class="au-input au-input--xl" type="text" name="searchKey"
                            value="{{ request('searchKey') }}" placeholder="Type admin info to search..." />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>
                @if (request('searchKey'))
                    <div class="float-right my-2">
                        <h3 class="text-uppercase">
                            Results of <span class="text-primary">{{ request('searchKey') }}</span>
                        </h3>
                    </div>
                @endif
                <!-- Looping Admin List -->
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr class="tr-shadow" data-userid="{{ $admin->id }}">
                                    <td class="col-2">
                                        @if ($admin->image != null)
                                            <img src="{{ asset('storage/' . $admin->image) }}"
                                                class="img-fluid rounded rounded-circle">
                                        @else
                                            @if ($admin->gender == 'male')
                                                <img src="{{ asset('image/user.png') }}" class="img-fluid">
                                            @else
                                                <img src="{{ asset('image/user (2).png') }}" class="img-fluid">
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $admin->name }}</td>
                                    <td class="desc">{{ $admin->email }}</td>
                                    <td>{{ $admin->gender }}</td>
                                    <td>{{ $admin->phone }}</td>
                                    <td>{{ $admin->address }}</td>
                                    <td>
                                        @if (Auth::user()->id != $admin->id)
                                            <select class="form-select">
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-data-feature gap-2">
                                            @if (Auth::user()->id != $admin->id)
                                                <a href="{{ route('admin#delete', $admin->id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
@endsection

@push('scriptSource')
    <script src="{{ asset('js/user_role.js') }}"></script>
@endpush
