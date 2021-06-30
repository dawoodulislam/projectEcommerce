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
    </div>
</section>

@endsection