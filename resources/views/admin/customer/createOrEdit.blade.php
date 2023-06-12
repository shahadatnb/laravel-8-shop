@extends('admin.layouts.layout')
@section('title',"Customer Create/Edit")
@section('content')
<div class="card card-primary card-outline">
    <div class="card-body">
        @include('admin.layouts._message')
        @if ($mode=='edit')
            {!! Form::model($customer,['route'=>['admin.customer.update',$customer->id], 'method'=>'POST','enctype'=>'multipart/form-data']) !!}
        @else
            {{-- {!! Form::open(array('route'=>'team.store','enctype'=>'multipart/form-data')) !!} --}}
        @endif
            <div class="row g-1 _imge_upload">
                <div class="col-md-5 col-lg-5">
                    <div class="_padd-floating">
                        <div class="form-floating">
                            <label for="first_name">First Name</label>
                            {!! Form::text('first_name',null,['class'=>'form-control','required'=>'','placeholder'=> __('First Name')]) !!}
                        </div>
                    </div>
                    <div class="_padd-floating">
                        <div class="form-floating">
                            <label for="last_name">Last Name</label>
                            {!! Form::text('last_name',null,['class'=>'form-control','required'=>'','placeholder'=> __('Last Name')]) !!}
                        </div>
                    </div>
                    <div class="_padd-floating">
                        <div class="form-floating">
                            <label for="email">Email</label>
                            {!! Form::email('email',null,['class'=>'form-control','required'=>'','placeholder'=> __('Email')]) !!}
                        </div>
                    </div>
                    <div class="_padd-floating">
                        <div class="form-floating">
                            <label for="phone">Phone</label>
                            {!! Form::text('phone',null,['class'=>'form-control','required'=>'','placeholder'=> __('Phone')]) !!}
                        </div>
                    </div>

                    <div class="_addbutton">
                        <button class="btn btn-danger" type="submit">Update</button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  @endsection
  @section('js')
  @endsection