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
                <div class="panel panel-heading text-center" style="background-color: gray; color: white;">
                    To place order you have to login. If you have no account please register first.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading text-center" style="background-color: gray; color: white;">
                        Login Form
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('customer-login') }}" method="POST" class="form-horizontal">
                            @csrf

                            <div class="row form-group">
                                <label class="col-md-4">Email</label>
                                <div class="col-md-8">
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-4">Password</label>
                                <div class="col-md-8">
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-4"></label>
                                <div class="col-md-8">
                                    <input type="submit" name="btn" value="Login" class="btn btn-success">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading text-center" style="background-color: gray; color: white;">
                        Registration Form
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('new-customer') }}" method="POST" class="form-horizontal">
                            @csrf

                            <div class="row form-group">
                                <label class="col-md-4">Name</label>
                                <div class="col-md-8">
                                    <input type="name" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-4">Email</label>
                                <div class="col-md-8">
                                    <input type="email" onkeyup="checkEmailAddress(this.value)" name="email" class="form-control">
                                    <span id="checkEmailMsg"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-4">Mobile</label>
                                <div class="col-md-8">
                                    <input type="number" name="number" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-4">Password</label>
                                <div class="col-md-8">
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-4">Address</label>
                                <div class="col-md-8">
                                    <textarea name="address" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-4"></label>
                                <div class="col-md-8">
                                    <input type="submit" name="btn" id="regBtn" value="Registration" class="btn btn-success">
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