<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\Shipping;
use Illuminate\Http\Request;
use NumberToWords\NumberToWords;

use PDF;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::all();
        return view('admin.order.manage', [
            'orders' => $order,
            'payments' => Payment::all()
        ]);
    }

    public function viewDetail($id)
    {
        $order = Order::find($id);
        return view('admin.order.detail', [
            'order' => $order,
            'payments' => Payment::all(),
            'products' => OrderDetail::where('order_id', $order->id)->get()
        ]);
    }

    public function viewInvoice($id)
    {
        $order = Order::find($id);

        return view('admin.order.view-invoice', [
            'order' => $order,
            'payments' => Payment::all(),
            'products' => OrderDetail::where('order_id', $order->id)->get(),
            'customer' => Customer::where('id', $order->customer_id)->first(),
            'shipping' => Shipping::where('id', $order->shipping_id)->first(),
            'numberToWords' => new NumberToWords()
        ]);
    }

    public function downloadInvoice($id)
    {
        $order = Order::find($id);

        // return view('admin.order.download-invoice', []);

        $pdf = PDF::loadView('admin.order.download-invoice', [
            'order' => $order,
            'payments' => Payment::all(),
            'products' => OrderDetail::where('order_id', $order->id)->get(),
            'customer' => Customer::where('id', $order->customer_id)->first(),
            'shipping' => Shipping::where('id', $order->shipping_id)->first(),
            'numberToWords' => new NumberToWords()
        ]);

        return $pdf->download('invoice.pdf');
    }

    public function editOrder($id)
    {
        $order = Order::find($id);
        return view('admin.order.edit-order', [
            'order' => $order
        ]);
    }

    public function updateOrder(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = $request->order_status;
        $order->payment_status = $request->payment_status;
        $order->save();

        if ($request->payment_status == 'Complete') {
            $payment = Payment::where('order_id', $request->id)->first();
            $payment->payment_amount = $request->order_total;
            $payment->payment_date = date('Y-m-d');
            $payment->save();
        } else if (($request->payment_status == 'Cancel') || ($request->payment_status == 'Pending')) {
            $payment = Payment::where('order_id', $request->id)->first();
            $payment->payment_amount = 0;
            $payment->payment_date = date('Y-m-d');
            $payment->save();
        }


        return redirect('/manage-order')->with('message', 'Order status updated successfully');
    }

    public function deleteOrder($id)
    {
        $order = Order::find($id);

        $orderdetails = OrderDetail::where('order_id', $id)->get();
        foreach ($orderdetails as $orderdetail) {
            $orderdetail->delete();
        }

        $payment = Payment::where('order_id', $id)->first();
        $payment->delete();

        $order->delete();

        return redirect('/manage-order')->with('message', 'Order Deleted Successfully');
    }
}
