@extends('admin.layouts.layout')
@section('title',"Orders")
@section('css')
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.css"/>
{{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.css"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.css"/> --}}
@endsection
@section('content')
<!-- Default box -->

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Orders</h3>
        <div class="card-tools">
            {{-- <a href="{{route('category.create')}}" class="btn btn-success">New Category</a> --}}
        </div>
    </div>
    <div class="card-body">
        {!! Form::model($data,['route'=>'order.index','method'=>'GET','class'=>'mb-3']) !!}
          <div class="row">
            <div class="col-sm-2">{{ Form::select('club',$clubs,null,['class'=>'form-control select2','id'=>'club','placeholder'=>'All Club','data-url'=>route('teamApi')]) }}</div>
            <div class="col-sm-2">{{ Form::select('team',$teams,null,['class'=>'form-control select2','id'=>'team','placeholder'=>'All Team']) }}</div>
            <div class="col-sm-2">{{ Form::text('player_name',null,['class'=>'form-control','placeholder'=>'Player Name']) }}</div>
            <div class="col-sm-2">{{ Form::text('product_title',null,['class'=>'form-control','placeholder'=>'Product Title']) }}</div>
            <div class="col-sm-1">{{ Form::number('per_page',null,['class'=>'form-control','placeholder'=>'Product perpage']) }}</div>
            <div class="col-sm-3">
                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
                {!! Form::hidden('startDate', null, ['id'=>'startDate']) !!}
                {!! Form::hidden('endDate', null, ['id'=>'endDate']) !!}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-1">{{ Form::submit('Find',array('class'=>'form-control btn btn-success')) }}</div>
          </div>

        {!! Form::close() !!}
        <div class="table-responsive">
        <table id="orders" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Refund</th>
                    <th>Fulfillment</th>
                    <th>Items</th>
                    {{-- <th>Delivery Method</th> --}}
                </tr>
            </thead>
            <tbody>
            @foreach($orders as $data)
                <tr>
                    <td>
                        <a href="{{ route('order.show', $data) }}" class="btn btn-success btn-xs"><i class="fas fa-eye"></i></a>
                    </td>
                    <td>#{{ $data->id }}</td>
                    <td><span data-toggle="tooltip" data-placement="top" title="{{ CustomHelper::prettyDateTime($data->created_at) }}">{{ CustomHelper::prettyDateS($data->created_at) }}</span></td>
                    <td>
                        <span data-toggle="tooltip" data-placement="top" title="{{ $data->customer->team->club->name}} : {{ $data->customer->team->name }}">
                            {{ $data->customer->first_name }} {{ $data->customer->last_name }}
                        </span>
                    </td>
                    <td>{{ $data->grand_total }}</td>
                    <td>
                        @if ($data->payment_status == 1)
                            <small class="badge badge-success"><i class="far fa-circle"></i> Paid</small>
                        @else
                            <small class="badge badge-warning"><i class="far fa-circle"></i> Unpaid</small>
                        @endif
                    </td>
                    <td>
                        @if ($data->refund_status == 2)
                            <small class="badge badge-success">Complite</small>
                        @elseif($data->refund_status == 1)
                            <small class="badge badge-warning">Requested</small>
                        @endif
                    </td>
                    <td>Unfulfilled</td>
                    <td>{{ $data->total_item_count }}</td>
                    {{-- <td>{{ $data->shipping_method }}</td> --}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center">{{ $orders->appends($_GET)->links() }}</div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection

@section('js')

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.js"></script>
{{-- <script type="text/javascript" src="//cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.js"></script> --}}
{{-- <script type="text/javascript" src="//cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/fh-3.1.8/r-2.2.7/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.js"></script> --}}
<script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"> </script>
<!-- daterangepicker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
(function ($) {
    $(document).ready(function() {
        $('#orders').DataTable( {
            dom: 'Bfrtip',
            "paging":   false,
            //"ordering": false,
        } );

    } );

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    //$('#club').change(function(){
    $('.card').on('load | change', '#club', function() {
        $.get($(this).data('url'), {
                option: $(this).val()
        },
        function(data) {
                var subcat = $('#team');
                subcat.empty();
                subcat.append("<option value=''>All Team</option>")
                $.each(data, function(index, element) {
                        subcat.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                });
        });
    });

    //Date range as a button
    $(function() {
        if($('#startDate').val() != '' && $('#endDate').val() != ''){
           var start = moment($('#startDate').val(), "MM-DD-YYYY");
            var end = moment($('#endDate').val(), "MM-DD-YYYY");
        }else{
            var start = moment();
            var end = moment();
        }

        //var start = $('#startDate').val();
        //var end = $('#endDate').val();
        //var start = moment().subtract(29, 'days');
        //var end = moment();
        //console.log(start);
        function cb(start, end) {
            $('#reportrange span').html(start.format('MM-DD-YYYY') + ' - ' + end.format('MM-DD-YYYY'));
            $('#startDate').val(start.format('MM-DD-YYYY'));
            $('#endDate').val(end.format('MM-DD-YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'This Year': [moment().startOf('year'), moment().endOf('year')],
            'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
            }
        }, cb);

        cb(start, end);

        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
            //do something, like clearing an input
            $('#reportrange span').html('');
            $('#startDate').val('');
            $('#endDate').val('');
        });

    });

})(jQuery)
</script>
@endsection
