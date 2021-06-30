@extends('admin.master')

@section('body')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Order</h1>
    <a href="{{ route('manage-order') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Manage Order</a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Order Info</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Total</th>
                            <th>Order Date</th>
                            <th>Order Payment Type</th>
                            <th>Order Payment Status</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->order_total }} Tk</td>
                            <td>{{ $order->order_date }}</td>
                            @foreach($payments as $key => $payment)
                            @if($payment->order_id == $order->id)
                            <td>{{ $payment->payment_method }}</td>
                            @endif
                            @endforeach
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ $order->status }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5>Order Customer Info</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Customer Mobile</th>
                            <th>Customer Email</th>
                            <th>Customer Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->customer->number }}</td>
                            <td>{{ $order->customer->email }}</td>
                            <td>{{ $order->customer->address }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5>Order Shipping Info</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Shipping Name</th>
                            <th>Shipping Mobile</th>
                            <th>Shipping Email</th>
                            <th>Shipping Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $order->shipping->name }}</td>
                            <td>{{ $order->shipping->number }}</td>
                            <td>{{ $order->shipping->email }}</td>
                            <td>{{ $order->shipping->address }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5> Order Payment Info</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Payment Type</th>
                            <th>Payment Amount</th>
                            <th>Payment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $key => $payment)
                        @if($payment->order_id == $order->id)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $payment->payment_method }}</td>
                            <td>{{ $payment->payment_amount }}</td>
                            <td>{{ $payment->payment_date }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5> Order Product Info</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td><img src="{{ asset($product->product_image) }}" alt="" height="50" width="60"></td>
                            <td>{{ $product->product_qty }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td>{{ number_format(($product->product_price * $product->product_qty) * 1.15) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Grand Total:</th>
                        <td>{{ $order->order_total }}</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection