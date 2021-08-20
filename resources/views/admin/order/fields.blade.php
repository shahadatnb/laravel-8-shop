@include('admin.layouts._message')
<div class="form-group">
    {{ Form::label('title','Category Title') }}
    {{ Form::text('title',null,array('class'=>'form-control','required'=>'','maxlenth'=>'255')) }}
</div>
<div class="form-group">
    {{ Form::label('parent_id','Parent Category') }}
    {{ Form::select('parent_id',$cats,null,array('class'=>'form-control','placeholder'=>'Parent Category')) }}
</div>
<div class="form-group">
    {{ Form::submit('Save',array('class'=>'btn btn-success')) }}
</div>