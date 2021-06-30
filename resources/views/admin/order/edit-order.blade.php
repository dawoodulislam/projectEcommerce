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
                @if($message = Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message  }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form action="{{ route('update-order') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label class="form-label col-3">Order Status</label>
                        <div class="col-9">
                            <label class="mr-2"><input type="radio" name="order_status" value="Complete"> Complete</label>
                            <label class="mr-2"><input type="radio" name="order_status" value="Cancel"> Cancel</label>
                            <label><input type="radio" name="order_status" value="Pending"> Pending</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Payment Status</label>
                        <div class="col-9">
                            <label class="mr-2"><input type="radio" name="payment_status" value="Complete"> Complete</label>
                            <label class="mr-2"><input type="radio" name="payment_status" value="Cancel"> Cancel</label>
                            <label><input type="radio" name="payment_status" value="Pending"> Pending</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Receive Amount</label>
                        <div class="col-9">
                            <input type="text" name="order_total" readonly value="{{ $order->order_total }}" class="form-control">
                        </div>
                    </div>

                    <input type="hidden" name="id" value="{{ $order->id }}">

                    <div class="form-group row">
                        <label class="form-label col-3"></label>
                        <div class="col-9">
                            <input type="submit" class="btn btn-primary" value="Update Order Status" name="btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection