@extends('admin.layouts.layout')
@section('title',"Taxrate")
@section('css')

@endsection
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <a href="{{ route('taxrate.index')}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
        <div class="card-tools">
            <a href="{{ route('taxrate.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> New Taxrate</a>
        </div>
    </div>
    <div class="card-body">
        @if ($mode=='edit')
            {!! Form::model($taxrate,['route'=>['taxrate.update',$taxrate], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
        @else
            {!! Form::open(array('route'=>'taxrate.store','enctype'=>'multipart/form-data')) !!}
        @endif
        
        @include('admin.layouts._message')
            <div class="form-group row">
                {{ Form::label('identifier','Identifier Title',['class'=>'col-sm-3 col-form-label']) }}
                {{ Form::text('identifier',null,array('class'=>'form-control col-sm-9','required'=>'','maxlenth'=>'255')) }}
            </div>
            <div class="form-group row">
                {{ Form::label('tax_rate','Tax Rate(Percentage)',['class'=>'col-sm-3 col-form-label']) }}
                {{ Form::number('tax_rate',null,array('class'=>'form-control col-sm-9','required'=>'','step'=>'any')) }}
            </div>
            <div class="form-group row">
                {{ Form::label('country','Country',['class'=>'col-sm-3 col-form-label']) }}
                {{ Form::select('country',$country,null,array('class'=>'form-control select2 col-sm-9','data-url'=>route('stateApi'),'placeholder'=>'Select Country')) }}
            </div>
            <div class="form-group row">
                {{ Form::label('state','State',['class'=>'col-sm-3 col-form-label']) }}
                {{ Form::select('state',$state,null,array('class'=>'form-control select2 col-sm-9','id'=>'state','placeholder'=>'Select State')) }}
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