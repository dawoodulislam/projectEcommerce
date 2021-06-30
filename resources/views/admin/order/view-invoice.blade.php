@extends('admin.master')

@section('body')

<style>
    .top_rw {
        background-color: #f4f4f4;
    }

    .td_w {}

    button {
        padding: 5px 10px;
        font-size: 14px;
    }

    .invoice-box {
        max-width: 890px;
        margin: auto;
        padding: 10px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 14px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
        border-bottom: solid 1px #ccc;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: middle;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        font-size: 12px;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
</style>

<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top_rw">
            <td colspan="2">
                <h2 style="margin-bottom: 0px;"> Invoice </h2>
                <span style=""> Order-Id: {{ $order->id }} Date: {{ $order->order_date }} </span>
            </td>
        </tr>

        <tr class="information">
            <td colspan="3">
                <table>
                    <tr>
                        <td colspan="2">
                            <b> Shipping Address: </b> <br>
                            {{ $shipping->name }} <br>
                            {{ $shipping->number }} <br>
                            {{ $shipping->email }} <br>
                            {{ $shipping->address }} <br>
                        </td>
                        <td> <b> Billing Address: </b><br>
                            {{ $customer->name }} <br>
                            {{ $customer->number }} <br>
                            {{ $customer->email }} <br>
                            {{ $customer->address }} <br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <td colspan="3">
            <table cellspacing="0px" cellpadding="2px">
                <tr class="heading">
                    <td style="width:25%;">
                        ITEM
                    </td>
                    <td style="width:10%; text-align:center;">
                        QTY.
                    </td>
                    <td style="width:10%; text-align:right;">
                        PRICE (TK)
                    </td>
                    <td style="width:15%; text-align:right;">
                        VAT RATE
                    </td>
                    <td style="width:15%; text-align:right;">
                        VAT AMOUNT (TK)
                    </td>
                    <td style="width:15%; text-align:right;">
                        TOTAL AMOUNT (TK)
                    </td>
                </tr>
                <?php
                $total_qty = 0;
                $total_price = 0;
                $total_vat = 0;
                ?>
                @foreach($products as $key => $product)
                <tr class="item">
                    <td style="width:25%;">
                        {{ $product->product_name }}
                    </td>
                    <td style="width:10%; text-align:center;">
                        {{ $product->product_qty }}
                        <?php $total_qty = $total_qty + $product->product_qty; ?>
                    </td>
                    <td style="width:10%; text-align:right;">
                        {{ $product->product_qty *  $product->product_price  }}
                        <?php $total_price = $total_price + ($product->product_qty *  $product->product_price); ?>
                    </td>
                    <td style="width:15%; text-align:right;">
                        15%
                    </td>
                    <td style="width:15%; text-align:right;">
                        {{ ($product->product_qty *  $product->product_price)* 0.15  }}
                        <?php $total_vat = $total_vat + (($product->product_qty *  $product->product_price) * 0.15); ?>
                    </td>
                    <td style="width:15%; text-align:right;">
                        {{ ($product->product_qty *  $product->product_price)* 1.15  }}
                    </td>
                </tr>
                @endforeach
                <tr class="item">
                    <td style="width:25%;"> <b> Grand Total </b> </td>
                    <td style="width:10%; text-align:center;">
                        {{ $total_qty }}
                    </td>
                    <td style="width:10%; text-align:right;">
                        {{ $total_price }}
                    </td>
                    <td style="width:15%; text-align:right;">
                    </td>
                    <td style="width:15%; text-align:right;">
                        {{ $total_vat }}
                    </td>
                    <td style="width:15%; text-align:right;">
                        {{ $order->order_total }}
                    </td>
                </tr>
        </td>
    </table>
    <tr class="total">
        <td colspan="3" align="right"> Total Amount in Words : <b>
                <?php
                $numberTransformer = $numberToWords->getNumberTransformer('en');
                echo $numberTransformer->toWords($order->order_total).' Tk only';
                ?>
            </b> </td>
    </tr>
    <tr>
        <td colspan="3">
            <table cellspacing="0px" cellpadding="2px">
                <tr>
                    <td width="50%">
                        <b> Declaration: </b> <br>
                        We declare that this invoice shows the actual price of the goods
                        described above and that all particulars are true and correct. The
                        goods sold are intended for end user consumption and not for resale.
                    </td>
                    <td>
                        * This is a computer generated invoice and does not
                        require a physical signature
                    </td>
                </tr>
                <tr>
                    <td width="50%">
                    </td>
                    <td>
                        <b> Authorized Signature </b>
                        <br>
                        <br>
                        ...................................
                        <br>
                        <br>
                        <br>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </table>
</div>


@endsection