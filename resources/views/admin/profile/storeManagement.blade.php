@extends('admin.layouts.layout')
@section('title',"Store Management")
@section('content')
<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
            <div class="text-center">
                @if(Auth::user()->profile->photo != '')
                    @php $profilePhoto='storage/'.Auth::user()->profile->photo @endphp
                @else
                    @php $profilePhoto='assets/admin/img/avatar.png' @endphp
                @endif
                <img class="profile-user-img img-fluid img-circle"
                    src="{{asset('/').$profilePhoto}}"
                    alt="{{Auth::user()->name}}">
            </div>

            <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
        <!--
            <p class="text-muted text-center">Software Engineer</p>

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                <b>Followers</b> <a class="float-right">1,322</a>
                </li>
                <li class="list-group-item">
                <b>Following</b> <a class="float-right">543</a>
                </li>
                <li class="list-group-item">
                <b>Friends</b> <a class="float-right">13,287</a>
                </li>
            </ul>

            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <!-- <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">About Me</h3>
            </div>
            <div class="card-body">
            <strong><i class="fas fa-book mr-1"></i> Education</strong>

            <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
            </p>

            <hr>
            </div>
        </div> -->
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
    <div class="card">
        <div class="card-header">
            @if(Auth::user()->profile->banner != '')
                <img src="{{ asset('storage/'.Auth::user()->profile->banner)}}" class="card-img-top" alt="...">
            @else
                Store Profile
                <ul class="nav nav-pills">

                </ul>
            @endif

        </div><!-- /.card-header -->
        <div class="card-body">
            @include('admin.layouts._message')
            {!! Form::model($profile, ['route'=>['storeManagement'],'method'=>'POST','enctype'=>'multipart/form-data','class'=>'form-horizontal']) !!}
                {!! Form::hidden('id', null) !!}
                    <div class="form-group row">
                        {!! Form::label('contactEmail', 'Contact Email',['class'=>'col-sm-2 col-form-label']) !!}
                      <div class="col-sm-10">
                        {!! Form::email('contactEmail',null,['class'=>'form-control','placeholder'=>'Contact Email']) !!}
                      </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('phone', 'Phone / Mobile No',['class'=>'col-sm-2 col-form-label']) !!}
                      <div class="col-sm-10">
                        {!! Form::text('phone',null,['class'=>'form-control','placeholder'=>'Nobile No']) !!}
                      </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('photo', 'Logo',['class'=>'col-sm-2 col-form-label']) !!}
                      <div class="col-sm-10">
                        {!! Form::file('photo',null,['class'=>'form-control','placeholder'=>'Logo','accept'=>'image/*']) !!}
                      </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('banner', 'Banner',['class'=>'col-sm-2 col-form-label']) !!}
                      <div class="col-sm-10">
                        {!! Form::file('banner',null,['class'=>'form-control','placeholder'=>'Banner','accept'=>'image/*']) !!}
                      </div>
                    </div>

                    <div id="address" class="row address-info">
                        <div class="col-12"><p>Address</p></div>

                        {{-- @dump($user->address) --}}
                        <div class="col-6">
                            <div class="form-group">
                                {!! Form::label('address1', 'House &amp; Road',['class'=>'form-label']) !!}
                                {!! Form::text('address1',null,['class'=>'form-control','required'=>'','placeholder'=>'House &amp; Road']) !!}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                {!! Form::label('address2', 'Address Line 2(Optional)',['class'=>'form-label']) !!}
                                {!! Form::text('address2',null,['class'=>'form-control','required'=>'','placeholder'=>'Address Line 2(Optional)']) !!}
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                {!! Form::label('country', 'Country',['class'=>'form-label']) !!}
                                {!! Form::select('country',$country,null,['class'=>'form-control select2','required'=>'','placeholder'=>'Country','data-url'=>route('stateApi')]) !!}
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                {!! Form::label('state', 'City',['class'=>'form-label']) !!}
                                {!! Form::select('state',$state,null,['class'=>'form-control select2','required'=>'','placeholder'=>'City']) !!}
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                {!! Form::label('city', 'City',['class'=>'form-label']) !!}
                                {!! Form::text('city',null,['class'=>'form-control','required'=>'','placeholder'=>'City']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('postcode', 'Zip/Postcode',['class'=>'form-label']) !!}
                                {!! Form::text('postcode',null,['class'=>'form-control','required'=>'','placeholder'=>'Zip/Postcode']) !!}
                            </div>
                        </div>
                    </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            {{ Form::submit('Update', ['class'=>'btn btn-success']) }}
                          </div>
                        </div>
                {!! Form::close() !!}

        </div><!-- /.card-body -->
    </div>
    <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@section('js')
<script>
    //$('#club_id').change(function(){
    $('#address').on('load | change', '#country', function() {
        $.get($(this).data('url'), {
                option: $(this).val()
        },
        function(data) {
                var subcat = $('#state');
                subcat.empty();
                //subcat.append("<option value=''>-----</option>")
                $.each(data, function(index, element) {
                        subcat.append("<option value='"+ element.name +"'>" + element.name + "</option>");
                });
        });
    });

</script>
@endsection
