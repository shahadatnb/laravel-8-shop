@extends('admin.layouts.layout')
@section('title',"Create Player")
@section('content')

<div class="card card-primary card-outline">
    <div class="card-body">
        @include('admin.layouts._message')
        @if ($mode=='edit')
            {!! Form::model($user,['route'=>['player.update',$user->id], 'method'=>'PUT', 'enctype'=>'multipart/form-data']) !!}
        @else
            {!! Form::open(array('route'=>'player.store','enctype'=>'multipart/form-data')) !!}
        @endif

            <div class="row select-store">
                @if(Auth::user()->hasAnyRole(['admin','stuff']))
                <div class="col-sm-12 col-lg-6">
                    {{ Form::label('club_id','Club Name',array('class' => '' )) }}
                    {{ Form::select('club_id',$clubs,null,array('class'=>'form-control select2','required'=>'','placeholder'=>'Club Name','data-url'=>route('teamApi'))) }}
                </div>
                @endif
                @if(Auth::user()->hasRole('team'))
                    <input type="hidden" value="{{Auth::user()->id}}" name="team_id">
                @else
                    <div class="col-sm-12 col-lg-6">
                        {{ Form::label('team_id','Team Name',array('class' => '' )) }}
                        {{ Form::select('team_id',$teams,null,array('class'=>'form-control select2','required'=>'')) }}
                    </div>
                @endif
            </div>

            @if ($mode=='create')
            <div class="row customer-info">
                <div class="col-sm-12 col-lg-3">
                    <label for="first_name">First Name</label>
                    {!! Form::text('first_name[]',null,['class'=>'form-control','required'=>'','placeholder'=> __('First Name')]) !!}
                </div>
                <div class="col-sm-12 col-lg-3">
                    <label for="last_name">Last Name</label>
                    {!! Form::text('last_name[]',null,['class'=>'form-control','required'=>'','placeholder'=> __('Last Name')]) !!}
                </div>
                <div class="col-sm-8 col-lg-4">
                    <label for="email">Email</label>
                    {!! Form::email('email[]',null,['class'=>'form-control','required'=>'','placeholder'=> __('Email')]) !!}
                </div>
                <div class="col-sm-4 col-lg-2">
                    <label class="mt-4">
                    <button type="button" class="btn-add-more-field btn btn-success"><i class="fas fa-plus"></i></button>
                    <button type="button" class="btn-remove-field btn btn-danger d-none"><i class="fas fa-times"></i></button>
                    </label>
                </div>
            </div>
            @elseif ($mode=='edit')
            <div class="row customer-info">
                <div class="col-sm-12 col-lg-3">
                    <label for="first_name">First Name</label>
                    {!! Form::text('first_name',null,['class'=>'form-control','required'=>'','placeholder'=> __('First Name')]) !!}
                </div>
                <div class="col-sm-12 col-lg-3">
                    <label for="last_name">Last Name</label>
                    {!! Form::text('last_name',null,['class'=>'form-control','required'=>'','placeholder'=> __('Last Name')]) !!}
                </div>
                <div class="col-sm-8 col-lg-6">
                    <label for="email">Email</label>
                    {!! Form::email('email',null,['class'=>'form-control','required'=>'','placeholder'=> __('Email')]) !!}
                </div>
            </div>
            @endif

            <div class="row submit-btn">
                <div class="col-12">
                <div class="form-floating">
                    <br>
                    <button class="btn btn-danger" type="submit">Save Player</button>
                </div>
            </div>

            {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  @endsection
  @section('js')
<script>
    //$('#club_id').change(function(){
    $('.select-store').on('load | change', '#club_id', function() {
        $.get($(this).data('url'), {
                option: $(this).val()
        },
        function(data) {
                var subcat = $('#team_id');
                subcat.empty();
                //subcat.append("<option value=''>-----</option>")
                $.each(data, function(index, element) {
                        subcat.append("<option value='"+ element.id +"'>" + element.name + "</option>");
                });
        });
    });


    $(document).ready(function(){
        $('.card-body').on('click', '.btn-add-more-field', function() {
            var $clone = $( ".customer-info" ).first().clone();
            //$clone.append( "<button type='button' class='remove-row'>-</button>" );
            $clone.find('input').val('');
            $clone.find('.btn-remove-field').removeClass("d-none");
            $clone.insertBefore( ".submit-btn" );
        });
        
        $( ".card-body" ).on("click", ".btn-remove-field", function(){
            $(this).closest('.customer-info').remove();
        });
    });
    
</script>
    @endsection