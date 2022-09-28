@extends('user.layouts.master')

@section('title', 'Password Update')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-6 offset-3">
            @if (session('updateSuccess'))
                <div class="alert alert-info alert-dismissible fade show mt-2" role="alert">
                    <strong>{{ session('updateSuccess') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Change your password</h3>
                    </div>
                    <hr>
                    <form action="{{ route('user#changePassword') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Old Password</label>
                            <input id="cc-pament" name="oldPassword" type="password"
                                class="form-control @if (session('errorMsg')) is-invalid @endif
                                        @error('oldPassword') is-invalid @enderror"
                                placeholder="Enter your old password">
                            @error('oldPassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            @if (session('errorMsg'))
                                <div class="invalid-feedback">
                                    {{ session('errorMsg') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">New Password</label>
                            <input id="cc-pament" name="newPassword" type="password"
                                class="form-control @error('newPassword') is-invalid @enderror"
                                placeholder="Enter your new password">
                            @error('newPassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Password Confirmation</label>
                            <input id="cc-pament" name="passwordConfirmation" type="password"
                                class="form-control @error('passwordConfirmation') is-invalid @enderror"
                                placeholder="Confirm your new password">
                            @error('passwordConfirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-primary btn-block">
                                <span id="payment-button-amount">Save</span>
                                <i class="fa-solid fa-circle-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
