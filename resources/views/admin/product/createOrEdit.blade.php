@extends('admin.layouts.layout')
@section('title',"Product")
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" integrity="sha512-0p3K0H3S6Q4bEWZ/WmC94Tgit2ular2/n0ESdfEX8l172YyQj8re1Wu9s/HT9T/T2osUw5Gx/6pAZNk3UKbESw==" crossorigin="anonymous" />
<script src="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
<script src="//cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
<style>
	.imaage-remove {
		position: absolute;
		right: 15px;
		top: 10px;
		background: #fff;
		padding: 1px;
		cursor: pointer;
		border-radius: 10px;
		box-shadow: 0px 0px 5px #ddd;
	}

	#variants .form-control{
		min-width: 100px;
	}
</style>
{{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" /> --}}
@endsection
@section('content')
	@if ($mode=='edit')
			{!! Form::model($product,['route'=>['product.update',$product], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
	@else
			{!! Form::open(array('route'=>'product.store','enctype'=>'multipart/form-data')) !!}
	@endif
<div class="row">
    <div class="col-sm-12 col-lg-8">
        <div class="card card-outline">
            <div class="card-body">
                @include('admin.layouts._message')
                <div class="form-group">
                    {{ Form::label('title','Title',array('class' => '' )) }}
                    {{ Form::text('title',null,array('class'=>'form-control','required'=>'','maxlenth'=>'255')) }}
                </div>
                {{-- <div class="form-group">
                    {{ Form::label('short_description','Short Description',array('class' => '' )) }}
                    {{ Form::textarea('short_description',null,array('class'=>'form-control textarea','required'=>'','rows'=>'2')) }}
                </div> --}}
                <div class="form-group">
                    {{ Form::label('description','Description',array('class' => '' )) }}
                    {{ Form::textarea('description',null,array('class'=>'form-control textarea','required'=>'','rows'=>'5')) }}
                </div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
		@if ($mode=='edit')
			@livewire('product.images', ['product' => $product])
		@endif
				<div class="card card-outline">
					<div class="card-body">
							<div class="row">
								<div class="col-6">
									<div class="form-group">
                    {{ Form::label('price','Price',array('class' => '' )) }}
                    {{ Form::number('price',null,array('class'=>'form-control','required'=>'')) }}
                	</div>
								</div>
								<div class="col-6">
									<div class="form-group">
                    {{ Form::label('special_price','Special Price',array('class' => '' )) }}
                    {{ Form::number('special_price',null,array('class'=>'form-control')) }}
                	</div>
								</div>
							</div>
					</div>
				</div>

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Inventory</h3>
					</div>
					<div class="card-body">
							<div class="row">
								<div class="col-4">
									<div class="form-group">
                    {{ Form::label('sku','SKU(Stock Keeping Unit)',array('class' => '' )) }}
                    {{ Form::text('sku',null,array('class'=>'form-control','required'=>'')) }}
                	</div>
								</div>
								<div class="col-4">
									<div class="form-group">
                    {{ Form::label('barcode','Barcode (ISBN, UPC, GTIN)',array('class' => '' )) }}
                    {{ Form::text('barcode',null,array('class'=>'form-control')) }}
                	</div>
								</div>
								<div class="col-4">
									<div class="form-group">
                    {{ Form::label('qty','Quantity',array('class' => '' )) }}
                    {{ Form::number('qty',null,array('class'=>'form-control','required'=>'')) }}
                	</div>
								</div>
								<div class="col-12">
									<div class="form-check">
                    {{ Form::checkbox('trackQuantity',1,null,array('class'=>'form-check-input','id'=>'trackQuantity')) }}
                    {{ Form::label('trackQuantity','Track Quantity',array('class' => 'form-check-label' )) }}
                	</div>
									<div class="form-check">
                    {{ Form::checkbox('stockOutSell',1,null,array('class'=>'form-check-input','id'=>'stockOutSell')) }}
                    {{ Form::label('stockOutSell','Continue selling when out of stock',array('class' => 'form-check-label' )) }}
                	</div>
								</div>
							</div>
					</div>
				</div>

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Shipping</h3>
					</div>
					<div class="card-body">
						<div class="form-check">
							{{ Form::checkbox('readyToShipping',1,null,array('class'=>'form-check-input','id'=>'readyToShipping')) }}
							{{ Form::label('readyToShipping','Ready To 100% Shipping',array('class' => 'form-check-label' )) }}
						</div>
						<div class="form-check">
							{{ Form::checkbox('noShappingCharge',1,null,array('class'=>'form-check-input','id'=>'noShappingCharge')) }}
							{{ Form::label('noShappingCharge','No Shapping Charge on this product',array('class' => 'form-check-label')) }}
						</div>
					</div>
				</div>
    </div>
    <div class="col-sm-12 col-lg-4">
			<div class="card card-outline">
				<div class="card-body">
					<div class="form-group">
						{{ Form::label('status','Product Status',array('class' => '' )) }}
						{{ Form::select('status',[1=>'Active',0=>'Draft'],null,array('class'=>'form-control','required'=>'')) }}
					</div>
				</div>
				<!-- /.card-footer-->
			</div>
			<!-- /.card -->
			<div class="card card-outline">
				<div class="card-body">
					<div class="form-group">
						{{ Form::label('thumbnail','Product thumbnail',array('class' => '' )) }}
						@if ($mode=='edit')
						<br>
						<img width="100" height="80" data-toggle="modal" data-target="#thumbnailModal" src="{{ asset('storage/'.$product->thumbnail) }}" alt="Chenge thumbnail" class="img-thumbnail">
						@endif
					</div>
				</div>
				<!-- /.card-footer-->
			</div>
			<!-- /.card -->
			<div class="card card-outline">
				<div class="card-body">
						<div class="form-group">
							{{ Form::label('categories','Categories',array('class' => '' )) }}
							<div class="overflow-auto" style="max-height: 150px">
								@foreach ($categories as $item)
									<div class="checkbox">
										<label for="{{$item->id}}" class="form-check-label">
											@if ($mode=='edit')
												{{ Form::checkbox('categories[]', $item->id, in_array($item->id, $product->categories->pluck('id')->toArray()),['id'=>$item->id]) }}
											@else
												<input type="checkbox" name="categories[]" id="{{$item->id}}" value="{{$item->id}}">
											@endif
											{{$item->title}}
										</label>
									</div>
									@foreach ($item->child as $citem)
										<div class="checkbox ml-3">
											<label for="{{$citem->id}}" class="form-check-label">
												@if ($mode=='edit')
													{{ Form::checkbox('categories[]', $citem->id, in_array($citem->id, $product->categories->pluck('id')->toArray()),['id'=>$citem->id]) }}
												@else
													<input type="checkbox" name="categories[]" id="{{$citem->id}}" value="{{$citem->id}}">
												@endif
												{{$citem->title}}
											</label>
										</div>
									@endforeach
								@endforeach
							</div>
						</div>
				</div>
				<!-- /.card-footer-->
			</div>
			<!-- /.card -->
		<div class="text-center">{{ Form::submit('Save Product',array('class'=>'btn btn-success')) }}</div>
	</div>
</div>
{!! Form::close() !!}
<div class="row">
	<div class="col-sm-12 col-lg-8">
		@if ($mode=='edit')
			@livewire('product.variant', ['product' => $product, 'colors'=> $colors])
		@endif
	</div>
</div>
<!-- Default box -->

<div class="modal fade" id="thumbnailModal" tabindex="-1" role="dialog" aria-labelledby="thumbnailModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title">Select Photo</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			@if ($mode=='edit')
				@livewire('product.images', ['product' => $product, 'thumbnail'=>1])
			@endif
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
	  </div>
	</div>
  </div>

@endsection
@section('js')
<script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"> </script>
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous"></script> --}}
<script src="{{asset('assets/admin/js/bootstrap-tagsinput.js')}}"></script>
	<script>
			$(document).ready(function(){
				$('.textarea').summernote();

                /*
                                $('#type').change(function() {
                                        var variants = $('.variantaddremove');
                                        if(this.checked) {
                                            variants.removeClass("d-none");
                                            //variants.addClass("d-block");
                                        }else{
                                            variants.addClass("d-none");
                                        }
                                });


                                function capitalizeFirstLetter(string) {
                                    return string.charAt(0).toUpperCase() + string.slice(1);
                                }
                */
      });

    </script>

@endsection
