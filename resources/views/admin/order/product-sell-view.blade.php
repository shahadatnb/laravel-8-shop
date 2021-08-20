@extends('admin.layouts.layout')
@section('title',"Order sell view")
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
    <div class="card-body">
        {!! Form::model($data,['route'=>'order.product.view','method'=>'GET','class'=>'mb-3']) !!}
          <div class="row">
            <div class="col-sm-2">{{ Form::select('product',$products,null,['class'=>'form-control select2','id'=>'product','placeholder'=>'Select Product']) }}</div>
            <div class="col-sm-2">{{ Form::select('size',$sizes,null,['class'=>'form-control select2','id'=>'size','placeholder'=>'Select Sizes']) }}</div>
            <div class="col-sm-2">{{ Form::select('color',$colors,null,['class'=>'form-control select2','id'=>'color','placeholder'=>'Select Colors']) }}</div>
            <div class="col-sm-1">{{ Form::number('per_page',null,['class'=>'form-control','placeholder'=>'Product perpage']) }}</div>
            <div class="col-sm-3">
                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
                {!! Form::hidden('startDate', null, ['id'=>'startDate']) !!}
                {!! Form::hidden('endDate', null, ['id'=>'endDate']) !!}
            </div>
            <div class="col-sm-1">{{ Form::submit('Find',array('class'=>'form-control btn btn-success')) }}</div>
          </div>

        {!! Form::close() !!}
        <div class="table-responsive">
        <table id="orders" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Date</th>
                    <th>Customer</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $item)
                <tr>
                    <td>#{{$item->id}}</td>
                    <td><span data-toggle="tooltip" data-placement="top" title="{{ CustomHelper::prettyDateTime($item->created_at) }}">{{ CustomHelper::prettyDateS($item->created_at) }}</span></td>
                    <td>{{ $item->customer->first_name }} {{ $item->customer->last_name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        {{-- <div class="text-center">{{ $orders->appends($_GET)->links() }}</div> --}}
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
    $('.card').on('load | change', '#product', function() {
        $.get('{{route('productSize')}}', {
                option: $(this).val()
        },
        function(data) {
            console.log(data);
                var size = $('#size');
                size.empty();
                size.append("<option value=''>Select Size</option>")
                $.each(data, function(index, element) {
                    size.append("<option value='"+ element +"'>" + element + "</option>");
                });
        });

        $.get('{{route('productColor')}}', {
                option: $(this).val()
        },
        function(data) {
            console.log(data);
                var color = $('#color');
                color.empty();
                color.append("<option value=''>Select Color</option>")
                $.each(data, function(index, element) {
                    color.append("<option value='"+ element +"'>" + element + "</option>");
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
