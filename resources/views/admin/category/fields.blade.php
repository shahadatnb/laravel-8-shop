@include('admin.layouts._message')
<div class="form-group">
    {{ Form::label('title','Category Title') }}
    {{ Form::text('title',null,array('class'=>'form-control','required'=>'','maxlenth'=>'255')) }}
</div>
<div class="form-group">
    {{ Form::label('parent_id','Parent Category') }}
    {{ Form::select('parent_id',$cats,null,array('class'=>'form-control','placeholder'=>'Parent Category')) }}
</div>
@if ($mode=='edit')
 <img width="100" src="{{ asset('storage/'.$category->image) }}" alt="" class="img-thumbnail">
@endif
<div class="form-group">
    {{ Form::label('image','Image') }}
    {{ Form::file('image',null,array('class'=>'form-control','placeholder'=>'Image')) }}
</div>
<div class="form-group">
    {{ Form::submit('Save',array('class'=>'btn btn-success')) }}
    <script>
        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });
    </script>
</div>
