@extends('admin.layouts.layout')
@section('title',"Create Team")
@section('content')



<h1>Create Team</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

<div class="card card-primary card-outline">
    <div class="card-body">
        @include('admin.layouts._message')
        @if ($mode=='edit')
            {!! Form::model($writer,['route'=>['team.update',$writer], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
        @else
            {!! Form::open(array('route'=>'team.store','enctype'=>'multipart/form-data')) !!}
        @endif
            <div class="row g-1 _imge_upload">
                <div class="col-md-3 col-lg-3">
                    <div class="_profils">

                        <div class="p-image" for="_pppimage">
                            <i class="fa fa-camera upload-button"></i>
                            <h5 class="upload-button">Add Team Logo</h5>
                            <input class="file-upload" id="_pppimage" name="photo" type="file" accept="image/*">
                        </div>

                    </div>
                </div>

                <div class="col-md-5 col-lg-5">
                    <div class="_padd-floating">
                        <div class="form-floating">
                            <label for="name">Team Name</label>
                            {!! Form::text('name',null,['class'=>'form-control','required'=>'','placeholder'=> __('Team Name')]) !!}
                        </div>
                    </div>
                    <div class="_padd-floating">
                        <div class="form-floating">
                            {{ Form::label('club_id','Club Name',array('class' => '' )) }}
                            {{ Form::select('club_id',$clubs,null,array('class'=>'form-control','required'=>'','placeholder'=>'Club Name')) }}
                        </div>
                    </div>
                    <div class="_padd-floating">
                        <div class="form-floating">
                            {{ Form::label('coach_id','Coach Name',array('class' => '' )) }}
                            {{ Form::select('coach_id',$coach,null,array('class'=>'form-control','required'=>'','placeholder'=>'Coach Name')) }}
                        </div>
                    </div>

                    <div class="_addbutton">
                        <button class="btn btn-danger" type="submit">Create Team</button>
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
        var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
</script>