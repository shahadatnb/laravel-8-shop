@extends('admin.layouts.layout')
@section('title',"Shipping Role")
@section('content')
<style>
    form.delete {
  display: inline;
}
</style>
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Shipping Role</h3>
        <div class="card-tools">
            <a href="{{route('shippingRole.create')}}" class="btn btn-success">New Stipping Role</a>
        </div>
    </div>
    <div class="card-body">
        @include('admin.layouts._message')
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Condition</th>
                    <th>Location</th>
                    <th>Amount</th>
                    {{-- <th>unit</th> --}}
                    <th>minimuUnit</th>
                    <th>incrementPerUnit</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->condition }}</td>
                    <td>{{ $data->location_id }}</td>
                    <td>{{ $data->amount }}</td>
                    {{-- <td>{{ $data->unit }}</td> --}}
                    <td>{{ $data->minimuUnit }}</td>
                    <td>{{ $data->incrementPerUnit }}</td>
                    <td>
                        <a href="{{ route('shippingRole.edit', $data) }}" class="btn btn-warning btn-xs">Edit</a>
                        <form class="delete" action="{{ route('shippingRole.destroy',$data) }}" method="post">
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