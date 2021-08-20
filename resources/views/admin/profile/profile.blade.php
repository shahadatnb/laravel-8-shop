@extends('admin.layouts.layout')
@section('title',"Profile")
@section('content')
<div class="row">
    @include('admin.profile.leftSidebar')
    <div class="col-md-9">
    <div class="card">
        <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Profile info</a></li>            
            <li class="nav-item"><a class="nav-link" href="{{ route('editProfile')}}">Profile Edit</a></li>            
        </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            @include('admin.layouts._message')
        <div class="tab-content">
            <div class="active tab-pane" id="activity">
                <table class="table">
                    <tr>
                        <td>Name</td>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td>{{ Auth::user()->mobile }}</td>
                    </tr>
                </table>
            </div>            
        </div>
        <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection