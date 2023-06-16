@extends('admin.layouts.layout')
@section('title',"Homepage Settings")
@section('css')

@endsection
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <a href="{{ route('homepage.index')}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
        <div class="card-tools">
            <a href="{{ route('homepage.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> New</a>
        </div>
    </div>
    <div class="card-body">
        @if ($mode=='edit')
            {!! Form::model($homepage,['route'=>['homepage.update',$homepage], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
        @else
            {!! Form::open(array('route'=>'homepage.store','enctype'=>'multipart/form-data')) !!}
        @endif
        
        @include('admin.layouts._message')
            <div class="form-group row">
                {{ Form::label('title','Title',['class'=>'col-sm-3 col-form-label']) }}
                {{ Form::text('title',null,array('class'=>'form-control col-sm-9','required'=>'','maxlenth'=>'255')) }}
            </div>
            <div class="form-group row">
                {{ Form::label('sl','Serial',['class'=>'col-sm-3 col-form-label']) }}
                {{ Form::number('sl',null,array('class'=>'form-control col-sm-9','required'=>'')) }}
            </div>
            {{-- <div class="form-group row">
                {{ Form::label('product_id','Product',['class'=>'col-sm-3 col-form-label']) }}
                {{ Form::select('product_id',$products,null,array('class'=>'form-control select2 col-sm-9','data-url'=>route('stateApi'),'placeholder'=>'Select Product')) }}
            </div> --}}
            <div class="form-group row">
                {{ Form::label('products','Product',['class'=>'col-sm-3 col-form-label']) }}
                {{ Form::select('products[]',$products,null,array('class'=>'form-control select2 col-sm-9','multiple'=>true)) }}
            </div>
            <div class="form-group row">
                {{ Form::label('status','Status',['class'=>'col-sm-3 col-form-label']) }}
                {{ Form::select('status',[1=>'Active',0=>'Inactive'],null,array('class'=>'form-control select2 col-sm-9')) }}
            </div>
            <div class="form-group">
                {{ Form::submit('Save',array('class'=>'btn btn-success')) }}
            </div>
        {!! Form::close() !!}
        
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection

@section('js')

    <script>
        $('#country').change(function(){
            $.get($(this).data('url'), {
                    option: $(this).val()
            },
            function(data) {
                    var subcat = $('#state');
                    subcat.empty();
                    subcat.append("<option value=''>Select State</option>")
                    $.each(data, function(index, element) {
                            subcat.append("<option value='"+ element.name +"'>" + element.name + "</option>");
                    });
            });
        });

    </script>
@endsection