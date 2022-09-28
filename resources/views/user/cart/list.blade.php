@extends('user.layouts.master')

@section('title', 'Cart List')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $cartItem)
                            <tr class="item" data-userid="{{ Auth::user()->id }}"
                                data-productid="{{ $cartItem->product_id }}" data-cartid="{{ $cartItem->id }}">
                                <td class="align-middle col-2">
                                    <img src="{{ asset('storage/' . $cartItem->product_image) }}" class="img-fluid">
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center align-items-center flex-column gap-1">
                                        <h6 class="fw-bold text-capitalize">
                                            {{ $cartItem->product_name }}
                                        </h6>
                                    </div>
                                </td>
                                <td class="align-middle price">{{ $cartItem->product_price }} mmk</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $cartItem->quantity }}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle col-2 multipliedResult">
                                    {{ $cartItem->product_price * $cartItem->quantity }} mmk</td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-danger" type="button">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Cart Summary</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{ $subTotal }} mmk</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Deliver Fee</h6>
                            <h6 class="font-weight-medium">500 mmk</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="total">{{ $subTotal += 500 }} mmk</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="checkOutBtn">
                            Proceed To Checkout
                        </button>
                        <button class="btn btn-block btn-danger font-weight-bold py-3" id="clearCartBtn">
                            Clear Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@push('scriptSource')
    <script src="{{ asset('js/cart.js') }}"></script>
@endpush
