@extends('admin.layouts.master')

@section('title', 'Order Details')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-6 offset-3">
                <!-- Card -->
                <div class="card text-bg-success">
                    <div class="card-header text-center">
                        <h3>Ordered User Info</h3>
                        <small class="text-dark">(Delivery Fee included)</small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                @if ($orderDetails[0]->user_image != null)
                                    <img src="{{ asset('storage/' . $orderDetails[0]->user_image) }}" class="img-fluid">
                                @else
                                    <img src="{{ asset('image/user.png') }}" class="img-fluid">
                                @endif
                            </div>
                            <div class="col-md-8 row">
                                <div class="col-6 d-flex justify-content-center align-items-end gap-3 flex-column">
                                    <span><i class="fa-solid fa-user-large me-2"></i> Name</span>
                                    <span><i class="fa-solid fa-barcode me-2"></i> Order Code</span>
                                    <span><i class="fa-solid fa-money-check me-2"></i> Total Bill</span>
                                    <span><i class="fa-solid fa-clock me-2"></i> Ordered Date</span>
                                </div>
                                <div class="col-6 d-flex justify-content-center align-items-start gap-3 flex-column">
                                    <p class="text-uppercase">{{ $orderDetails[0]->user_name }}</p>
                                    <p>{{ $orderDetails[0]->order_code }}</p>
                                    <p>{{ $totalPrice }} mmk</p>
                                    <p>{{ $orderDetails[0]->created_at->format('M j Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- Looping Orders -->
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Order Number</th>
                                <th>Product Name</th>
                                <th>Count</th>
                                <th>Total Amount</th>
                                <th>Date ordered</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetails as $o)
                                <tr class="tr-shadow">
                                    <td class="col-3">
                                        <img src="{{ asset('storage/' . $o->product_image) }}" class="img-fluid">
                                    </td>
                                    <td>{{ $o->id }}</td>
                                    <td>{{ $o->product_name }}</td>
                                    <td>{{ $o->quantity }}</td>
                                    <td>{{ $o->total_price }} mmk</td>
                                    <td>{{ $o->created_at->format('M j Y') }}</td>
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
