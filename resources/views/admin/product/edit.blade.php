@extends('admin.master')

@section('body')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
    <a href="{{ route('add-product') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add Product</a>
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
                <form action="{{ route('update-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="form-label col-3">Category Name</label>
                        <div class="col-9">
                            <select name="category_id" class="form-control">
                                <option>.....Select Category Name.....</option>
                                @foreach($categories as $key => $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Brand Name</label>
                        <div class="col-9">
                            <select name="brand_id" class="form-control">
                                <option>.....Select Brand Name.....</option>
                                @foreach($brands as $key => $brand)
                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Product Name</label>
                        <div class="col-9">
                            <input type="text" class="form-control" value="{{ $product->name }}" name="name">
                            <input type="hidden" value="{{ $product->id }}" name="id">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Product Code</label>
                        <div class="col-9">
                            <input type="text" class="form-control" value="{{ $product->code }}" name="code">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Product Price</label>
                        <div class="col-9">
                            <input type="number" class="form-control" value="{{ $product->price }}" name="price">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Product Stock Amount</label>
                        <div class="col-9">
                            <input type="number" class="form-control" value="{{ $product->stock }}" name="stock">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Short Description</label>
                        <div class="col-9">
                            <textarea name="short_description" class="form-control">{{ $product->short_description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Long Description</label>
                        <div class="col-9">
                            <textarea name="long_description" class="form-control">{{ $product->long_description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Main Image</label>
                        <div class="col-9">
                            <input type="file" accept="image/*" name="image" class="form-control-file">
                            <img src="{{ asset($product->image) }}" alt="img" width="60" height="50">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Sub Images</label>
                        <div class="col-9">
                            <input type="file" accept="image/*" multiple name="sub_image[]" class="form-control-file">
                            @foreach($product->subimage as $key => $subimage)
                            <img src="{{ asset($subimage->sub_image) }}" alt="img" width="60" height="50">
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3">Publication Status</label>
                        <div class="col-9">
                            <label class="mr-2"><input type="radio" name="status" value="1" {{ $product->status == 1 ? 'checked' : '' }}> Published</label>
                            <label><input type="radio" name="status" value="0" {{ $product->status == 0 ? 'checked' : '' }}> Unpublished</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-3"></label>
                        <div class="col-9">
                            <input type="submit" class="btn btn-primary" value="Update Product" name="btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection