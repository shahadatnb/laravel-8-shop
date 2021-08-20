@extends('admin.layouts.layout')
@section('title')
All {{ Str::plural($posttype['title']) }}
@endsection
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
		<div class="row">
			<div class="col-3">
				<a href="{{ route('posts.create').'?type='.$posttype['postType'] }}" class="btn btn-primary btn-sm">Create New {{ $posttype['title'] }}</a>
			</div>
			@if ($posttype['taxonomy']==true)
				@include('admin.posts.taxSelect',['route'=>'posts.index'])
			@endif

		</div>
    </div>
    <div class="card-body">
		<div class="table-responsive">
        <table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					@if ($posttype['taxonomy']==true)
						<th>Category</th>
					@endif
					<th>Created date</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			@foreach($posts as $post)
				<tr>
					<td>{{ $post->id }}</td>
					<td>{{ $post->title }}</td>
					@if ($posttype['taxonomy']==true)
						<th>
							@foreach ($post->taxonomy as $item)
								<span class="bg-green">{{$item->title}}</span>
         					@endforeach
						</th>
					@endif
					<td>{{ prettyDate($post->created_at) }}</td>
					<td>
						<a href="{{ route('posts.edit', $post->id).'?type='.$posttype['postType'] }}" class="btn btn-warning btn-sm">Edit</a>
{{--						<a href="{{ url('/PostDelete').'/'.$post->id }}" class="btn btn-danger btn-sm">Delete</a>--}}
                        <form class="delete" action="{{ route('posts.destroy',$post) }}" method="post">
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
    <!-- /.card-body -->
    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection
