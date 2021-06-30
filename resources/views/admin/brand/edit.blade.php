@extends('admin.master')

@section('body')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Brand</h1>
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
                <form action="{{ route('update-brand') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="form-label col-3">Brand Name</label>
                        <div class="col-9">
                            <input type="text" value="{{ $brand->name }}" class="form-control" name="name">
                            <input type="hidden" name="id" value="{{ $brand->id }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Brand Description</label>
                        <div class="col-9">
                            <textarea name="description" class="form-control">{{ $brand->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Publication Status</label>
                        <div class="col-9">
                            <label class="mr-2"><input type="radio" name="status" value="1" {{ $brand->status == 1 ? 'checked' : '' }} > Published</label>
                            <label><input type="radio" name="status" value="0" {{ $brand->status == 0 ? 'checked' : '' }} > Unpublished</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3"></label>
                        <div class="col-9">
                            <input type="submit" class="btn btn-primary" value="Update Brand" name="btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection