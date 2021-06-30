@extends('admin.master')

@section('body')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add User</h1>
    <a href="{{ route('add-user') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add User</a>
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
                <form action="{{ route('create-user') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="form-label col-3">Name</label>
                        <div class="col-9">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Email</label>
                        <div class="col-9">
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Password</label>
                        <div class="col-9">
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Role</label>
                        <div class="col-9">
                            <select name="access_label" class="form-control">
                                <option>......Select Access Label.....</option>
                                <option value="1">Super Admin</option>
                                <option value="2">Admin</option>
                                <option value="3">Executive</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3"></label>
                        <div class="col-9">
                            <input type="submit" class="btn btn-primary" value="Create New User" name="btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection