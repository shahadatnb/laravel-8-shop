@extends('admin.layouts.layout')
@section('title',"Team")
@section('content')
<style>
    form.delete {
  display: inline;
}
</style>
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Team</h3>
        <div class="card-tools">
            <a href="{{route('team.create')}}" class="btn btn-success">New Team</a>
        </div>
    </div>
    <div class="card-body">
        @include('admin.layouts._message')
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Club</th>
                    <th>Coach</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->club->name }}</td>
                    <td>{{ $data->coach->name }}</td>
                    <td>
                        <a href="{{ route('team.edit', $data) }}" class="btn btn-warning btn-xs">Edit</a>
                        <form class="delete" action="{{ route('team.destroy',$data) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are You Sure To Delete This Item?')"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center">{{ $datas->links() }}</div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection