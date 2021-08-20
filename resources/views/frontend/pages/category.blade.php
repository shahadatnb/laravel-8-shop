@extends('frontend.layouts.master')
@section('title',$tax->title)
@section('content')
<!-- inner page banner -->
<div id="inner_banner" class="section inner_banner_section"
@if($tax->image != '')
 style="background-image: url('{{ url('/upload/post_tax',$tax->image)}}')"
@endif
>
	<div class="container">
	  <div class="row">
		<div class="col-md-12">
		  <div class="full">
			<div class="title-holder">
			  <div class="title-holder-cell text-left">
				<h1 class="page-title">{{$tax->title}}</h1>
				<ol class="breadcrumb">
				  <li><a href="{{ url('/') }}">Home</a></li>
				  <li class="active">{{$tax->title}}</li>
				</ol>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>
  <!-- end inner page banner -->
  <!-- section -->
<div class="section padding_layout_1">
	<div class="container">
	@foreach ($tax->postsDoById as $post)
		
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