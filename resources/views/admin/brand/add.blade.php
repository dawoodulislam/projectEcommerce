@extends('admin.master')

@section('body')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Brand</h1>
    <a href="{{ route('add-brand') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add Brand</a>
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
                <form action="{{ route('new-brand') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="form-label col-3">Brand Name</label>
                        <div class="col-9">
                            <input type="text" class="form-control" name="name">
                            <span>{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Brand Description</label>
                        <div class="col-9">
                            <textarea name="description" class="form-control"></textarea>
                            <span>{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Publication Status</label>
                        <div class="col-9">
                            <label class="mr-2"><input type="radio" name="status" value="1"> Published</label>
                            <label><input type="radio" name="status" value="0"> Unpublished</label>
                            <span class="d-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3"></label>
                        <div class="col-9">
                            <input type="submit" class="btn btn-primary" value="Create New Brand" name="btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection