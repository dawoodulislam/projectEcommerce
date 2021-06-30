@extends('admin.master')

@section('body')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Product Detail</h1>
    <a href="{{ route('manage-product') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Manage Product</a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Product name</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>Product Category</th>
                        <td>{{ $product->category->name }}</td>
                    </tr>
                    <tr>
                        <th>Product Brand</th>
                        <td>{{ $product->brand->name }}</td>
                    </tr>
                    <tr>
                        <th>Product Code</th>
                        <td>{{ $product->code }}</td>
                    </tr>
                    <tr>
                        <th>Product Price</th>
                        <td>{{ $product->price }}</td>
                    </tr>
                    <tr>
                        <th>Product Stock Amount</th>
                        <td>{{ $product->stock }}</td>
                    </tr>
                    <tr>
                        <th>Product Short Description</th>
                        <td>{{ $product->short_description }}</td>
                    </tr>
                    <tr>
                        <th>Product Long Description</th>
                        <td>{{ $product->long_description }}</td>
                    </tr>
                    <tr>
                        <th>Product Image</th>
                        <td>
                            <img src="{{ asset($product->image) }}" alt="img" width="100" height="80">
                        </td>
                    </tr>
                    <tr>
                        <th>Product Sub Images</th>
                        <td>
                            @foreach($product->subimage as $key => $subimage)
                            <img src="{{ asset($subimage->sub_image) }}" alt="img" width="80" height="60">
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Publication status</th>
                        <td>
                            {{ $product->status == 1 ? 'Published' : 'Unpublished' }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection