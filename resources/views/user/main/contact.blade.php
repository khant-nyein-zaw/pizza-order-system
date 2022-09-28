@extends('user.layouts.master')

@section('title', 'Contact Form')

@section('content')
    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">Contact Us</span>
        </h2>
        <div class="row px-xl-5">
            <div class="col-lg-8 mb-5">
                @if (session('success'))
                    <div class="alert alert-info alert-dismissible fade show mt-2" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="contact-form text-bg-light shadow p-30 rounded">
                    <form action="{{ route('user#contact') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <!-- name -->
                                <div>
                                    <label for="floatingName">Full Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="floatingName"
                                        placeholder="your full name">
                                </div>
                                @error('name')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <!-- email -->
                                <div>
                                    <label for="floatingEmail">Email Address</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="floatingEmail"
                                        placeholder="your email">
                                </div>
                                @error('email')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!-- phone number -->
                        <div class="mb-3">
                            <label for="floatingPassword">Phone</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                id="floatingPassword" placeholder="your phone">
                        </div>
                        @error('phone')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <!-- message -->
                        <div class="mb-3">
                            <label for="floatingMessage">Message</label>
                            <textarea name="message" class="form-control @error('message') is-invalid @enderror" placeholder="Leave a message here"
                                id="floatingMessage" style="height: 200px"></textarea>

                        </div>
                        <div class="alert alert-success alert-dismissible fade show mb-2 d-none is-validated">
                            <strong>Thanks for giving us this much message.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @error('message')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3819.682927348278!2d96.16771441469444!3d16.792443388437732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ec941531de93%3A0xbb88ba10c35d51f9!2sKANTHARYAR%20CENTRE!5e0!3m2!1sen!2smm!4v1664098952456!5m2!1sen!2smm"
                        style="width: 100%; height: 250px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="bg-light p-30 mb-30">
                    <p class="my-2"><i class="fa-solid fa-location-dot text-primary me-3"></i> No.11, Coner Of Kan Yeik
                        Thar Road &, ဦးအောင်မြတ်လမ်း</p>
                    <p class="my-2"><i class="fa-solid fa-envelope text-primary me-3"></i> admin@gmail.com</p>
                    <p class="my-2"><i class="fa-solid fa-phone-flip text-primary me-3"></i> +9599808393</p>
                </div>

            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

@push('scriptSource')
    <script src="{{ asset('js/validation.js') }}"></script>
@endpush
