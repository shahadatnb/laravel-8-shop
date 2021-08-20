@extends('admin.layouts.layout')
@section('title',"Edit profile")
@section('content')
<div class="row">
    @include('admin.profile.leftSidebar')
    <div class="col-md-9">
    <div class="card">
        <div class="card-header p-2">
        <ul class="nav nav-pills">            
            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Edit Profile info</a></li>            
        </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
        @include('admin.layouts._message')
        <div class="tab-content">
            <div class="active tab-pane" id="activity">
                {!! Form::model($user, ['route'=>['updateProfile',$user->id],'method'=>'POST','enctype'=>'multipart/form-data','class'=>'form-horizontal']) !!}
                    <div class="form-group row">
                      {!! Form::label('name', 'Name',['class'=>'col-sm-2 col-form-label']) !!}
                      <div class="col-sm-10">
                          {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Name']) !!}
                      </div>
                    </div>
                    <div class="form-group row">
                      {!! Form::label('username', 'Username',['class'=>'col-sm-2 col-form-label']) !!}
                      <div class="col-sm-10">
                          {!! Form::text('username',null,['class'=>'form-control','placeholder'=>'Username']) !!}
                      </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('email', 'Email',['class'=>'col-sm-2 col-form-label']) !!}
                      <div class="col-sm-10">
                        {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Email']) !!}
                      </div>
                    </div>                    
                    <div class="form-group row">
                        {!! Form::label('mobile', 'Mobile No',['class'=>'col-sm-2 col-form-label']) !!}
                      <div class="col-sm-10">
                        {!! Form::text('mobile',null,['class'=>'form-control','placeholder'=>'Nobile No']) !!}
                      </div>
                    </div>                   
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        {{ Form::submit('Update', ['class'=>'btn btn-success']) }}
                      </div>
                    </div>
                {!! Form::close() !!}
                <hr>
                {!! Form::open(['route'=>['chengePassword',$user->id],'method'=>'POST','class'=>'form-horizontal']) !!}
                    <div class="form-group row">
                      {!! Form::label('CurrentPassword', 'Current Password',['class'=>'col-sm-2 col-form-label']) !!}
                      <div class="col-sm-10">
                          {!! Form::password('CurrentPassword',['class'=>'form-control','placeholder'=>'Current Password']) !!}
                      </div>
                    </div>
                    <div class="form-group row">
                      {!! Form::label('password', 'Password',['class'=>'col-sm-2 col-form-label']) !!}
                      <div class="col-sm-10">
                          {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password']) !!}
                      </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('password_confirmation', 'Password confirm',['class'=>'col-sm-2 col-form-label']) !!}
                      <div class="col-sm-10">
                        {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Confirm Password']) !!}
                      </div>
                    </div>                    
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        {{ Form::submit('Update password', ['class'=>'btn btn-success']) }}
                      </div>
                    </div>
                {!! Form::close() !!}
            </div>            
        </div>
        <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection