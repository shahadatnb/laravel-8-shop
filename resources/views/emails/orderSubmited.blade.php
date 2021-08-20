<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>{{ config('app.name', 'Laravel') }}</title>
	</head>
	<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="padding: 0;">
		<div id="wrapper" dir="ltr" style="background-color: #f7f7f7; margin: 0; padding: 70px 0; width: 100%; -webkit-text-size-adjust: none;">
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
				<tr>
					<td align="center" valign="top">
						<div id="template_header_image">
													</div>
						<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container" style="background-color: #ffffff; border: 1px solid #dedede; box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1); border-radius: 3px;">
							<tr>
								<td align="center" valign="top">
									<!-- Header -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_header" style='background-color: #96588a; color: #ffffff; border-bottom: 0; font-weight: bold; line-height: 100%; vertical-align: middle; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; border-radius: 3px 3px 0 0;'>
										<tr>
											<td id="header_wrapper" style="padding: 36px 48px; display: block;">
												<h1 style='font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 30px; font-weight: 300; line-height: 150%; margin: 0; text-align: left; text-shadow: 0 1px 0 #ab79a1; color: #ffffff; background-color: inherit;'>Thank you for your order</h1>
											</td>
										</tr>
									</table>
									<!-- End Header -->
								</td>
							</tr>
							<tr>
								<td align="center" valign="top">
									<!-- Body -->
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body">
										<tr>
											<td valign="top" id="body_content" style="background-color: #ffffff;">
												<!-- Content -->
												<table border="0" cellpadding="20" cellspacing="0" width="100%">
													<tr>
														<td valign="top" style="padding: 48px 48px 32px;">
															<div id="body_content_inner" style='color: #636363; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 14px; line-height: 150%; text-align: left;'>

<p style="margin: 0 0 16px;">Hi {{ $order->customer_first_name.' '.$order->customer_last_name }},</p>
<p style="margin: 0 0 16px;">Just to let you know — we've received your order #{{ $order->id }}, and it is now being processed:</p>

{{-- <p style="margin: 0 0 16px;">Pay with cash upon delivery.</p> --}}


<h2 style='color: #96588a; display: block; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 130%; margin: 0 0 18px; text-align: left;'>
	[Order #{{ $order->id }}] ({{ CustomHelper::prettyDate($order->created_at) }})</h2>

<div style="margin-bottom: 40px;">
	<table class="td" cellspacing="0" cellpadding="6" border="1" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
		<thead>
			<tr>
				<th class="td" scope="col" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; padding: 12px; text-align: left;">Product</th>
				<th class="td" scope="col" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; padding: 12px; text-align: left;">Quantity</th>
				<th class="td" scope="col" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; padding: 12px; text-align: left;">Price</th>
			</tr>
		</thead>
		<tbody>
            @foreach ($order->orderItems as $item)                
            <tr class="order_item">
                <td class="td" style="color: #636363; border: 1px solid #e5e5e5; padding: 12px; text-align: left; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap: break-word;">
                {{ $item->name }}</td>
                <td class="td" style="color: #636363; border: 1px solid #e5e5e5; padding: 12px; text-align: left; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
                {{ $item->qty_ordered }}</td>
                <td class="td" style="color: #636363; border: 1px solid #e5e5e5; padding: 12px; text-align: left; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
                    <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{config('settings.currencySymbol')}}</span>{{$item->total}}</span>		</td>
            </tr>
            @endforeach
	
		</tbody>
		<tfoot>
								<tr>
						<th class="td" scope="row" colspan="2" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; padding: 12px; text-align: left; border-top-width: 4px;">Subtotal:</th>
						<td class="td" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; padding: 12px; text-align: left; border-top-width: 4px;"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{config('settings.currencySymbol')}}</span>{{$order->sub_total}}</span></td>
					</tr>
										<tr>
						<th class="td" scope="row" colspan="2" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; padding: 12px; text-align: left;">Shipping:</th>
						<td class="td" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; padding: 12px; text-align: left;">
<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{config('settings.currencySymbol')}}</span>5.00</span> <small class="shipped_via">via Flat rate</small>
</td>
					</tr>
										<tr>
						<th class="td" scope="row" colspan="2" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; padding: 12px; text-align: left;">Payment method:</th>
						<td class="td" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; padding: 12px; text-align: left;">Cash on delivery</td>
					</tr>
										<tr>
						<th class="td" scope="row" colspan="2" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; padding: 12px; text-align: left;">Total:</th>
						<td class="td" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; padding: 12px; text-align: left;"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{config('settings.currencySymbol')}}</span>{{$order->grand_total}}</span></td>
					</tr>
							</tfoot>
	</table>
</div>


<table id="addresses" cellspacing="0" cellpadding="0" border="0" style="width: 100%; vertical-align: top; margin-bottom: 40px; padding: 0;">
	<tr>
		<td valign="top" width="50%" style="text-align: left; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; border: 0; padding: 0;">
			<h2 style='color: #96588a; display: block; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 130%; margin: 0 0 18px; text-align: left;'>Billing address and Shipping address</h2>
			<address class="address" style="padding: 12px; color: #636363; border: 1px solid #e5e5e5;">
                {{$order->shippingAddress->first_name}} {{$order->shippingAddress->last_name}}<br>
                {{$order->shippingAddress->address1}} 
                    @if ($order->shippingAddress->address1 != '')
                        {{$order->shippingAddress->address2}}
                    @endif <br>
                {{$order->shippingAddress->city}}, {{$order->shippingAddress->state}} - {{$order->shippingAddress->postcode}}<br>
                <br><a href="tel:01757839516" style="color: #96588a; font-weight: normal; text-decoration: underline;">{{$order->shippingAddress->phone}}</a>
                <br>{{$order->shippingAddress->email}}
            </address>
		</td>
        {{--
        <td valign="top" width="50%" style="text-align: left; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; padding: 0;">
        <h2 style='color: #96588a; display: block; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 130%; margin: 0 0 18px; text-align: left;'>Shipping address</h2>
            <address class="address" style="padding: 12px; color: #636363; border: 1px solid #e5e5e5;">
                Shahadat Hosain<br>Asiancoder.com<br>Nawdapara<br>Rajshahi<br>Rajshahi<br>Bangladesh
            </address>
        </td>
        --}}
    </tr>
</table>
<p style="margin: 0 0 16px;">Thanks for using {{ config('app.name', 'Laravel') }}!</p>
															</div>
														</td>
													</tr>
												</table>
												<!-- End Content -->
											</td>
										</tr>
									</table>
									<!-- End Body -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="center" valign="top">
						<!-- Footer -->
						<table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer">
							<tr>
								<td valign="top" style="padding: 0; border-radius: 6px;">
									<table border="0" cellpadding="10" cellspacing="0" width="100%">
										<tr>
											<td colspan="2" valign="middle" id="credit" style='border-radius: 6px; border: 0; color: #8a8a8a; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 12px; line-height: 150%; text-align: center; padding: 24px 0;'>
												<p style="margin: 0 0 16px;">{{ config('app.name', 'Laravel') }}</p>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<!-- End Footer -->
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>
