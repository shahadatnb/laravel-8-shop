<div class="col-3">				
  {!! Form::open(array('route'=>$route,'method'=>'GET')) !!}
    {!! Form::hidden('type', $posttype['postType']) !!}
    <div class="input-group">
        {!! Form::select('taxonomy', $taxonomy, $taxId, ['class'=>'form-control','placeholder'=>'Category','required'=>'']) !!}
      <div class="input-group-append">
        {!! Form::submit('Select', ['class'=>'btn btn-primary']) !!}
      </div>
    </div>
  {!! Form::close() !!}
  </div>