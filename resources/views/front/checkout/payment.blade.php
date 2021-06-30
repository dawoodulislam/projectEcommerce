@extends('front.master')

@section('body')

<section style="padding: 40px 0;">
    <div class="container">
        @if($msg = Session::get('message'))
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-heading text-center" style="background-color: gray; color: white;">
                    {{ $msg }}
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading text-center" style="background-color: gray; color: white;">
                        Payment Form
                    </div>
                    <div class="panel-body" style="border: 1px solid lightgrey;">
                        <form action="{{ route('new-order') }}" method="POST" class="form-horizontal">
                            @csrf

                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th><label for="cash" style="width: 100%;">Cash On delivery</label></th>
                                    <td><input type="radio" name="payment_method" class="form-control" value="cash" id="cash"></td>
                                </tr>
                                <tr>
                                    <th><label for="bkash" style="width: 100%;">BKash</label></th>
                                    <td><input type="radio" name="payment_method" class="form-control" value="bkash" id="bkash"></td>
                                </tr>
                                <tr>
                                    <th><label for="online" style="width: 100%;">Online</label></th>
                                    <td><input type="radio" name="payment_method" class="form-control" value="online" id="online"></td>
                                </tr>
                            </table>

                            <div class="row form-group">
                                <label class="col-md-4"></label>
                                <div class="col-md-8">
                                    <input type="submit" name="btn" value="Confirm Order" class="btn btn-success">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection