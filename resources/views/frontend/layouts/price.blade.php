@if ($item->special_price > 0)
    <h4><span class="_sell">{{config('settings.currencySymbol')}}{{ $item->special_price }}</span> <del class="_peSell">{{config('settings.currencySymbol')}}{{ $item->price }} </del></h4>
@else
    <h4><span class="_sell">{{config('settings.currencySymbol')}}{{ $item->price }}</span></h4>
@endif
