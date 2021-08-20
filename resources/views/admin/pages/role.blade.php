@extends('admin.layouts.layout')
@section('title',"Ruse Role")
@section('css')
@endsection
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">User Role</h3>
    <div class="card-tools">
    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fas fa-times"></i></button>
    </div>
  </div>
    <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>User</th>
                <th>Action</th>
                <th>Password</th>
              </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
              <tr>
                {!! Form::model($user,['route'=>'admin-assign','method'=>'post']) !!}
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}"></td>
                <td>{{ Form::select('roles[]',$roles,null,['class'=>'select2-multi form-control','multiple'=>'multiple']) }}</td>
                <td><button class="btn btn-primary" type="submit">Assign Role</button></td>
                {!! Form::close() !!}
                <td>
                  {!! Form::open(['route'=>'chengePasswordFource','method'=>'post','class'=>'form-inline']) !!}
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    {{ Form::text('password',null,['class'=>'form-control']) }}
                    <button class="btn btn-primary" type="submit">Set Pass</button>
                  {!! Form::close() !!}
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        <div class="text-center">{{ $users->links() }}</div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      
    </div>
    <!-- /.box-footer-->
  </div>
<!--   Card  -->
 @endsection
    @section('js')
      
    @endsection