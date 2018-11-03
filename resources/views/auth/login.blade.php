@extends('layouts.app')

@section('content')
    <div class="row no-gutters h-100">
        <div class="col-lg-3 col-md-5 login-form mx-auto my-auto">
            @include('shared.alert')
            <div class="card">
                <div class="card-body">
                    <img src="/images/logo.png" height="50" class="d-table mx-auto mb-3">
                    <h5 class="text-center mb-5">Login Into Your Account</h5>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">Remember Me</label>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-pill btn-accent d-table mx-auto">
                                Let's go
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex mt-3">
                <a class="btn pl-0 btn-link" href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            </div>
        </div>
    </div>
@endsection
