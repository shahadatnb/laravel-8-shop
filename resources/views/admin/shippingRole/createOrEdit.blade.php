@extends('admin.layouts.layout')
@section('title',"Shipping Role")
@section('css')
@endsection
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Shipping Role</h3>
        <div class="card-tools">
        
        </div>
    </div>
    <div class="card-body">
        @include('admin.layouts._message')
        @if ($mode=='edit')
            {!! Form::model($shippingRole,['route'=>['shippingRole.update',$shippingRole], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
        @else
            {!! Form::open(array('route'=>'shippingRole.store','enctype'=>'multipart/form-data')) !!}
        @endif
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('title','Title') }}
                    {{ Form::text('title',null,array('class'=>'form-control','required'=>'','maxlenth'=>'255')) }}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('location_id','Location') }}
                    {{ Form::select('location_id',$locations,null,array('class'=>'form-control select2','required'=>'','placeholder'=>'Select Location')) }}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('condition','Condition') }}
                    {{ Form::select('condition',['Equal'=>'Equal','Not Equal'=>'Not Equal'],null,array('class'=>'form-control select2','required'=>'','placeholder'=>'Condition')) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('amount','Amount') }}
                    {{ Form::number('amount',null,array('class'=>'form-control','required'=>'','step'=>'any','placeholder'=>'Amount')) }}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('minimuUnit','Minimum Unit') }}
                    {{ Form::number('minimuUnit',null,array('class'=>'form-control','required'=>'','step'=>'any','placeholder'=>'Minimum Unit')) }}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('incrementPerUnit','Increment Amount') }}
                    {{ Form::number('incrementPerUnit',null,array('class'=>'form-control','required'=>'','step'=>'any','placeholder'=>'Increment Amount')) }}
                </div>
            </div>
        </div>       
        <div class="row">
            {{-- <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::label('unit','Unit') }}
                    {{ Form::number('unit',null,array('class'=>'form-control','required'=>'','step'=>'any','placeholder'=>'Unit')) }}
                </div>
            </div> --}}
            <div class="col-lg-4">
                <div class="form-group">
                    {{ Form::submit('Save',array('class'=>'btn btn-success')) }}
                </div>
            </div>
        </div>       
        
        {!! Form::close() !!}
        
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection