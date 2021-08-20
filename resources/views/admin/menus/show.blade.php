@extends('admin.layouts.layout')
@section('page_title',"Menu")
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/jquery-ui/jquery-ui.min.css') }}">
<style>
    .sortable {
        list-style-type: none;
        margin-top: 10px;
        padding: 0;
    }
    .sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; }
    .sortable li span { position: absolute; margin-left: -1.3em; }
</style>
@endsection
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $menu->Title }}</h3>
        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        @include('admin.layouts._message')
        {!! Form::open(['route'=>'menuItem.store','method'=>'POST','class'=>'form']) !!}
        {!! Form::hidden('menu_id',$menu->id) !!}        
        @include('admin.menus.partial.fields')
        {!! Form::close() !!}
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Item List</h3>
        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">        
        <div class="row">
            <div class="col-md-5">
                <ul id="sortable" class="sortable">
                    @foreach ($menu->menuItem as $item)
                        @if ($item->subMenu->count()>0)
                            <li id="{{$item->id}}" class="ui-state-default">{{$item->lebel}}@include('admin.menus.partial.menuBatton',['item'=>$item])
                                <ul class="sortable">
                                    @foreach ($item->subMenu as $key=>$subItem)
                                        <li id="{{$subItem->id}}" class="ui-state-default">{{$subItem->lebel}} @include('admin.menus.partial.menuBatton',['item'=>$subItem])</li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li id="{{$item->id}}" class="ui-state-default">{{$item->lebel}}@include('admin.menus.partial.menuBatton',['item'=>$item])</li>                    
                        @endif
                    @endforeach            
                </ul>
            </div>
        </div>
        
    </div>
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
                    url:'{{route('menu_sl')}}',
                    
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