@extends('frontend.layouts.master')
@section('title',$page->title)
@section('content')

<section id="about" class="about mt-5">
	<div class="section-title">
		<h2>{{$page->title}}</h2>
	</div>
	<div class="container">

		<div class="aboutcontent">
			@if ($page->image != '')
			<figure>
				<img class="_imgabou w-100" src="{{ asset('storage/'.$page->image) }}" alt="">
			</figure>
			@endif

			<div class="_aboutcontenttext">
				<h2>Our Story</h2>
				{!! $page->body !!}
			</div>
		</div>

	</div>
</section>
<section class="_clients">
	<div class="container">
		<div class="owl-carousel owl-theme" id="owl-slider">
			@php $client_logo = CustomHelper::posts(['post_type'=>'client-logo','orderBy'=>'sort']) @endphp
			@foreach($client_logo as $key=>$logo)
			<div class="item">
				<figure>
					<img class="" src="{{asset('storage/'.$logo->image)}}" alt="">
				</figure>
			</div>
			@endforeach
		</div>
	</div>
</section>

@endsection