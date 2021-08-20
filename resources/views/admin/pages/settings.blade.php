@extends('admin.layouts.layout')
@section('title',"Settings")
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><a target="_blank" href="{{route('ac_config')}}" class="btn btn-danger">Applay</a></h3>
        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
      @include('admin.layouts._message')
      @foreach($settings as $setting)
      {!! Form::open(['route'=>['saveSetting',$setting->id],'method'=>'PUT','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}
      @php  $option=json_decode($setting->field, true);  @endphp
      <div class="row">
        <div class="col-md-10">
          {{ Form::label($setting->name,$setting->description) }}
          {{-- Form::text('value',$setting->value,['class'=>'form-control','required'=>'']) --}} 
          @if($option['type']=='email')
              <input type="email" name="value" id="{{$setting->name}}" @if($option['required']==1) required="required" @endif value="{{$setting->value}}" class="form-control">

          @elseif($option['type']=='number')
              <input type="number" name="value" id="{{$setting->name}}" @if($option['required']==1) required="required" @endif value="{{$setting->value}}" class="form-control"> 

          @elseif($option['type']=='textarea')
              <textarea class="form-control" name="value" id="{{$setting->name}}" rows="5" @if($option['required']==1) required="required" @endif>{{$setting->value}}</textarea>
              {{-- <textarea class="form-control @if($option['editor']=='1') textarea @endif" name="value" id="{{$setting->name}}" rows="5" @if($option['required']==1) required="required" @endif>{{$setting->value}}</textarea> --}}

          @elseif($option['type']=='select')
              <select name="value" id="{{$setting->name}}" @if($option['required']==1) required="required" @endif class="form-control">
                <option value="{{$setting->value}}">{{$setting->value}}</option>
                @foreach($option['options'] as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
                @endforeach
              </select>
          @elseif($option['type']=='image')

          <div class="custom-file">
            <input id="{{$setting->name}}" name="value" type="file" class="form-control custom-file-input">
          <label class="custom-file-label" for="{{$setting->name}}">{{ $setting->description }}</label>
          {!! Form::hidden('image', 1) !!}
          </div>

          @else
            <input type="text" name="value" id="{{$setting->name}}" @if($option['required']==1) required="required" @endif value="{{$setting->value}}" class="form-control"> 
          @endif
        </div>
        <div class="col-md-2"> 
          {{ Form::label('submit','&nbsp;') }}
          {{ Form::submit('Save',array('class'=>'form-control btn btn-success')) }}</div>
        </div>
     {!! Form::close() !!}
     @endforeach
     
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection