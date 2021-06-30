<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add()
    {
        return view('admin.product.add', [
            'categories' => Category::all(),
            'brands'     => Brand::all()
        ]);
    }

    public function manage()
    {
        return view('admin.product.manage', [
            'products' => Product::all()
        ]);
    }

    public function create(Request $request)
    {

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $imageName = time() . '-' . $imageName;
        $directory = 'product-image/';
        $image->move($directory, $imageName);
        $imageURL = $directory . $imageName;


        $product = new Product();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->code = $request->code;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->image = $imageURL;
        $product->status = $request->status;
        $product->save();

        $images = $request->file('sub_image');
        foreach ($images as $image) {

            $imageName = $image->getClientOriginalName();
            $imageName = time() . '-' . $imageName;
            $directory = 'product-sub-images/';
            $image->move($directory, $imageName);
            $imageURL = $directory . $imageName;

            $subimage = new SubImage();
            $subimage->product_id = $product->id;
            $subimage->sub_image = $imageURL;
            $subimage->save();
        }

        return redirect()->back()->with('message', 'Product Created Successfully');
    }

    public function detail($id)
    {
        return view('admin.product.detail', [
            'product' => Product::find($id)
        ]);
    }

    public function edit($id)
    {
        return view('admin.product.edit', [
            'product' => Product::find($id),
            'categories' => Category::all(),
            'brands'  => Brand::all()
        ]);
    }

    public function update(Request $request)
    {
        $product = Product::find($request->id);

        if ($image = $request->file('image')) {

            if (file_exists($product->image)) {
                unlink($product->image);
            }

            $imageName = $image->getClientOriginalName();
            $imageName = time() . '-' . $imageName;
            $directory = 'product-image/';
            $image->move($directory, $imageName);
            $imageURL = $directory . $imageName;
        } else {
            $imageURL = $product->image;
        }


        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->code = $request->code;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->image = $imageURL;
        $product->status = $request->status;
        $product->save();


        if ($images = $request->file('sub_image')) {
            $subImgs = SubImage::where('product_id', $product->id)->get();

            foreach ($subImgs as $subImg) {
                if (file_exists($subImg->sub_image)) {
                    unlink($subImg->sub_image);
                }
                $subImg->delete();
            }

            foreach ($images as $image) {
                $imageName = $image->getClientOriginalName();
                $imageName = time() . '-' . $imageName;
                $directory = 'product-sub-images/';
                $image->move($directory, $imageName);
                $imageURL = $directory . $imageName;

                $subimage = new SubImage();
                $subimage->product_id = $product->id;
                $subimage->sub_image = $imageURL;
                $subimage->save();
            }
        }

        return redirect('/manage-product')->with('message', 'Product Info Updated Successfully');
    }

    public function delete($id)
    {
        $product = Product::find($id);

        unlink($product->image);

        $subimages = SubImage::where('product_id', $product->id)->get();

        foreach ($subimages as $subimage) {
            unlink($subimage->sub_image);
            $subimage->delete();
        }

        $product->delete();

        return redirect('/manage-product')->with('message', 'Product Info Deleted Successfully');
    }
}
