<div class="row">
    <div class="col-sm-4">
        <!-- text input -->
        <div class="form-group">
            {!! Form::label('lebel', __('Lebel')) !!}
            {!! Form::text('lebel',null,['class'=>'form-control','required'=>'required','placeholder'=> __('Lebel')]) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('menu_url', __('Menu URL')) !!}
            {!! Form::text('menu_url',null,['class'=>'form-control','required'=>'required','placeholder'=> __('Menu Url')]) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('menu_class', __('Menu Class')) !!}
            {!! Form::text('menu_class',null,['class'=>'form-control','placeholder'=> __('Menu Class')]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('parent_id', __('Menu Parent')) !!}
            {!! Form::select('parent_id',$parent_id,null,['class'=>'form-control','placeholder'=> __('Menu Parent')]) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('menuType', __('Menu Type')) !!}{{-- ,'placeholder'=> __('Menu Type') --}}
            {!! Form::select('menuType',$menuType,null,['class'=>'form-control','required'=>'required']) !!}
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            {!! Form::label('save', '&nbsp;') !!}
            {!! Form::submit('Save', ['class'=>'btn btn-success']) !!}
        </div>
    </div>
</div>