@extends('admin.layouts.layout')
@section('title',"Create or edit Team")
@section('css')
  {!! Html::style('assets/admin/css/imageuploadify.min.css') !!}
@endsection
@section('content')

<div class="card card-primary card-outline">
    <div class="card-body">
        @include('admin.layouts._message')
        @if ($mode=='edit')
            {!! Form::model($user,['route'=>['editTeam',$user->id],'enctype'=>'multipart/form-data']) !!}
        @else
            {!! Form::open(array('route'=>'createTeam','enctype'=>'multipart/form-data')) !!}
        @endif
            <div class="row g-1 _imge_upload">
                <div class="col-md-3 col-lg-3">
                    <div class="_profils">
                        @if ($mode == 'edit')
                            <img width="120" src="{{ asset('storage/'.$user->profile->photo) }}" alt="" class="img-thumbnail">
                        @endif
                        <div class="p-image" for="_pppimage">
                            <i class="fa fa-camera upload-button"></i>
                            <h5 class="upload-button">Add Team Photo</h5>
                            <input class="file-upload" id="_pppimage" name="photo" type="file" accept="image/*">
                        </div>

                    </div>
                </div>

                <div class="col-md-5 col-lg-5">
                    <div class="_padd-floating">
                        <div class="form-floating">
                            <label for="name">Team Name</label>
                            {!! Form::text('name',null,['class'=>'form-control','placeholder'=> __('Team Name')]) !!}
                        </div>
                    </div>
                    @if(Auth::user()->hasRole('club'))
                        <input type="hidden" value="{{Auth::user()->id}}" name="club_id">
                    @else
                        <div class="_padd-floating">
                            <div class="form-floating">
                                {{ Form::label('club_id','Club Name',array('class' => '' )) }}
                                {{ Form::select('club_id',$clubs,null,array('class'=>'form-control select2','required'=>'','placeholder'=>'Club Name')) }}
                            </div>
                        </div>
                    @endif
                    <div class="_padd-floating">
                        <div class="form-floating">
                            <label for="name">Coach Name</label>
                            {!! Form::text('coachName',null,['class'=>'form-control','placeholder'=> __('Coach Name')]) !!}
                        </div>
                    </div>
                    <div class="_padd-floating">
                        <div class="form-floating">
                            <label for="email">Coach Email</label>
                            {!! Form::email('email',null,['class'=>'form-control','placeholder'=> __('Coach Email')]) !!}
                        </div>
                    </div>

                    <div class="_addbutton mt-3">
                        <button class="btn btn-danger" type="submit">Save Team</button>
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
    @endsection