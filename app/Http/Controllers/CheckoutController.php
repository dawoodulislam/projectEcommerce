<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;

use Session;
use Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('front.checkout.checkout', [
            'categories' => Category::where('status', 1)->get()
        ]);
    }

    public function checkEmail()
    {
        $email = $_GET['email'];
        $customer = Customer::where('email', $email)->first();
        if ($customer) {
            $data = [
                'success' => true,
                'message' => "Sorry This email is already used"
            ];
        } else {
            $data = [
                'success' => false,
                'message' => "This email is available"
            ];
        }

        return json_encode($data);
    }

    public function addCustomer(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->number = $request->number;
        $customer->password = bcrypt($request->password);
        $customer->address = $request->address;
        $customer->save();

        Session::put('customer_id', $customer->id);
        Session::put('customer_name', $customer->name);

        return redirect('/billing-address')->with('message', 'Registration process completed successfully. Please provide Billing Address Information Carefully.');
    }

    public function billingInfo()
    {

        return view('front.checkout.billing-info', [
            'categories' => Category::where('status', 1)->get(),
            'customer' => Customer::find(Session::get('customer_id'))
        ]);
    }

    public function logOut(Request $request)
    {
        Session::forget('customer_id');
        Session::forget('customer_name');

        return redirect('/');
    }

    public function customerLogin(Request $request)
    {
        $customer = Customer::where('email', $request->email)->first();

        if ($customer) {
            if (password_verify($request->password, $customer->password)) {
                Session::put('customer_id', $customer->id);
                Session::put('customer_name', $customer->name);
                return redirect('/billing-address')->with('message', 'Logged in successfully. Please provide Billing Address Information Carefully.');
            } else {
                return redirect()->back()->with('message', 'Sorry Your Password is not matched');
            }
        } else {
            return redirect()->back()->with('message', 'Sorry Your email address is not matched');
        }
    }

    public function paymentOption(Request $request)
    {
        $shipping = new Shipping();
        $shipping->name = $request->name;
        $shipping->email = $request->email;
        $shipping->number = $request->number;
        $shipping->address = $request->address;
        $shipping->save();

        Session::put('shipping_id', $shipping->id);

        return redirect('/show-payment')->with('message', 'Shipping address save successfully. Add payment option to confirm order....');
    }

    public function payment()
    {
        return view('front.checkout.payment', [
            'categories' => Category::where('status', 1)->get()
        ]);
    }

    public function newOrder(Request $request)
    {
        $paymentMethod = $request->payment_method;

        if ($paymentMethod == 'cash') {

            $order = new Order();
            $order->customer_id = Session::get('customer_id');
            $order->shipping_id = Session::get('shipping_id');
            $order->order_total = Session::get('grand_total');
            $order->payment_status = 'Pending';
            $order->status = 'Pending';
            $order->order_date = date('Y-m-d');
            $order->save();

            $cartProducts = Cart::content();

            foreach ($cartProducts as $cartProduct) {

                $orderDetail = new OrderDetail();

                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $cartProduct->id;
                $orderDetail->product_name = $cartProduct->name;
                $orderDetail->product_image = $cartProduct->options->image;
                $orderDetail->product_price = $cartProduct->price;
                $orderDetail->product_qty = $cartProduct->qty;
                $orderDetail->save();

                Cart::remove($cartProduct->rowId);

                $product = Product::find($cartProduct->id);
                $product->stock = ($product->stock - $cartProduct->qty);
                $product->save();
            }

            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->payment_method = $paymentMethod;
            $payment->payment_amount = 0;
            $payment->payment_date = date('Y-m-d');
            $payment->save();

            Session::forget('grand_total');

            return redirect('/complete-order')->with('message', 'Your order placed successfully. Our representative will contact you soon..');
        } else if ($paymentMethod == 'bkash') {
        } else if ($paymentMethod == 'online') {
            return redirect('/online-payment');
        }
    }

    public function completeOrder()
    {
        return view('front.checkout.complete-order', [
            'categories' => Category::where('status', 1)->get()
        ]);
    }

    public function onlinePayment()
    {
        return view('front.checkout.online-payment', [
            'categories' => Category::where('status', 1)->get(),
            'customer' => Customer::find(Session::get('customer_id')),
            'tran_id'  => rand(1, 1000000000)
        ]);
    }

    public function confirmOrder(Request $request)
    {
        $order = new Order();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = Session::get('shipping_id');
        $order->order_total = Session::get('grand_total');
        $order->order_date = date('Y-m-d');
        $order->save();

        $cartProducts = Cart::content();

        foreach ($cartProducts as $cartProduct) {

            $orderDetail = new OrderDetail();

            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cartProduct->id;
            $orderDetail->product_name = $cartProduct->name;
            $orderDetail->product_image = $cartProduct->options->image;
            $orderDetail->product_price = $cartProduct->price;
            $orderDetail->product_qty = $cartProduct->qty;
            $orderDetail->save();

            Cart::remove($cartProduct->rowId);

            $product = Product::find($cartProduct->id);
            $product->stock = ($product->stock - $cartProduct->qty);
            $product->save();
        }

        $payment = new Payment();
        $payment->order_id = $order->id;
        $payment->payment_method = 'online';
        $payment->payment_amount = Session::get('grand_total');
        $payment->payment_date = date('Y-m-d');
        $payment->save();

        Session::forget('grand_total');

        return redirect('/complete-order')->with('message', 'Your order placed successfully. Our representative will contact you soon..');
    }
}
