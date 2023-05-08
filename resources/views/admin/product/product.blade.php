@extends('admin.layouts.layout')
@section('title',"Products")
@section('css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.css"/>
@endsection
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Products</h3>
        <div class="card-tools">
            <a href="{{route('product.create')}}" class="btn btn-success">New Products</a>
        </div>
    </div>
    <div class="card-body">
        @include('admin.layouts._message')
        @if(request()->routeIs('product.index'))
        {!! Form::model($data,['route'=>'product.index','method'=>'GET','class'=>'mb-3']) !!}
          <div class="row">
            <div class="col-sm-2">{{ Form::select('category',$categories,null,['class'=>'form-control select2','placeholder'=>'Category']) }}</div>
           <div class="col-sm-2">{{ Form::text('product_title',null,['class'=>'form-control','placeholder'=>'Product Title']) }}</div>
            <div class="col-sm-1">{{ Form::number('per_page',null,['class'=>'form-control','placeholder'=>'Product perpage']) }}</div>
            <div class="col-sm-2">{{ Form::submit('Find',array('class'=>'form-control btn btn-success')) }}</div>
          </div>
        {!! Form::close() !!}
        @endif
        <div class="table-responsive">
        <table id="products" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->title }}</td>
                    <td>@if ($product->categories)
                        @foreach ($product->categories as $item)
                            <span class="badge bg-primary float-right mr-1">{{$item->title}}</span>
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if ($product->trashed())
                            <a href="{{ route('product.restore', $product) }}" class="btn btn-warning btn-sm">Restore</a>
                            <a href="{{ route('product.permanentdelete', $product) }}" onclick="return confirm('Are You Sure To Delete This Item?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                        @else
                            <a href="{{ route('product.edit', $product) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form class="delete" action="{{ route('product.destroy',$product) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure To Delete This Item?')"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center">{{ $products->appends($_GET)->links() }}</div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection
@section('js')

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.js"></script>
<script>
(function ($) {

    $(document).ready(function() {
        $('#products').DataTable( {
            dom: 'Bfrtip',
            "paging":   false,
            //"ordering": false,
        } );

    } );
})(jQuery)
</script>
@endsection
