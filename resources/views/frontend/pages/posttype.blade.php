@extends('frontend.layouts.master')
{{-- @section('title',$tax->title) --}}
@section('content')
<div class="section padding_layout_1">
	<div class="container">
	@foreach ($data as $post)
	  <div class="row">
		<div class="col-md-12">
		  <div class="full">
			<div class="main_heading text_align_center">
			  <h2><a href="{{ url('/page',$post->slug) }}">{{$post->title}}</a></h2>
			  {{-- <p class="large">Fastest repair service with best price!</p> --}}
			</div>
		  </div>
		</div>
	  </div>
	  <div class="row about_blog ">
		<div class="col-12 about_cont_blog">
			{{ Str::of(strip_tags($post->body))->limit(300) }}
		</div>
	  </div>
	@endforeach
	</div>
  </div>
  <!-- end section -->
		
@endsection