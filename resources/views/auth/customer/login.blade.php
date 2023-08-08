@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <p class="login-box-msg">Customer sign in</p>
                <div class="card-body">
                    <form method="POST" action="{{ route('customer.loginPost') }}">
                        @csrf
                        {{-- @include('admin.layouts._message') --}}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('customer.password.request'))
                                    <a class="btn btn-link" href="{{ route('customer.password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <br>
                                Not Registard? <a class="btn btn-link" href="{{ route('customer.register') }}">
                                    {{ __('Register') }}
                                </a>
                            </div>
                    </form>
                        <div class="row">
                        <h5 class="text-center">Or</h5>
                            <div class="col-12 text-center">
                                <a href="{{ route('social.redirect','google') }}" class="btn btn-danger">Login with Google</a>
                                <a href="{{ route('social.redirect','facebook') }}" class="btn btn-primary">Login with Facebook</a>
                                <a href="{{ route('social.redirect','github') }}" class="btn btn-success">Login with Github</a>
                            </div>
                        </div>
                        
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
