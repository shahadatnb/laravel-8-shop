@extends('auth.layout')
@section('content')
<div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Customer registration confirmation</p>

      <form action="{{ route('customer.confirm') }}" method="post">
        @csrf
        @include('admin.layouts._message')
        <div class="input-group mb-3">
          <input type="text" name="otp" class="form-control" placeholder="OTP" data-inputmask="'mask': '999999'">
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
@endsection
@section('js')
    <script>
      (function ($) {
      'use strict'
          $(":input").inputmask();
    })(jQuery)
    </script>
@endsection