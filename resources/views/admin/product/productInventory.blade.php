@extends('admin.layouts.layout')
@section('title',"Products")
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
        {!! Form::model($data,['route'=>'product.inventory','method'=>'GET','class'=>'mb-3']) !!}
          <div class="row">
            <div class="col-sm-2">{{ Form::select('category_id',$categories,null,['class'=>'form-control select2','placeholder'=>'Select Category']) }}</div>
            {{-- <div class="col-sm-2">{{ Form::select('team',$teams,null,['class'=>'form-control select2','id'=>'team','placeholder'=>'All Team']) }}</div> --}}
            <div class="col-sm-2">{{ Form::number('per_page',null,['class'=>'form-control','placeholder'=>'Product perpage']) }}</div>
            <div class="col-sm-2">{{ Form::submit('Find',array('class'=>'form-control btn btn-success')) }}</div>
          </div>
        {!! Form::close() !!}
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Qty</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr id="{{ $product->id }}">
                        <td>{{ $product->id }}</td>
                        <td>
                            @if ($product->parent_id != null)
                                {{ $product->parent->title }} {{ $product->size }}  {{ $product->color }}
                            @else
                                {{ $product->title }}
                            @endif
                        </td>
                        <td>@if ($product->categories)
                            @foreach ($product->categories as $item)
                                <span class="badge bg-primary float-right mr-1">{{$item->title}}</span>
                            @endforeach
                            @endif
                        </td>
                        <td class="qty">{{ $product->qty }}</td>
                        <td>
                            <form action="{{ route('product.inventoryUpdate')}}" method="post" class="form-inline">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="checkbox" name="add" checked data-on-text="Add" data-off-text="Set" data-bootstrap-switch data-off-color="primary" data-on-color="success">
                                    <input type="number" class="form-control" name="quantity" id="" placeholder="Quantity">
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="button" value="Save" class="btn btn-success btn-sm">
                                </div>
                            </form>
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
<script src="{{ asset('assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script>
(function ($) {
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

    $(".form-inline").submit(function(e){
        return false;
    });

    $("input[type=button]").click(function(){
        var form = $(this).closest("form");
        //var add = form.find('input[name="add"]').val();
        //var qty = form.find('input[name="quantity"]').val();
        //var id = form.find('input[name="id"]').val();

        var tdqty =  $(this).closest("tr").find('td.qty');
        var tdqtyval = tdqty.text();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var formData = {
            //add: form.find('input[name="add"]').val(),
            //$( "input[type=checkbox][name=bar]:checked" ).val();
            add: form.find('input[name="add"]:checked').val(),
            quantity: form.find('input[name="quantity"]').val(),
            id: form.find('input[name="id"]').val(),
        };
        //console.log(form.find('input[name="add"]:checked').val());
        $.ajax({
            type: 'post',
            url: '{{ route('product.inventoryUpdate')}}',
            data: formData,
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                form.closest('td').find('span.text-danger').remove();
                tdqty.text(data.qty);
                form.find('input[name="quantity"]').val('');
            },
            error: function (data) {
                //console.log('Error:', data);
                    form.closest('td').find('span.text-danger').remove();
                    $.each(data.responseJSON.errors, function(key,value) {
                     $(form).parent().append('<span class="text-danger">'+value+'</span>'); //
                   });
            }
        });
        //console.log(tdqtyval);
    });

})(jQuery)
</script>
@endsection
