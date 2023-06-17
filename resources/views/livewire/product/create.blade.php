<div
    x-data="{ isUploading: false, progress: 0 }"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
>

    <div wire:loading wire:target="save">
        @include('admin/layouts/_loading')
    </div>

@if ($mode=='edit')
    {!! Form::model($product,['route'=>['product.update',$product], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
@else
    {{-- {!! Form::open(array('route'=>'product.store','enctype'=>'multipart/form-data')) !!} --}}
    <form wire:submit.prevent="save">
@endif
<div class="row">
    <div class="col-sm-12 col-lg-8">
    <div class="card card-outline">
        <div class="card-body">
            <div class="form-group">
                {{ Form::label('title','Title',array('class' => '' )) }}
                {{ Form::text('title',null,array('class'=>'form-control' . ($errors->has('title') ? ' is-invalid' : null),'wire:model.lazy'=>'title')) }}
                @error('title')<span class="error invalid-feedback">{{ $message }}</span>@enderror
            </div>
            {{-- <div class="form-group">
                {{ Form::label('short_description','Short Description',array('class' => '' )) }}
                {{ Form::textarea('short_description',null,array('class'=>'form-control textarea','wire:model.lazy'=>'title','rows'=>'2')) }}
            </div> --}}
            <div class="form-group"  wire:ignore>
                {{ Form::label('description','Description',array('class' => '' )) }}
                {{ Form::textarea('description',null,array('class'=>'form-control summernote' . ($errors->has('title') ? ' is-invalid' : null),'wire:model.lazy'=>'description','rows'=>'5')) }}
                {{-- <textarea class="textarea summernote  @error('description') is-invalid @enderror" id="description" name="description" rows="5" wire:model.lazy="description" ></textarea> --}}
            </div>
            @error('description')<span class="error invalid-feedback d-block">{{ $message }}</span>@enderror
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
    <div class="card card-outline">
        <div class="card-body">
            <div class="row">
            @if ($photos)
                @foreach($photos as $photo)
                <div class="col-4 col-lg-3" wire:key="{{$loop->index}}">
                    <i class="fas fa-times-circle imaage-remove"
                        wire:click="tempPhotoRemove({{$loop->index}})"></i>
                    <div class="flex justify-center">
                        <img src="{{ $photo->temporaryUrl() }}" class="img-thumbnail">
                    </div>
                </div>
                @endforeach
            @endif
            <input x-ref="fileInput" type="file" multiple wire:model="photos" accept="image/*" class="hidden" />
            </div>
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
            @error('photos.*') <span class="error invalid-feedback d-block">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="card card-outline">
        <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
        {{ Form::label('price','Price',array('class' => '' )) }}
        {{ Form::number('price',null,array('class'=>'form-control' . ($errors->has('price') ? ' is-invalid' : null),'wire:model.lazy'=>'price')) }}
        @error('price')<span class="error invalid-feedback">{{ $message }}</span>@enderror
        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
        {{ Form::label('special_price','Special Price',array('class' => '' )) }}
        {{ Form::number('special_price',null,array('class'=>'form-control' . ($errors->has('special_price') ? ' is-invalid' : null),'wire:model.lazy'=>'special_price')) }}
        @error('special_price')<span class="error invalid-feedback">{{ $message }}</span>@enderror
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
        {{ Form::text('sku',null,array('class'=>'form-control' . ($errors->has('sku') ? ' is-invalid' : null),'wire:model.lazy'=>'sku')) }}
        @error('sku')<span class="error invalid-feedback">{{ $message }}</span>@enderror
    </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
        {{ Form::label('barcode','Barcode (ISBN, UPC, GTIN)',array('class' => '' )) }}
        {{ Form::text('barcode',null,array('class'=>'form-control' . ($errors->has('barcode') ? ' is-invalid' : null),'wire:model.lazy'=>'barcode')) }}
        @error('barcode')<span class="error invalid-feedback">{{ $message }}</span>@enderror
    </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
        {{ Form::label('qty','Quantity',array('class' => '' )) }}
        {{ Form::number('qty',null,array('class'=>'form-control' . ($errors->has('qty') ? ' is-invalid' : null),'wire:model.lazy'=>'qty')) }}
        @error('qty')<span class="error invalid-feedback">{{ $message }}</span>@enderror
    </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
        {{ Form::checkbox('trackQuantity',1,null,array('class'=>'form-check-input','id'=>'trackQuantity','wire:model.lazy'=>'trackQuantity')) }}
        {{ Form::label('trackQuantity','Track Quantity',array('class' => 'form-check-label' )) }}
        </div>
                        <div class="form-check">
        {{ Form::checkbox('stockOutSell',1,null,array('class'=>'form-check-input','id'=>'stockOutSell','wire:model.lazy'=>'stockOutSell')) }}
        {{ Form::label('stockOutSell','Continue selling when out of stock',array('class' => 'form-check-label' )) }}
        </div>
                    </div>
                </div>
        </div>
    </div>
    @if ($mode=='create')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Details</h3>
        </div>
        <div class="card-body">
            <div class="form-check">
                {{ Form::checkbox('type','variant',null,array('class'=>'form-check-input','id'=>'type','wire:model.lazy'=>'type')) }}
                {{ Form::label('type','Variant',array('class' => 'form-check-label' )) }}
                {{-- {{ Form::select('type',['simple'=>'Simple','variant'=>'Variant'],null,array('class'=>'form-control','wire:model.lazy'=>'title')) }} --}}

            </div>
            <div class="row variantaddremove @if($type != 'variant') d-none @endif">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('attributes','Attribute Name',array('class' => '' )) }}
                        {{ Form::select('attributes[]',['1'=>'Size'],null,array('class'=>'form-control','wire:model'=>'selectAttributes.1', 'placeholder'=>'Select')) }}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="@if(!in_array("1", $selectAttributes)) d-none @endif">
                        <div class="form-group " wire:ignore>
                            {{ Form::label('size','Attribute Value',array('class' => '' )) }}
                                {{-- {{ Form::select('attribute_options[]',[],null,array('class'=>'form-control select2-multi')) }} --}}
                                {{-- {{ Form::text('size',null,array('class'=>'form-control attribute_option', 'data-role'=>'tagsinput')) }} --}}
                                {{ Form::select('size',$sizes,null,array('class'=>'form-control select2-multi attribute_option','wire:model'=>'size','multiple'=>true)) }}

                        </div>
                    </div>
                </div>
            </div>
            <div class="row variantaddremove  @if($type != 'variant') d-none @endif">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('attributes','Attribute Name',array('class' => '' )) }}
                        {{ Form::select('attributes[]',['2'=>'Color'],null,array('class'=>'form-control','wire:model'=>'selectAttributes.2', 'placeholder'=>'Select')) }}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="@if(!in_array("2", $selectAttributes)) d-none @endif">
                    <div class="form-group" wire:ignore>
                        {{ Form::label('color','Attribute Value',array('class' => '' )) }}
                        {{-- {{ Form::select('attribute_options[]',[],null,array('class'=>'form-control select2-multi')) }} --}}
{{--                        {{ Form::text('color',null,array('class'=>'form-control attribute_option','data-role'=>'tagsinput')) }}--}}
                         {{ Form::select('color',$colors,null,array('class'=>'form-control select2-multi attribute_option','wire:model'=>'color','multiple'=>true)) }}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card variantaddremove @if($type != 'variant') d-none @endif">
        <div class="card-header">
            <h3 class="card-title">Variants</h3>
        </div>
        <div class="card-body">
            {{-- @dump($errors->get('productvariant.*'))
            @error('productvariant.*.size')<span class="error invalid-feedback d-block">{{ $message }}</span>@enderror
            @error('productvariant.*.color')<span class="error invalid-feedback d-block">{{ $message }}</span>@enderror
            @error('productvariant.*.price')<span class="error invalid-feedback d-block">{{ $message }}</span>@enderror
            @error('productvariant.*.sku')<span class="error invalid-feedback d-block">{{ $message }}</span>@enderror
            @error('productvariant.*.qty')<span class="error invalid-feedback d-block">{{ $message }}</span>@enderror
            @error('productvariant.*.barcode')<span class="error invalid-feedback d-block">{{ $message }}</span>@enderror --}}
            @if(count($errors->get('productvariant.*'))>0)
                <div class="alert alert-danger">
                    <strong>Errors: </strong>
                    <ul>
                        @foreach($errors->get('productvariant.*') as $verror)
                            @foreach ($verror as $vitem)
                                <li>{{ $vitem }}</li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table" id="variants">
                    <thead>
                        <tr>
                            <th>Variant</th>
                            <th>Price</th>
                            <th>S Price</th>
                            <th>Quantity</th>
                            <th>SKU</th>
                            <th>Barcode</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @empty(!$productvariant)
                        {{-- @dump($productvariant) --}}
                            @foreach ($productvariant as $key=>$item)
                                <tr>
                                    <td>
                                        @if(!empty($item['size']) && !empty($item['color']))
                                            {{ $item['size'] }} / {{$item['color']}} - {{$key}}
                                        @elseif(!empty($item['size']))
                                            {{ $item['size'] }}
                                        @elseif(!empty($item['color']))
                                            {{ $item['color'] }}
                                        @endif
                                    </td>
                                    <input wire:model="productvariant.{{$key}}" type="hidden">
                                    <input wire:model="productvariant.{{$key}}.size" value="" type="hidden">
                                    <input wire:model="productvariant.{{$key}}.color" value="" type="hidden">
                                    <td><input wire:model="productvariant.{{$key}}.price" required type="number" class="form-control"></td>
                                    <td><input wire:model="productvariant.{{$key}}.special_price" type="number" class="form-control"></td>
                                    <td><input wire:model="productvariant.{{$key}}.qty" type="number" class="form-control"></td>
                                    <td><input wire:model="productvariant.{{$key}}.sku" type="text" class="form-control"></td>
                                    <td><input wire:model="productvariant.{{$key}}.barcode" type="text" class="form-control"></td>
                                    <td><button wire:click="vremove({{$key}})" class="btn btn-sm btn-dander"><i class="fas fa-trash-alt"></i></button></td>
                                </tr>
                            @endforeach
                        @endempty
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Shipping</h3>
        </div>
        <div class="card-body">
            <div class="form-check">
                {{ Form::checkbox('readyToShipping',1,null,array('class'=>'form-check-input','id'=>'readyToShipping','wire:model.lazy'=>'readyToShipping')) }}
                {{ Form::label('readyToShipping','Ready To 100% Shipping',array('class' => 'form-check-label' )) }}
            </div>
            <div class="form-check">
                {{ Form::checkbox('noShappingCharge',1,null,array('class'=>'form-check-input','id'=>'noShappingCharge','wire:model.lazy'=>'noShappingCharge')) }}
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
                        {{ Form::select('status',[1=>'Active',0=>'Draft'],null,array('class'=>'form-control','wire:model'=>'status')) }}
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
                                            <input type="checkbox" name="categories[]", wire:model = 'selectcategories', id="{{$item->id}}" value="{{$item->id}}">
                                        @endif
                                        {{$item->title}}
                                    </label>
                                </div>
                                @foreach($item->child as $citem)
                                    <div class="checkbox ml-3">
                                        <label for="{{$citem->id}}" class="form-check-label">
                                            @if ($mode=='edit')
                                                {{ Form::checkbox('categories[]', $citem->id, in_array($citem->id, $product->categories->pluck('id')->toArray()),['id'=>$citem->id]) }}
                                            @else
                                                <input type="checkbox" name="categories[]", wire:model = 'selectcategories' id="{{$citem->id}}" value="{{$citem->id}}">
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
</div>

@push('scripts')
<script>
    $('.summernote').summernote({
      tabsize: 2,
      height: 200,
      toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
      ],
      callbacks: {
          onChange: function(contents, $editable) {
          @this.set('description', contents);
        }
    }
  });

  $('.attribute_option').on('itemAdded || itemRemoved || change', function(event) { //itemAddedOnInit
		//var size = $("#size").tagsinput('items');
		var size = $("#size").val();
		//var color = $("#color").tagsinput('items');
      var color = $("#color").val();
      //console.log(color);
        @this.set('size', size);
        @this.set('color', color);
        Livewire.emit('selectVariants');
  })

/*
    $('#size').select2();
    $('#color').select2();

    $('#size').on('change', function (e) {
        var data = $('#size').select2("val");
        @this.set('size', data);
    });

    $('#color').on('change', function (e) {
        var data = $('#color').select2("val");
        @this.set('color', data);
    });
*/
</script>
@endpush
