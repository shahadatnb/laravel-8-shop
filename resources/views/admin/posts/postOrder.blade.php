@extends('admin.layouts.layout')
@section('title',"Order")
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/jquery-ui/jquery-ui.min.css') }}">
<style>
    .sortable { list-style-type: none; margin: 0; padding: 0; }
    .sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; }
    .sortable li span { position: absolute; margin-left: -1.3em; }
</style>
@endsection
@section('content')
<!-- Default box -->
<div class="card">
  <div class="card-header">
  <div class="row">
    @if ($posttype['taxonomy']==true)
      @include('admin.posts.taxSelect',['route'=>'postOrder'])
    @endif
  </div>
  </div>
  <div class="card-body">
  @if ($posts != null)
    <ul id="sortable" class="sortable">
      @foreach($posts as $item)
        <li id="{{$item->id}}" class="ui-state-default">{{ $item->title }}
        </li>
      @endforeach
    </ul>
  @else
      <p>Select any Category</p>
  @endif

      
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
      Footer
  </div>
  <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection
@section('js')
<script src="{{ asset('assets/admin/plugins/jquery-ui/jquery-ui.min.js') }}"> </script>
<script>
$( function() {
      $( ".sortable" ).sortable({
          update: function(event, ui) {
          var productOrder = $(this).sortable('toArray').toString();
            //$("#sortable-9").text (productOrder);
          $.ajax({
              type:'POST',
              url:'{{route('post_sort')}}',
              
              data: {
                 _token: '{{ csrf_token() }}',
               ids: productOrder,
            },
              success:function(data) {
                  //$("#msg").html(data.msg);
                  console.log(data.msg);
              }
          });
            console.log(productOrder);
         }
         });
      //$( "#sortable" ).disableSelection();
  } );
  //data:'_token = {{ csrf_token() }}',
</script>
@endsection