@extends('user.layouts.master')

@section('title', 'Order History')

@section('content')
    <!-- Order Table Start -->
    <div class="container-fluid" style="min-height: 400px;">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($orders as $order)
                            <tr class="item">
                                <td class="align-middle">{{ $order->order_code }}</td>
                                <td class="align-middle">{{ $order->created_at->format('M j Y') }}</td>
                                <td class="align-middle">{{ $order->total_price }} mmk</td>
                                <td class="align-middle">
                                    @if ($order->status == 0)
                                        <span class="text-info">
                                            Pending <i class="fa-solid fa-spinner ms-2"></i>
                                        </span>
                                    @elseif ($order->status == 1)
                                        <span class="text-success">
                                            Order success <i class="fa-solid fa-check-double ms-2"></i>
                                        </span>
                                    @elseif ($order->status == 2)
                                        <span class="text-danger">
                                            Order is cancelled <i class="fa-solid fa-exclamation ms-2"></i>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Order Table End -->
@endsection
