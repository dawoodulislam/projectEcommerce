@extends('admin.master')

@section('body')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Order</h1>
    <a href="{{ route('manage-order') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Manage Order</a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($msg = Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $msg  }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Mobile Number</th>
                            <th>Total Order</th>
                            <th>Order Date</th>
                            <th>Payment Type</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key => $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->customer->number }}</td>
                            <td>{{ $order->order_total }}</td>
                            <td>{{ $order->order_date }}</td>
                            @foreach($payments as $key => $payment)
                            @if($payment->order_id == $order->id)
                            <td>{{ $payment->payment_method }}</td>
                            @endif
                            @endforeach
                            <td>{{ $order->payment_status }}</td>
                            <td>
                                <a href="{{ route('view-detail', ['id' => $order->id ]) }}" class="btn btn-sm btn-success">View Detail</a>
                                <a href="{{ route('view-invoice', ['id' => $order->id]) }}" class="btn btn-sm btn-success">View Order Invoice</a>
                                <a href="{{ route('download-invoice', ['id' => $order->id]) }}" class="btn btn-sm btn-success">Download Invoice</a>
                                <a href="{{ route('edit-order', ['id' => $order->id]) }}" class="btn btn-sm btn-success">Edit Order</a>
                                <a href="{{ route('delete-order', ['id' => $order->id ]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are your sure to delete this order?');">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection