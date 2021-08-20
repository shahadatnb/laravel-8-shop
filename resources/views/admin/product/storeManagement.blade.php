@extends('admin.layouts.layout')
@section('title',"Store Managemant")
@section('css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.css"/>
@endsection
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        @if ($profile)
            <div class="row">
                <div class="col-sm-6">
                    @if($profile->banner != '')
                        <img src="{{ asset('storage/'.$profile->banner)}}" class="img-thumbnail" alt="...">
                    @endif
                </div>
                <div class="col-sm-6 my-auto">
                    <div class="">
                        {!! Form::open(array('route'=>'storeManagement','enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('id', $profile->id) !!}
                        <div class="row">
                            <div class="col-6">
                                {!! Form::file('banner',null,['class'=>'form-control','required'=>'required','placeholder'=>'Banner','accept'=>'image/*']) !!}
                            </div>
                            <div class="col-6">
                                {{ Form::submit('Upload', ['class'=>'btn btn-success']) }}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        @endif
    </div>
    <div class="card-body">
        @include('admin.layouts._message')
        {!! Form::model($data,['route'=>'storeManagement','method'=>'GET','class'=>'mb-3']) !!}
          <div class="row">
            <div class="col-sm-2">{{ Form::select('club',$clubs,null,['class'=>'form-control select2','id'=>'club_id','placeholder'=>'All Club','data-url'=>route('teamApi')]) }}</div>
            <div class="col-sm-2">{{ Form::select('team',$teams,null,['class'=>'form-control select2','id'=>'team','placeholder'=>'All Team']) }}</div>
            {{-- <div class="col-sm-2">{{ Form::select('category',$categories,null,['class'=>'form-control select2','placeholder'=>'Category']) }}</div>
            <div class="col-sm-2">{{ Form::text('product_title',null,['class'=>'form-control','placeholder'=>'Product Title']) }}</div> --}}
            <div class="col-sm-1">{{ Form::number('per_page',null,['class'=>'form-control','placeholder'=>'Product perpage']) }}</div>
            <div class="col-sm-2">{{ Form::submit('Find',array('class'=>'form-control btn btn-success')) }}</div>
          </div>
        {!! Form::close() !!}
        <div class="table-responsive">
        <table id="products" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Club</th>
                    <th>Store</th>
                    <th>Categories</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->store->club->name }}</td>
                    <td>{{ $item->store->name }}</td>
                    <td>
                        @foreach ($item->categories as $cat)
                        <a href="#" class="badge badge-primary">{{ $cat->title }}</a>
                        @endforeach
                    </td>
                    <td>
                        @if ($item->trashed())
                            <a href="{{ route('product.restore', $item) }}" class="btn btn-warning btn-sm">Restore</a>
                            <a href="{{ route('product.permanentdelete', $item) }}" onclick="return confirm('Are You Sure To Delete This Item?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                        @else
                            <a href="{{ route('product.edit', $item) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form class="delete" action="{{ route('product.destroy',$item) }}" method="post">
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
        @if ($products)
            <div class="text-center">{{ $products->appends($_GET)->links() }}</div>
        @endif
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

    $(document).ready( function(){
        //$('#club_id').change(function(){
        $('.card').on('load | change', '#club_id', function() {
            //console.log($(this).val());
            $.get($(this).data('url'), {
                    option: $(this).val()
            },
            function(data) {
                    var subcat = $('#team');
                    subcat.empty();
                    //console.log(data);
                    subcat.append("<option value=''>All Team</option>")
                    $.each(data, function(index, element) {
                            subcat.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                    });
            });
        });
    });
})(jQuery)
</script>
@endsection
