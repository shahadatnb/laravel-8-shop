@extends('admin.layouts.layout')
@section('title',"Product Category")
@section('content')
<style>
    form.delete {
  display: inline;
}
</style>
<!-- Default box -->
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Category</h3>
                <div class="card-tools">

                </div>
            </div>
            <div class="card-body">
                {!! Form::open(array('route'=>'category.store','enctype'=>'multipart/form-data')) !!}
                    @include('admin.category.fields')
                {!! Form::close() !!}
            </div>
            <!-- /.card-footer-->
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category</h3>
                <div class="card-tools">
                    {{-- <a href="{{route('category.create')}}" class="btn btn-success">New Category</a> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->title }}</td>
                            <td>{{ $data->slug }}</td>
                            <td>
                                <a href="{{ route('category.edit', $data) }}" class="btn btn-warning btn-xs">Edit</a>
                                <form class="delete" action="{{ route('category.destroy',$data) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are You Sure To Delete This Item?')"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @foreach ($data->child as $item)
                        <tr class="bg-light">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>
                                <a href="{{ route('category.edit', $item) }}" class="btn btn-warning btn-xs">Edit</a>
                                <form class="delete" action="{{ route('category.destroy',$item) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are You Sure To Delete This Item?')"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="text-center">{{ $datas->links() }}</div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@section('js')

@endsection
