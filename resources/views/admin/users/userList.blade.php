@extends('admin.layouts.layout')
@section('title',ucfirst($role)." List")
@section('css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.css"/>
{{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.css"/> --}}
@endsection
@section('content')

<!-- DataTables Example -->
<div class="card my-3">
    {{-- <div class="card-header">
        <i class="fas fa-table"></i>
        {{ucfirst($role)}} list</div> --}}
    <div class="card-body">
        <div class="table-responsive">
        <table id="users" class="table table-bordered" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Email</th>
                <th>Tools</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Email</th>
                <th>Tools</th>
            </tr>
            </tfoot>
            <tbody>
                @foreach ($users as $key=>$user)                          
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['email']}}</td>                    
                        <td>
                            <a href="{{route('editUser',[$role,$user->id])}}" class="btn btn-primary btn-sm">Edit</a>
                            <form class="delete" action="{{ route('users.destroy',$user->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure To Delete This Item?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>       
    </div>       
</div>       

@endsection

@section('js')
 
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.js"></script>
{{-- <script type="text/javascript" src="//cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/fh-3.1.8/r-2.2.7/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.js"></script> --}}

<script>

    $(document).ready(function() {
        $('#users').DataTable( {
            dom: 'Bfrtip',
            "paging":   true,
            //"ordering": false,
        } );

    } );
</script>
@endsection