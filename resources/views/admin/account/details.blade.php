@extends('admin.layouts.master')

@section('title', 'Admin Account Details')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                @if (session('updated'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        <strong>{{ session('updated') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-header text-center py-2">
                        <h3>Account Details</h3>
                    </div>
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-center">
                                @if (Auth::user()->image != null)
                                    <img src="{{ asset('storage/' . Auth::user()->image) }}" class="img-fluid" />
                                @else
                                    @if (Auth::user()->gender == 'male')
                                        <img src="{{ asset('image/user.png') }}" class="w-75 my-3">
                                    @else
                                        <img src="{{ asset('image/user (2).png') }}" class="w-75 my-3">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text mb-2">
                                    <i class="fa-solid fa-user me-2"></i> {{ Auth::user()->name }}
                                </p>
                                <p class="card-text mb-2">
                                    <i class="fa-sharp fa-solid fa-envelope me-2"></i> {{ Auth::user()->email }}
                                </p>
                                <p class="card-text mb-2">
                                    <i class="fa-solid fa-square-phone-flip me-2"></i> {{ Auth::user()->phone }}
                                </p>
                                <p class="card-text mb-2">
                                    <i class="fa-solid fa-address-card me-2"></i> {{ Auth::user()->address }}
                                </p>
                                <p class="card-text mb-2">
                                    <i class="fa-solid fa-mars me-2"></i> {{ Auth::user()->gender }}
                                </p>
                                <p class="card-text mb-2">
                                    <i class="fa-solid fa-calendar me-2"></i>
                                    {{ Auth::user()->created_at->format('F j Y') }}
                                </p>
                                <a href="{{ route('admin#editPage') }}" class="btn btn-block btn-outline-primary">
                                    Edit Your Account Info
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
