@extends('admin.layouts.layout')
@section('title')
{{ Str::plural($posttype['title']) }} Category
@endsection
@section('content')
	<div class="row">
		<div class="col-md-5">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Create Category</h3>
				</div>
				<div class="card-body">
				@include('admin.layouts._message')
				@if ($mode=='edit')
					{!! Form::model($taxonomy,['route'=>['taxonomy.update',$taxonomy->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
				  @else
				{!! Form::open(array('route'=>'taxonomy.store','enctype'=>'multipart/form-data')) !!}
				@endif
					{{ Form::hidden('post_type', $posttype['postType'] ) }}
					{{ Form::label('title','Title') }}
					{{ Form::text('title',null,array('class'=>'form-control','required'=>'','maxlenth'=>'255')) }}
						{{ Form::file('image',null,array('class'=>'form-control')) }}
					{{ Form::submit('Save',array('class'=>'btn btn-success')) }}
				{!! Form::close() !!}
				</div>
			</div>
			<!-- /.box -->
		</div>
		@if ($mode=='create')
		<div class="col-md-7">
		<!-- Default box -->
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Category List</h3>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Photo</th>
								<th>Title</th>
								<th>Slug</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($AllTaxonomy as $tax)
							<tr>
								<td>{{ $tax->id }}</td>
								<td><img width="60" src="{{ asset('storage/'.$tax->image) }}" alt="" class="img-thumbnail"></td>
								<td>{{ $tax->title }}</td>
								<td>{{ $tax->slug }}</td>
								<td>
									<a href="{{ route('taxonomy.edit', $tax->id).'?type='.$posttype['postType'] }}" class="btn btn-warning btn-sm">Edit</a>
									<!-- <a href="{{-- URL::to('PostDelete').'/'.$taxonomy->id --}}" class="btn btn-danger btn-sm">Delete</a> -->
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.box -->
		</div>
		@endif
	</div>
  </div>
 @endsection
