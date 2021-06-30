@extends('admin.master')

@section('body')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manage Category</h1>
    <a href="{{ route('manage-category') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Manage Category</a>
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
                            <th>Category name</th>
                            <th>Category description</th>
                            <th>Publication status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $key => $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->status == 1 ? 'Published' : 'Unpublished' }}</td>
                            <td>
                                <a href="{{ route('edit-category', ['id'=> $category->id ]) }}" class="btn btn-sm btn-success">Edit</a>
                                <a href="{{ route('delete-category', ['id' => $category->id ]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are your sure to delete this category?');">Delete</a>
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