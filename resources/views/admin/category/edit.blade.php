@extends('admin.layouts.layout')
@section('title',"Edit Category")
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Category</h3>
        <div class="card-tools">
        
        </div>
    </div>
    <div class="card-body">
        {!! Form::model($category,['route'=>['category.update',$category], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
        @include('admin.category.fields')
        {!! Form::close() !!}
        
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection