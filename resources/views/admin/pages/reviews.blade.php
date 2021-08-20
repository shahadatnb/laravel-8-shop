@extends('admin.layouts.layout')
@section('title',"Reviews")
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Reviews</h3>
        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <table id="coupons" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>SL</th>
                <th>Product</th>
                <th>Club</th>
                <th>Team</th>
                <th>Customer</th>
                <th>Comment</th>
                <th>Date</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($reviews as $key=>$data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->product->title }}</td>
                    <td>{{ $data->customer->team->club->name }}</td>
                    <td>{{ $data->customer->team->name }}</td>
                    <td>{{ $data->customer->first_name.' '.$data->customer->last_name }}</td>
                    <td>{{ $data->comment }}</td>
                    <td>{{ prettyDate($data->created_at) }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="">
{{--                            <a href="{{ route('review.edit', $data) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>--}}
                            <form class="delete" action="{{ route('review.destroy',$data) }}" method="post">
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
    <div class="card-footer">
        <div class="text-center">{{ $reviews->links() }}</div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection
