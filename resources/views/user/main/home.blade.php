@extends('user.layouts.master')

@section('title', 'Shop')

@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Category Start -->
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">
                        Choose category
                    </span>
                </h5>
                <div class="bg-light p-4 mb-30">
                    <nav class="nav nav-pills flex-column">
                        <a class="flex-sm-fill text-sm-center nav-link" aria-current="page" href="{{ route('user#home') }}">
                            Show all categories
                        </a>
                        @foreach ($categories as $category)
                            <a class="flex-sm-fill text-sm-center nav-link" aria-current="page"
                                href="{{ route('user#categoryFilter', $category->id) }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </nav>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-4">
                        <a href="{{ route('cart#list') }}">
                            <button type="button" class="btn btn-warning rounded position-relative">
                                <i class="fa fa-shopping-cart"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count($cart) }}
                                </span>
                            </button>
                        </a>
                        <a href="{{ route('order#history') }}" class="ms-3">
                            <button type="button" class="btn btn-warning rounded position-relative">
                                <i class="fa-solid fa-clock-rotate-left me-2"></i> Order History
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count($orders) }}
                                </span>
                            </button>
                        </a>
                    </div>
                    <div class="col-4 offset-4 pb-1 mb-3">
                        <select name="productSorting" id="sortingOption" class="form-select">
                            <option value="">Choose Sorting Options</option>
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>
                </div>
                <div class="row" id="productList">
                    @if (count($products) != 0)
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/' . $product->image) }}">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href="#">
                                                <i class="fa fa-shopping-cart"></i>
                                            </a>
                                            <a class="btn btn-outline-dark btn-square"
                                                href="{{ route('product#details', [$product->id, $product->category_id]) }}">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-wrap"
                                            href="{{ route('product#details', [$product->id, $product->category_id]) }}">{{ $product->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $product->price }} mmk</h5>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="p-3 shadow mx-auto text-center text-capitalize fw-bold fs-1">
                            no product in this category!
                        </div>
                    @endif
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
@endsection


@push('scriptSource')
    <script>
        $(document).ready(function() {
            $("#sortingOption").on("change", function() {
                var sortingOption = $("#sortingOption").val();
                if (sortingOption === "asc") {
                    $.ajax({
                        type: "get",
                        url: "http://127.0.0.1:8000/ajax/pizzalist",
                        dataType: "json",
                        data: {
                            status: "asc",
                        },
                        success: function(response) {
                            var list = "";
                            // this empty string variable have to be declared out of loop
                            for (let i = 0; i < response.length; i++) {
                                const pizza = response[i];
                                list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/${pizza.image}') }}">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                                <a class="btn btn-outline-dark btn-square" href="">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${pizza.name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${pizza.price} mmk</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                                $("#productList").html(list);
                            }
                        },
                    });
                } else if (sortingOption == "desc") {
                    $.ajax({
                        type: "get",
                        url: "http://127.0.0.1:8000/ajax/pizzalist",
                        dataType: "json",
                        data: {
                            status: "desc",
                        },
                        success: function(response) {
                            var list = "";
                            // this empty string variable have to be declared out of loop
                            for (let i = 0; i < response.length; i++) {
                                const pizza = response[i];
                                list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/${pizza.image}') }}">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                                <a class="btn btn-outline-dark btn-square" href="">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${pizza.name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${pizza.price} mmk</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                                $("#productList").html(list);
                            }
                        },
                    });
                }
            });
        });
    </script>
@endpush
