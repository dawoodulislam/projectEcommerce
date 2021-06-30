<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubImage;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function index()
    {
        return view('front.home.home', [
            'products' => Product::where('status', 1)->orderBy('id', 'desc')->limit(4)->get(),
            'categories' => Category::where('status', 1)->get()
        ]);
    }

    public function categoryProduct($id)
    {

        return view('front.category.category-product', [
            'categories' => Category::where('status', 1)->get(),
            'products' => Product::where('category_id', $id)->orderBy('id', 'desc')->limit(4)->get(),
        ]);
    }

    public function productDetail($id)
    {
        $product = Product::find($id);

        return view('front.product.product-detail', [
            'categories' => Category::where('status', 1)->get(),
            'product' => $product,
            'subimages' => SubImage::where('product_id', $id)->get(),
            'related_products' => Product::where('category_id', $product->category_id)->where('status', 1)->orderBy('id', 'desc')->get()
        ]);
    }
}
