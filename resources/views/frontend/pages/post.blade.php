@extends('frontend.layouts.master')
@section('content')
<div data-aos="fade-up" data-aos-delay="0" class="aos-init aos-animate">
	<div class="container bg-white p-5">
	   <div class="row">
		  <div class="col-md-12">
			 <div class="full">
				<div class="heading_main text_align_center">
				   <h2>{{$data->title}}</h2>
				</div>
			 </div>
		  </div>
	   </div>
	   <div class="row">
		<div class="col-12 col-lg-9">
		  <table class="table">
			  <tr>
				  <th>SL</th>
				  <th>Title</th>
			  </tr>
			  @foreach ($data->postsDoById as $key=>$item)
				  <tr>
				  	<td>{{++$key}}</td>
				  	<td><a href="{{route('page',$item->slug)}}">{{$item->title}}</a></td>
				  </tr>
			  @endforeach
		  </table>
		</div>		  
		<div class="col-12 col-lg-3">
		  @include('frontend.pages.sideber')
		</div>		  
	 </div>
	</div>
 </div>


@endsection