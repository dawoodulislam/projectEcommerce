<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::find($request->id);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $product->price,
            'weight' => 0,
            'options' =>
            [
                'image' => $product->image
            ]
        ]);

        return redirect('show-cart');
    }

    public function directAddToCart(Request $request)
    {
        $product = Product::find($request->id);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price,
            'weight' => 0,
            'options' =>
            [
                'image' => $product->image
            ]
        ]);

        return redirect('show-cart');
    }

    public function show()
    {
        return view('front.cart.show-cart', [
            'categories' => Category::where('status', 1)->get(),
            'cartProducts' => Cart::content(),
            'cartItems' => Cart::count()
        ]);
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect('show-cart')->with('message', 'Cart Item Removed Successfully');
    }

    public function update(Request $request)
    {
        Cart::update($request->rowId, $request->qty);
        return redirect('show-cart')->with('message', 'Cart Item Updated Successfully');
    }
}
