<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ 'Invoice-'.sprintf("%07d", $order->id) }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->
    <style type="text/css">
        /*
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        */

        * {
            font-family: Verdana, Arial, sans-serif;
            font-size: x-small;
        }
        a {
            color: #fff;
            text-decoration: none;
        }

        body {
            display: grid;
            grid-template-rows: auto auto auto auto 30px;
        }

        .invoice table thead{
            background-color: #dde0e3;
        }

        .invoice table{
            clear:both;
        }
        .invoice table th{
            text-align: left;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 0px;
            border-spacing: 0;
            border-collapse: collapse;
            background-color: transparent;
        }
        .table thead  {
            text-align: left;
            display: table-header-group;
            vertical-align: middle;
        }
        .table th, .table td  {
            border: 1px solid #ddd;
            padding: 6px;
        }

        .footer {
            background-color: #60A7A6;
            color: #FFF;
        }

        table.base{
            margin: 15px 0;
            width: 100%;
        }

        table.base>td  {
            border: 0;
            padding: 0;
        }

    </style>

</head>
<body>
<table class="base">
    <tr>
        <td>
            @if(!empty(config('settings.appLogo')))
                <img height="80" src="{{ './storage/'.config('settings.appLogo') }}" alt="Logo">
            @else
                {{ config('settings.appTitle') }}
            @endif
        </td>
        <td style="text-align: right">Date: {{ CustomHelper::prettyDate($order->created_at) }}</td>
    </tr>
</table>

<table class="base">
    <tr>
    <td width="33.33%">
        From
        <address>
            <strong>{{ config('app.name') }}</strong><br>
            {{ config('settings.appAddress') }}<br>
            Phone: {{ config('settings.appPhone') }}<br>
            Email: {{ config('settings.appEmail') }}
        </address>
    </td>
    <td width="33.33%">
        To
        <address>
            <strong>{{$order->shippingAddress->first_name}} {{$order->shippingAddress->last_name}}</strong><br>
            {{$order->shippingAddress->address1}} @if ($order->shippingAddress->address1 != '')
                {{$order->shippingAddress->address2}}
            @endif <br>
            {{$order->shippingAddress->city}}, {{$order->shippingAddress->state}} {{$order->shippingAddress->postcode}}<br>
            Phone: {{$order->shippingAddress->phone}}<br>
            Email: {{$order->shippingAddress->email}}
        </address>
    </td>
    <td width="33.33%">
        <b>Invoice #{{sprintf("%07d", $order->id)}}</b><br>
        <br>
        <b>Order ID:</b> {{$order->id}}<br>
        <b>Payment Due:</b> {{ CustomHelper::prettyDate($order->created_at) }}<br>
    </td>
    </tr>
</table>

<div class="invoice">
    <table border="0" class="table table-striped" width="100%">
      <thead>
      <tr>
        <th>SL</th>
        <th colspan="2">Product Name</th>
        <th>Qty</th>
        {{-- <th>Serial #</th> --}}
        {{-- <th>Description</th> --}}
        <th>Subtotal</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($order->orderItems as $key=>$item)
            <tr>
                <td>{{++$key}}</td>
                <td><img width="80" src="{{$item->image}}" alt=""></td>
                <td>{{$item->name}}</td>
                <td>{{$item->qty_ordered}}</td>
                {{-- <td>455-981-221</td> --}}
                {{-- <td>El snort testosterone trophy driving gloves handsome</td> --}}
                <td>{{config('settings.currencySymbol')}}{{$item->total}}</td>
            </tr>
        @endforeach
      </tbody>
    </table>
</div>

<table class="base">
    <tr>
        <td>
            <div class="payment-method">
                <p class="lead">Payment Methods:</p>
                <img src="./assets/admin/img/credit/visa.png{{--asset('assets/admin/img/credit/visa.png')--}}" alt="Visa">
                <img src="./assets/admin/img/credit/mastercard.png" alt="Mastercard">
                <img src="./assets/admin/img/credit/american-express.png" alt="American Express">
                <img src="./assets/admin/img/credit/paypal2.png" alt="Paypal">
                <p class="lead">Amount Due {{ CustomHelper::prettyDate($order->created_at) }}</p>
            </div>
        </td>
        <td>
            <table class="table">
                <tr>
                    <th style="width:50%">Subtotal:</th>
                    <td>{{config('settings.currencySymbol')}}{{$order->sub_total}}</td>
                </tr>
                <tr>
                    <th>Tax</th>
                    <td>{{config('settings.currencySymbol')}}{{$order->tax_amount}}</td>
                </tr>
                <tr>
                    <th>Shipping:</th>
                    <td>{{config('settings.currencySymbol')}}{{$order->shipping_amount}}</td>
                </tr>
                <tr>
                    <th>Discount:</th>
                    <td>{{config('settings.currencySymbol')}}{{$order->discount_amount}}</td>
                </tr>
                <tr>
                    <th>Total:</th>
                    <td>{{config('settings.currencySymbol')}}{{$order->grand_total}}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
{{--
<div class="footer">
    <table>
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} {{ config('app.name') }} - All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
                {{ config('settings.appSlogan','') }}
            </td>
        </tr>
    </table>
</div>
--}}
</body>
</html>
