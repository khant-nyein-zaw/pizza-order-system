@extends('admin.layouts.master')

@section('title', 'Product Details')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="mb-3">
                <button class="btn btn-warning" onclick="history.back()">
                    <i class="fa-solid fa-circle-chevron-left me-2"></i> Back
                </button>
            </div>
            <div class="mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body text-center">
                                <h3 class="card-title fw-bold text-uppercase">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-muted mb-2">
                                    {{ $product->description }}
                                </p>
                                <p class="mb-2 btn btn-warning">
                                    Category <i class="fa-solid fa-table-list ms-1 me-2"></i> -
                                    {{ $product->category_name }}
                                </p>
                                <p class="mb-2 btn btn-warning">
                                    Price <i class="fa-solid fa-dollar-sign ms-1 me-2"></i> - {{ $product->price }} mmk
                                </p>
                                <p class="mb-2 btn btn-warning">
                                    Wating Time <i class="fa-solid fa-clock ms-1 me-2"></i> -
                                    {{ $product->waiting_time }}
                                    minutes
                                </p>
                                <p class="mb-2 btn btn-warning">
                                    View Count <i class="fa-solid fa-eye ms-1 me-2"></i> - {{ $product->view_count }}
                                </p>
                                <p class="mb-2 btn btn-warning">
                                    Date of Creation <i class="fa-solid fa-calendar ms-1 me-2"></i> -
                                    {{ $product->created_at->format('M j Y') }}
                                </p>
                            </div>
                            {{-- <div class="p-2">
                            <a href="{{ route('product#editPage', $product->id) }}"
                                class="btn btn-outline-warning btn-block text-dark">
                                <i class="fa-solid fa-info ms-1 me-2"></i> Edit Your Product Info
                            </a>
                        </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
