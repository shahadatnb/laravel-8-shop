<div>
    @include('admin.layouts._message_noty')

    <div wire:loading wire:target="save">
        @include('admin/layouts/_loading')
    </div>
    <div wire:loading wire:target="addVariant">
        @include('admin/layouts/_loading')
    </div>

<form wire:submit.prevent="save">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Variants</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addVariant">Add</button>
                <button  type="submit" class="btn btn-sm btn-primary">Update all</button>
            </div>
        </div>
        <div class="card-body">
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
                            <th>Size</th>
                            <th>Color</th>
                            <th>Price</th>
                            <th>Sell Price</th>
                            <th>SKU</th>
                            <th>Barcode</th>
                            <th></th>
                        </tr>
                        @foreach ($productvariant as $item)
                            <tr>
                                {{-- @empty(!$item->size) / {{$item->size}}  @endempty --}}
                                <td>
                                    @if(!empty($item['size']) && !empty($item['color']))
                                        {{ $item['size'] }} / {{$item['color']}} - {{$item['id']}}
                                    @elseif(!empty($item['size']))
                                        {{ $item['size'] }}
                                    @elseif(!empty($item['color']))
                                        {{ $item['color'] }}
                                    @endif
                                </td>
                                <input type="hidden" wire:model="productvariant.{{$item['id']}}.id" value="{{$item['id']}}">
                                <td><input wire:model="productvariant.{{$item['id']}}.size" class="form-control" value="{{$item['size']}}" name="size" type="text"></td>
                                <td wire:ignore>
                                    {{ Form::select('productvariant.'.$item['id'].'.color',$colors,$item['color'],array('class'=>'form-control select2 v-color')) }}

{{--                                    <input wire:model="productvariant.{{$item['id']}}.color" class="form-control" value="{{$item['color']}}" name="color" type="text">--}}
                                </td>
                                <td><input wire:model="productvariant.{{$item['id']}}.price" class="form-control" value="{{$item['price']}}" name="price" type="number"></td>
                                <td><input wire:model="productvariant.{{$item['id']}}.special_price" class="form-control" value="{{$item['special_price']}}" name="special_price" type="number"></td>
                                <td><input wire:model="productvariant.{{$item['id']}}.sku" class="form-control" value="{{$item['sku']}}" name="vskus" type="text"></td>
                                <td><input wire:model="productvariant.{{$item['id']}}.barcode" class="form-control" value="{{$item['barcode']}}" name="barcode" type="text"></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        {{-- <a  href="#" class="btn btn-sm btn-primary">Edit</a> --}}
                                        <button wire:click="delete({{ $item['id']}})" type="button" class="btn btn-sm btn-danger">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addVariant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Variant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{----}}
                    @if(count($errors->get('newVariant.*'))>0)
                        <div class="alert alert-danger">
                            <strong>Errors: </strong>
                            <ul>
                                @foreach($errors->get('newVariant.*') as $verror)
                                    @foreach ($verror as $vitem)
                                        <li>{{ $vitem }}</li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form>
                        <div class="form-group row">
                            {{ Form::label('newVariant.size','Size',array('class' => 'col-sm-3 col-form-label' )) }}
                            {{ Form::text('newVariant.size',null,array('class'=>'form-control col-sm-9' . ($errors->has('newVariant.size') ? ' is-invalid' : null),'wire:model.lazy'=>'newVariant.size')) }}
                            {{-- {{ Form::select('newVariant.size',$sizes,null,array('class'=>'form-control col-sm-9 select2 n-size','placeholder'=>'Select Size','wire:model.lazy'=>'newVariant.size')) }} --}}
                            @error('newVariant.size') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group row" wire:ignore>
                            {{ Form::label('newVariant.color','Color',array('class' => 'col-sm-3 col-form-label' )) }}
                            {{ Form::select('newVariant.color',$colors,null,array('class'=>'form-control col-sm-9 select2 n-color','placeholder'=>'Select Color')) }}
                            @error('newVariant.color') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group row">
                            {{ Form::label('newVariant.price','Price',array('class' => 'col-sm-3 col-form-label' )) }}
                            {{ Form::text('newVariant.price',null,array('class'=>'form-control col-sm-9' . ($errors->has('newVariant.price') ? ' is-invalid' : null),'wire:model.lazy'=>'newVariant.price')) }}
                            @error('newVariant.price') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group row">
                            {{ Form::label('newVariant.special_price','Sell Price',array('class' => 'col-sm-3 col-form-label' )) }}
                            {{ Form::text('newVariant.special_price',null,array('class'=>'form-control col-sm-9' . ($errors->has('newVariant.special_price') ? ' is-invalid' : null),'wire:model.lazy'=>'newVariant.special_price')) }}
                            @error('newVariant.special_price') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group row">
                            {{ Form::label('newVariant.qty','Quantity',array('class' => 'col-sm-3 col-form-label' )) }}
                            {{ Form::text('newVariant.qty',null,array('class'=>'form-control col-sm-9' . ($errors->has('newVariant.qty') ? ' is-invalid' : null),'wire:model.lazy'=>'newVariant.qty')) }}
                            @error('newVariant.qty') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group row">
                            {{ Form::label('newVariant.sku','SKU',array('class' => 'col-sm-3 col-form-label' )) }}
                            {{ Form::text('newVariant.sku',null,array('class'=>'form-control col-sm-9' . ($errors->has('newVariant.sku') ? ' is-invalid' : null),'wire:model.lazy'=>'newVariant.sku')) }}
                            @error('newVariant.sku') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group row">
                            {{ Form::label('newVariant.barcode','Barcode Type',array('class' => 'col-sm-3 col-form-label' )) }}
                            {{ Form::text('newVariant.barcode',null,array('class'=>'form-control col-sm-9' . ($errors->has('newVariant.barcode') ? ' is-invalid' : null),'wire:model.lazy'=>'newVariant.barcode')) }}
                            @error('newVariant.barcode') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="addVariant()" class="btn btn-primary close-modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    window.livewire.on('newVariantSaved', () => {
        $('#addVariant').modal('hide');
    });

    $('.v-color').on('change', function(event) {
        var color = $(this).val();
        var name = $(this).attr("name");
        //console.log(name);
    @this.set(name, color);
    });

    $('.n-color').on('change', function(event) {
        var color = $(this).val();
        //console.log(name);
        @this.set('newVariant.color', color);
    });
</script>
@endpush
