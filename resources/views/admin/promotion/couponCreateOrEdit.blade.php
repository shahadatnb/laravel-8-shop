@extends('admin.layouts.layout')
@section('title',"Coupon")
@section('css')
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <a href="{{ route('coupon.index')}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
        <div class="card-tools">
            <a href="{{ route('coupon.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> New Coupon</a>
        </div>
    </div>
    <div class="card-body">
        @if ($mode=='edit')
            {!! Form::model($coupon,['route'=>['coupon.update',$coupon], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
        @else
            {!! Form::open(array('route'=>'coupon.store','enctype'=>'multipart/form-data')) !!}
        @endif
        
        @include('admin.layouts._message')
            <div class="form-group row">
                {{ Form::label('title','Coupon Title',['class'=>'col-sm-3 col-form-label']) }}
                {{ Form::text('title',null,array('class'=>'form-control col-sm-9','required'=>'','maxlenth'=>'255')) }}
            </div>
            <div class="form-group row">
                {{ Form::label('coupen_code','Coupon Tag',['class'=>'col-sm-3 col-form-label']) }}
                {{ Form::text('coupen_code',null,array('class'=>'form-control col-sm-9','required'=>'','maxlenth'=>'255')) }}
            </div>
            <div class="form-group row">
                <div class="offset-sm-3 col-sm-9">
                  <div class="form-check">
                    {{ Form::checkbox('is_percentage',1,null,array('class'=>'form-check-input','id'=>'is_percentage')) }}
                    {{ Form::label('is_percentage','Use percentage',['class'=>'form-check-label']) }}
                  </div>
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('discount','Discount',['class'=>'col-sm-3 col-form-label']) }}
                {{ Form::number('discount',null,array('class'=>'form-control col-sm-9','required'=>'')) }}
            </div>

            <div class="form-group row">
                <div class="input-group date" id="starts_from1" data-target-input="nearest">
                    {{ Form::label('starts_from','Start date',['class'=>'col-sm-3 col-form-label datetimepicker-input']) }}
                    {{ Form::text('starts_from',null,array('class'=>'form-control col-sm-9','required'=>'','data-target'=>'#starts_from1')) }}
                    <div class="input-group-append" data-target="#starts_from1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="input-group date" id="ends_till1" data-target-input="nearest">
                    {{ Form::label('ends_till','End date',['class'=>'col-sm-3 col-form-label datetimepicker-input']) }}
                    {{ Form::text('ends_till',null,array('class'=>'form-control col-sm-9','required'=>'','data-target'=>'#ends_till1')) }}
                    <div class="input-group-append" data-target="#ends_till1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            
            
            <div class="form-group row">
                {{ Form::label('club','Club',['class'=>'col-sm-3 col-form-label']) }}
                {{ Form::select('club',$clubs,null,array('class'=>'form-control select2 col-sm-9','data-url'=>route('teamApi'),'placeholder'=>'All Clubs')) }}
            </div>
            <div class="form-group row">
                {{ Form::label('teams','Teams',['class'=>'col-sm-3 col-form-label']) }}
                {{ Form::select('teams[]',$teams,null,array('class'=>'form-control select2-multi col-sm-9','multiple'=>'multiple','id'=>'teams','placeholder'=>'All Teams')) }}
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
<script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"> </script>
<!-- Tempusdominus -->
<script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"> </script>
    <script>
    (function ($) {
        $('#club').change(function(){
            $.get($(this).data('url'), {
                    option: $(this).val()
            },
            function(data) {
                    var subcat = $('#teams');
                    subcat.empty();
                    subcat.append("<option value=''>All Teams</option>")
                    $.each(data, function(index, element) {
                            subcat.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                    });
            });
        });

        $('#starts_from1').datetimepicker({
                format: 'MM/DD/YYYY'
            })
        $('#ends_till1').datetimepicker({
                format: 'MM/DD/YYYY'
            })
    })(jQuery)
    </script>
@endsection