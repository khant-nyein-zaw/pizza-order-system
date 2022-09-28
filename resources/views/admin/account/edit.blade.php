@extends('admin.layouts.master')

@section('title', 'Admin Account Info Edit')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <form action="{{ route('admin#editAccount', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header text-center py-2">
                            <h3 class="text-capitalize">Edit your account info here</h3>
                        </div>
                        <div class="row g-0 p-3">
                            <div class="col-md-4">
                                <div class="d-flex justify-content-center align-items-center flex-column">
                                    @if (Auth::user()->image != null)
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            class="w-100 my-3 rounded rounded-circle img-thumbnail" />
                                    @else
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('image/user.png') }}" class="w-75 my-3">
                                        @else
                                            <img src="{{ asset('image/user (2).png') }}" class="w-75 my-3">
                                        @endif
                                    @endif
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-outline-dark">
                                        Update
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', Auth::user()->name) }}" placeholder="Enter your name">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                        <input name="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', Auth::user()->email) }}" placeholder="Enter your email">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                        <input name="phone" type="text"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone', Auth::user()->phone) }}"
                                            placeholder="Enter your phone number">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                        <input name="address" type="text"
                                            class="form-control @error('address') is-invalid @enderror"
                                            value="{{ old('address', Auth::user()->address) }}"
                                            placeholder="Enter your address">
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                            <option value="">Select gender</option>
                                            <option value="male"
                                                {{ old('gender', Auth::user()->gender) == 'male' ? 'selected' : '' }}>
                                                Male</option>
                                            <option value="female"
                                                {{ old('gender', Auth::user()->gender) == 'female' ? 'selected' : '' }}>
                                                Female</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Role</label>
                                        <input name="role" type="text" class="form-control"
                                            value="{{ Auth::user()->role }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
