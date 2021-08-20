@extends('admin.layouts.layout')
@section('content')
<!-- DataTables Example -->
<div class="card my-3">
    {{-- <div class="card-header">
        <i class="fas fa-table"></i>
        Data Table Example</div> --}}
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Club</th>
                <th>Team</th>
                <th>Tools</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($customers as $kay=>$user)                         
                    <tr>
                        {{-- <td>{{++$kay}}</td> --}}
                        <td>{{$user->id}}</td>
                        <td>{{$user->first_name}}</td>                   
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->team->club->name}}</td>
                        <td>{{$user->team->name}}</td>
                        <td>
                            <a href="{{route('player.edit',$user->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            <form class="delete" action="{{ route('player.destroy',$user->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure To Delete This Item?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>       
    </div>       
</div>       

@endsection
