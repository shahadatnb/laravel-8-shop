@extends('admin.layouts.layout')
@section('title',"Tax Rate")
@section('css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.css"/>
{{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.css"/> --}}
@endsection
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tax Rate</h3>
        <div class="card-tools">
            <a href="{{route('taxrate.create')}}" class="btn btn-success"><i class="fas fa-plus-square"></i> New Tax rate</a>
        </div>
    </div>
    <div class="card-body">
        <table id="taxrates" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Identifier</th>
                    <th>Rate</th>
                    <th>Country</th>
                    <th>State</th>                    
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($taxrates as $key=>$data)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $data->identifier }}</td>
                    <td>{{ $data->tax_rate }}</td>
                    <td>{{ $data->country }}</td>
                    <td>{{ $data->state }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="">
                            <a href="{{ route('taxrate.edit', $data) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form class="delete" action="{{ route('taxrate.destroy',$data) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure To Delete This Item?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
@section('js')
 
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.js"></script>
{{-- <script type="text/javascript" src="//cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/fh-3.1.8/r-2.2.7/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.js"></script> --}}

<script>

    $(document).ready(function() {
        $('#taxrates').DataTable( {
            dom: 'Bfrtip',
            "paging":   true,
            //"ordering": false,
        } );

    } );
</script>
@endsection