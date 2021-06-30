@extends('front.master')

@section('body')

<div class="men">
    <div class="container">
        <div class="col-12">
            <div class="panel panel-body">
                @if($msg = Session::get('message'))
                <h3 class="text-center" style="margin-bottom: 20px; color:crimson;">{{ $msg }}</h3>
                @endif
                <table class="table table-bordered table-hover" style="border: 1px solid lightgray;">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Product Price</th>
                            <th>Product Quantity</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        use Illuminate\Contracts\Session\Session;
                        use Illuminate\Support\Facades\Session as FacadesSession;

                        $sum = 0;
                        ?>
                        @foreach($cartProducts as $key => $cartProduct)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cartProduct->name }}</td>
                            <td>
                                <img src="{{ asset($cartProduct->options->image) }}" class="img-responsive" alt="img" width="40" height="50">
                            </td>
                            <td>{{ $cartProduct->price }}</td>
                            <td>
                                <form action="{{ route('update-cart-qty') }}" method="POST" class="form-inline">
                                    @csrf
                                    <input type="number" value="{{ $cartProduct->qty }}" name="qty" class="form-control" min="1">
                                    <input type="hidden" value="{{ $cartProduct->rowId }}" name="rowId">
                                    <input type="submit" value="Update" class="btn btn-info">
                                </form>
                            </td>
                            <td>{{ number_format($cartProduct->qty * $cartProduct->price) }}</td>
                            <td>
                                <a href="{{ route('remove-item', ['rowId' => $cartProduct->rowId]) }}" class="btn btn-danger">Remove</a>
                            </td>
                        </tr>
                        <?php
                        $sum = $sum + $cartProduct->qty * $cartProduct->price;
                        ?>
                        @endforeach
                    </tbody>
                </table>
                <hr style="border: 1px solid lightgray;">
                <?php
                $vat = 0;
                $shippingCost = 0;
                $grandTotal = 0;
                ?>
                <table class="table table-bordered table hovered" style="width: 40%; margin-left: 60%;border: 1px solid lightgray;">
                    <tr>
                        <th>Sub Total</th>
                        <td>{{ $sum }}</td>
                    </tr>
                    <tr>
                        <th>Vat / Tax</th>
                        <td>{{ number_format(round($vat = ($sum * 15)/ 100)) }}</td>
                    </tr>
                    <tr>
                        <th>Shipping Cost</th>
                        <td>{{ $shippingCost }}</td>
                    </tr>
                    <tr>
                        <th>Grand Total</th>
                        <td>
                            {{ $grandTotal = $sum + $vat + $shippingCost }}
                            <?php
                            // Session::put('grand_total', $grandTotal);
                            session(['grand_total' => $grandTotal]);
                            ?>
                        </td>
                    </tr>
                </table>
                <div style="margin-top: 15px;">
                    <a href="{{ route('/') }}" class="btn btn-success">Continue Shopping</a>
                    <?php
                    if ($cartItems == 0) {
                    ?>
                        <a href="" disabled class="btn btn-success pull-right">Check Out</a>
                        <?php
                    } else {
                        if (session('customer_id')) {
                        ?>
                            <a href="{{ route('billing-address') }}" class="btn btn-success pull-right">Check Out</a>
                        <?php
                        } else {
                        ?>
                            <a href="{{ route('checkout') }}" class="btn btn-success pull-right">Check Out</a>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection