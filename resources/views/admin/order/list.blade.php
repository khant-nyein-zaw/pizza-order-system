@extends('admin.layouts.master')

@section('title', 'Order List Page')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <form action="{{ route('order#filter') }}" method="get">
                            @csrf
                            <div class="input-group">
                                <select class="form-select" name="orderStatus">
                                    <option value="">Show All</option>
                                    <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending
                                    </option>
                                    <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept</option>
                                    <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                                </select>
                                <button class="btn btn-outline-primary" type="submit">Find</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Looping Orders -->
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User</th>
                                <th>Order Date</th>
                                <th>Order Code</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="tr-shadow" data-orderid="{{ $order->id }}">
                                    <td>{{ $order->user_id }}</td>
                                    <td class="desc">{{ $order->user_name }}</td>
                                    <td>{{ $order->created_at->format('j F Y') }}</td>
                                    <td>
                                        <a href="{{ route('order#details', $order->order_code) }}"
                                            class="text-info">{{ $order->order_code }}</a>
                                    </td>
                                    <td>{{ $order->total_price }} mmk</td>
                                    <td>
                                        <select class="form-select orderStatus">
                                            <option value="">Confirm Order!</option>
                                            <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Accept
                                            </option>
                                            <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Reject
                                            </option>
                                        </select>
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
    <script src="{{ asset('js/order_list.js') }}"></script>
@endpush
