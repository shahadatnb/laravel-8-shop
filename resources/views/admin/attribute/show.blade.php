@extends('admin.layouts.layout')
@section('title',"Attribute ".$attribute->name)
@section('css')
     <link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
@endsection
@section('content')

<!-- Default box -->
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                {!! Form::open(array('route'=>'attribute.option.add')) !!}
                <div class="form-inline">
                    {{ Form::text('name',null,array('class'=>'form-control','required'=>true,'placeholder'=>'Name')) }}
                    {{ Form::hidden('attribute_id',$attribute->id)  }}
                    <div class="input-group my-colorpicker2">
                        <input type="text" name="label" {{ $attribute->code=='color'? 'required':'' }} class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-square"></i></span>
                        </div>
                    </div>
                    {{ Form::submit('Save',array('class'=>'btn btn-success')) }}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Label</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($attribute->attoption as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->label }}</td>
                            <td>
                                <a href="{{ route('attribute.option.delete', $data->id) }}" class="btn btn-warning btn-xs">Delete</a>
                                {{--
                                <form class="delete" action="{{ route('category.destroy',$data) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are You Sure To Delete This Item?')"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                                --}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"> </script>
    <script>
        $(function() {
            $('.my-colorpicker2').colorpicker()
            $('.my-colorpicker2').on('colorpickerChange', function(event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            });
        });
    </script>
@endsection
