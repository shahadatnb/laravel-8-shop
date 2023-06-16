@extends('admin.layouts.layout')
@section('title',"Homepage Settings")
@section('css')

@endsection
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Homepage Settings</h3>
        <div class="card-tools">
            <a href="{{route('homepage.create')}}" class="btn btn-success"><i class="fas fa-plus-square"></i> New</a>
        </div>
    </div>
    <div class="card-body">
        <table id="homepage" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>SL</th>
                    <th>Status</th>                    
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($homepages as $key=>$data)
                <tr>
                    <td>{{ ++$key }}</td>
                    {{-- <td>{{ $data->thumbnail }}</td> --}}
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->slug }}</td>
                    <td>{{ $data->sl }}</td>
                    <td>{{ $data->status }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="">
                            <a href="{{ route('homepage.edit', $data) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form class="delete" action="{{ route('homepage.destroy',$data) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure To Delete This Item?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
@section('js')
<script>

    $(document).ready(function() {
    
    } );
</script>
@endsection