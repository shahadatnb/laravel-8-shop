<div class="col-md-3">

<!-- Profile Image -->
<div class="card card-primary card-outline">
    <div class="card-body box-profile">
    <div class="text-center">
        {{-- @if(Auth::user()->profile->photo != '')
            @php $profilePhoto='storage/'.Auth::user()->profile->photo @endphp
        @else --}}
            @php $profilePhoto='assets/admin/img/avatar.png' @endphp
        {{-- @endif --}}
        <img class="profile-user-img img-fluid img-circle"
            src="{{asset('/').$profilePhoto}}"
            alt="{{Auth::user()->name}}">
    </div>

    <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
<!-- 
    <p class="text-muted text-center">Software Engineer</p>

    <ul class="list-group list-group-unbordered mb-3">
        <li class="list-group-item">
        <b>Followers</b> <a class="float-right">1,322</a>
        </li>
        <li class="list-group-item">
        <b>Following</b> <a class="float-right">543</a>
        </li>
        <li class="list-group-item">
        <b>Friends</b> <a class="float-right">13,287</a>
        </li>
    </ul>

    <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- About Me Box -->
<!-- <div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title">About Me</h3>
    </div>
    <div class="card-body">
    <strong><i class="fas fa-book mr-1"></i> Education</strong>

    <p class="text-muted">
        B.S. in Computer Science from the University of Tennessee at Knoxville
    </p>

    <hr>
    </div>
</div> -->
<!-- /.card -->
</div>
<!-- /.col -->