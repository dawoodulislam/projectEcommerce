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
                        Shipping Information Form
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('new-payment') }}" method="POST" class="form-horizontal">
                            @csrf

                            <div class="row form-group">
                                <label class="col-md-4">Name</label>
                                <div class="col-md-8">
                                    <input type="text" value="{{ $customer->name }}" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-4">Email</label>
                                <div class="col-md-8">
                                    <input type="email" value="{{ $customer->email }}" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-4">Mobile</label>
                                <div class="col-md-8">
                                    <input type="number" name="number" value="{{ $customer->number }}" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-4">Address</label>
                                <div class="col-md-8">
                                    <textarea name="address" class="form-control">{{ $customer->address }}</textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-4"></label>
                                <div class="col-md-8">
                                    <input type="submit" name="btn" value="Save Shipping Info" class="btn btn-success">
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