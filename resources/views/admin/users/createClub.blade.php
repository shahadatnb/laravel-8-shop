@extends('admin.layouts.layout')
@section('title',"Create of edit ".$role->name)
@section('css')
  {!! Html::style('assets/admin/css/imageuploadify.min.css') !!}
@endsection
@section('content')

<div class="card card-primary card-outline">
    <div class="card-body">
        @include('admin.layouts._message')
        @if ($mode == 'edit')
            {!! Form::model($user, array('route'=>['editUser',[$role->slug,$user->id]],'files' => true)) !!}
        @else
            {!! Form::open(array('route'=>['createUser',$role->slug],'files' => true)) !!}
        @endif
        
            <div class="row g-1 _imge_upload">
                <div class="col-md-3 col-lg-3">
                    @if ($mode == 'edit')
                        <img width="120" src="{{ asset('storage/'.$user->profile->photo) }}" alt="" class="img-thumbnail">
                    @endif
                    <div class="_profils">

                        <div class="p-image" for="_pppimage">
                            <i class="fa fa-camera upload-button"></i>
                            <h5 class="upload-button">Add {{$role->name}} {{ ($role->slug == 'staff') ? 'Photo' : 'Logo' }} </h5>
                            <input class="file-upload" id="_pppimage" name="photo" type="file" accept="image/*" >
                        </div>

                    </div>
                </div>

                <div class="col-md-5 col-lg-5">
                    <div class="_padd-floating">
                        <div class="form-floating">
                            <label for="name">{{$role->name}} Name</label>
                            {!! Form::text('name',null,['class'=>'form-control','placeholder'=> $role->name.__(' Name')]) !!}
                        </div>
                    </div>
                    <div class="_padd-floating">
                        <div class="form-floating">
                            <label for="email">{{$role->name}} Email</label>
                            {!! Form::email('email',null,['class'=>'form-control','placeholder'=> $role->name.__(' Email')]) !!}
                        </div>
                    </div>

                    <div class="_addbutton mt-3">
                        <button class="btn btn-danger" type="submit">Save {{$role->name}}</button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  @endsection
  @section('js')
  {!! Html::script('assets/admin/js/imageuploadify.min.js') !!}}
  <script>

    jQuery(document).ready(function(){
        $('input[type="file"]').imageuploadify();
});
</script>
    @endsection