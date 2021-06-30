@extends('admin.master')

@section('body')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manage Product</h1>
    <a href="{{ route('manage-product') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Manage Product</a>
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
                            <th>Product name</th>
                            <th>Product Category</th>
                            <th>Product Brand</th>
                            <th>Product Code</th>
                            <th>Product Price</th>
                            <th>Product Stock Amount</th>
                            <th>Product Image</th>
                            <th>Publication status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->brand->name }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <img src="{{ asset($product->image) }}" alt="img" width="50" height="50">
                            </td>
                            <td>{{ $product->status == 1 ? 'Published' : 'Unpublished' }}</td>
                            <td>
                                <a href="{{ route('product-detail', ['id' => $product->id ]) }}" class="btn btn-sm btn-success">view</a>
                                <a href="{{ route('edit-product', ['id' => $product->id ]) }}" class="btn btn-sm btn-success">Edit</a>
                                <a href="{{ route('delete-product', ['id' => $product->id]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure to Delete This?');">Delete</a>
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