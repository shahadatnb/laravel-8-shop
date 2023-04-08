@extends('admin.layouts.layout')
@section('title',"Product")
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" integrity="sha512-0p3K0H3S6Q4bEWZ/WmC94Tgit2ular2/n0ESdfEX8l172YyQj8re1Wu9s/HT9T/T2osUw5Gx/6pAZNk3UKbESw==" crossorigin="anonymous" />
{{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" /> --}}
<style>
	.select2-container {
		display: block;
	}
	#variants .form-control{
		min-width: 100px;
	}

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
</style>
<script src="//cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
@endsection
@section('content')
	@livewire('product.create', ['mode' => $mode,'store'=>$store,'categories'=>$categories,'colors'=>$colors,'sizes'=>$sizes])
@endsection
@section('js')
<script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"> </script>
<script src="//cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous"></script> --}}
<script src="{{asset('assets/admin/js/bootstrap-tagsinput.js')}}"></script>
	<script>
			$(document).ready(function(){
/*
				$('.attribute_option').on('itemAddedOnInit || itemAdded || itemRemoved', function(event) {
					var size = $("#attribute_option1").tagsinput('items');
					var color = $("#attribute_option2").tagsinput('items');
					var variants = $('#variants tbody');
					variants.empty();
					var output;
					for(var i=0; i<size.length; i++){
						if(color.length > 0){
							for(var j=0; j<color.length; j++){
								//console.log(size[i]+'_'+color[j]);
								output +=	'<tr>';
								output +=	'<td>'+size[i].toUpperCase()+' / '+capitalizeFirstLetter(color[j])+'<input name="cproduct['+i+j+'][size]" value="'+size[i].toUpperCase()+'" type="hidden"><input name="cproduct['+i+j+'][color]" value="'+capitalizeFirstLetter(color[j])+'" type="hidden"></td>';
								output +=	'<input name="cproduct['+i+j+'][title]" value="'+size[i].toUpperCase()+' / '+capitalizeFirstLetter(color[j])+'" type="hidden">';
								output +=	'<td> <input name="cproduct['+i+j+'][price]" type="number" class="form-control"> </td>';
								output +=	'<td> <input name="cproduct['+i+j+'][qty]" type="number" class="form-control"> </td>';
								//output +=	'<td> <input name="cproduct['+i+j+'][sku]" type="text" class="form-control"> </td>';
								output +=	'<td> <input name="cproduct['+i+j+'][barcode]" type="text" class="form-control"> </td>';								
								output +=	'<td><a href="#" class="btn btn-default vremove"> <i class="fas fa-trash-alt"></i> </a></td>';
								output +=	'</tr>';
							}							
						}else{
							output +=	'<tr>';
								output +=	'<td>'+size[i].toUpperCase()+'<input name="cproduct['+i+j+'][size]" value="'+size[i].toUpperCase()+'" type="hidden"></td>';
								output +=	'<input name="cproduct['+i+'][title]" value="'+size[i].toUpperCase()+' / '+capitalizeFirstLetter(color[j])+'" type="hidden">';
								output +=	'<td> <input name="cproduct['+i+'][price]" type="number" class="form-control"> </td>';
								output +=	'<td> <input name="cproduct['+i+'][qty]" type="number" class="form-control"> </td>';
								//output +=	'<td> <input name="cproduct['+i+'][sku]" type="text" class="form-control"> </td>';
								output +=	'<td> <input name="cproduct['+i+'][barcode]" type="text" class="form-control"> </td>';								
								output +=	'<td><a href="#" class="btn btn-default vremove"> <i class="fas fa-trash-alt"></i> </a></td>';
								output +=	'</tr>';
						}
					}
					//console.log(val1.length);
					variants.append(output);
				});

				function capitalizeFirstLetter(string) {
					return string.charAt(0).toUpperCase() + string.slice(1);
				}

				$("#variants").on('click', 'a.vremove', function(event) {
					event.preventDefault();
					$(this).closest('tr').remove();
				});
*/
      });
    </script>
		
@endsection