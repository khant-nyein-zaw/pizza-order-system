@extends('admin.layouts.master')

@section('title', 'Users List Page')

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
                            <h2 class="title-1">Users List</h2>
                        </div>
                    </div>
                </div>
                <!-- Looping Users list -->
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="tr-shadow" data-userid="{{ $user->id }}">
                                    <td class="col-2">
                                        @if ($user->image != null)
                                            <img src="{{ asset('storage/' . $user->image) }}" class="img-thumbnail rounded">
                                        @else
                                            @if ($user->gender == 'male')
                                                <img src="{{ asset('image/user.png') }}" class="img-thumbnail rounded">
                                            @else
                                                <img src="{{ asset('image/user (2).png') }}" class="img-thumbnail rounded">
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td class="desc">{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td class="col-2">
                                        <select class="form-select">
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                                Admin
                                            </option>
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                                                User
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{ route('users#delete', $user->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Delete">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </a>
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
