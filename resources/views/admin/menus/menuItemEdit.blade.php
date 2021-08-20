@extends('admin.layouts.layout')
@section('page_title',"Menu")
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit</h3>
        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        @include('admin.layouts._message')
        {!! Form::model($menu,['route'=>['menuItem.update',$menu->id],'method'=>'POST','class'=>'form']) !!}
        @include('admin.menus.partial.fields') 
        
        {!! Form::close() !!}
        
    </div>
</div>
<!-- /.card -->
@endsection