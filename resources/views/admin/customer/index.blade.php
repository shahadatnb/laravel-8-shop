@extends('admin.layouts.layout')
@section('title',"Customer")
@section('content')
<style>
    form.delete {
  display: inline;
}
</style>
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Customer</h3>
        <div class="card-tools">
            {{-- <a href="{{route('team.create')}}" class="btn btn-success">New Team</a> --}}
        </div>
    </div>
    <div class="card-body">
        @include('admin.layouts._message')
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->first_name }}</td>
                    <td>{{ $customer->last_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>
                        <a href="{{ route('admin.customer.edit', $customer) }}" class="btn btn-warning btn-xs">Edit</a>
                        {{-- <a href="{{ route('admin.customer.destroy', $customer) }}" class="btn btn-warning btn-xs" onclick="return confirm('Are You Sure To Delete This Item?')"><i class="fas fa-trash"></i> Delete</a> --}}
                        <form class="delete" action="{{ route('admin.customer.destroy',$customer) }}" method="post">
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
        <div class="text-center">{{ $customers->links() }}</div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection