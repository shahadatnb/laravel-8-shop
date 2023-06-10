@extends('admin.layouts.layout')

@section('content')

<div class="container">       
    <div class="card">
        <div class="card-header">
            <h3>Name: {{$user->name}}</h3>  
            <h4>Email: {{$user->email}}</h4>
            @if ($user->banned_till == '')
                {!! Form::open(['route' => 'user-ban','class'=>'form-horizontal']) !!}  
                <div class="input-group">
                  {!! Form::select('days',['0'=>'Permanently Ban', '7'=>'Next 7 Days', '15'=>'Next 15 Days', '30'=>'Next 30 Days'],null,['class'=>'form-control', 'placeholder'=>'Ban Type']) !!}
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-info btn-flat">Save</button>
                  </span>
                </div>            
                <input type="hidden" name="user_id" value="{{ $user->id }}">
              {!! Form::close() !!}
            @else
                <a href="{{route('user-unban',$user->id)}}" class="btn btn-success">Unban</a>
            @endif
        </div>
        <div class="card-body">
            <h5 class="card-title">Role</h5>
            <p class="card-text">
                @if ($user->roles->isNotEmpty())
                    @foreach ($user->roles as $role)
                        <span class="badge badge-primary">
                            {{ $role->name }}
                        </span>
                    @endforeach
                @endif
            </p>
            <h5 class="card-title">Permissions</h5>
            <p class="card-text">
                @if ($user->permissions->isNotEmpty())                                        
                    @foreach ($user->permissions as $permission)
                        <span class="badge badge-success">
                            {{ $permission->name }}                                    
                        </span>
                    @endforeach            
                @endif
            </p>

        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
        </div>
    </div>
</div>
    
@endsection