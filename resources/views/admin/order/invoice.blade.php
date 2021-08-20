@extends('admin.layouts.layout')
@section('title',"Invoice")
@section('content')
<div class="row">
    <div class="col-12">
      <div class="callout callout-info d-print-none">
        <h5><i class="fas fa-info"></i> Note:</h5>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
      </div>


      <!-- Main content -->
      <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
          <div class="col-12">
            <h4>
              <img src="{{ asset('storage/'.config('settings.appLogo')) }}" alt="Logo"> {{-- config('settings.appTitle') --}}
              <small class="float-right">Date: {{ CustomHelper::prettyDate($order->created_at) }}</small>
            </h4>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            From
            <address>
              <strong>{{ config('app.name') }}</strong><br>
              {{ config('settings.appAddress') }}<br>
              Phone: {{ config('settings.appPhone') }}<br>
              Email: {{ config('settings.appEmail') }}
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
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
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>Invoice #{{sprintf("%07d", $order->id)}}</b><br>
            <br>
            <b>Order ID:</b> {{$order->id}}<br>
            <b>Payment Due:</b> {{ CustomHelper::prettyDate($order->created_at) }}<br>
            {{-- <b>Account:</b> 968-34567 --}}
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-striped">
              <thead>
              <tr>
                <th>SL</th>
                <th>Product</th>
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
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <!-- accepted payments column -->
          <div class="col-6">
            @include('admin.layouts._message')
            {!! Form::model($order,['route'=>['order.update',$order], 'class'=>'no-print', 'method'=>'PUT']) !!}
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  {{ Form::label('status','Status') }}
                  {{ Form::select('status',$status,null,array('class'=>'form-control select2','placeholder'=>'Status')) }}
                </div>
              </div>
              <div class="col-6">
                
              </div>
            </div>
            <div class="col-12">
              <div class="btn-group">
                <a href="javascript:void(0);" onclick="window.print();" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                
                <a href="{{route('order.invoice.pdf',$order->id)}}" class="btn btn-primary">
                  <i class="fas fa-download"></i> Generate PDF
                </a>
                <button type="submit" class="btn btn-success">
                  <i class="far fa-credit-card"></i> Submit      
                </button>
              </div>
            </div>            
            {!! Form::close() !!}
          </div>
          <!-- /.col -->
          <div class="col-6">
            <p class="lead">Amount Due {{ CustomHelper::prettyDate($order->created_at) }}</p>

            <div class="table-responsive">
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
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->        
      </div>
      <!-- /.invoice -->
    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection
