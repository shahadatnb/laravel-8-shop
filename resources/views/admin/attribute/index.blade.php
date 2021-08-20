@extends('admin.layouts.layout')
@section('title',"Product Attribute")
@section('content')
<style>
    form.delete {
  display: inline;
}
</style>
<!-- Default box -->
<div class="row">
    {{--
    <div class="col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Attribute</h3>
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
    </div> --}}
    <div class="col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Attribute</h3>
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
                            <th>Code</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($attributes as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->code }}</td>
                            <td>
                                <a href="{{ route('attribute.show', $data) }}" class="btn btn-warning btn-xs">Options</a>
                                {{--
                                <form class="delete" action="{{ route('category.destroy',$data) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are You Sure To Delete This Item?')"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                                --}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="text-center">{{ $attributes->links() }}</div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@section('js')

@endsection
