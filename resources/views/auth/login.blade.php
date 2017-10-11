@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div id="login-form">
                <h1>Login</h1>
                <form  method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    @if (count($errors) > 0)
                        <p class="alert alert-danger"><strong>Invalid Email or Password</strong></p>
                    @endif
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="E-Mail Address">
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            Login
                        </button>
                    </div>
                   
                    <div class="text-center">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                    <div class="text-center">
                        <a class="btn btn-link push-right" href="{{ route('register') }}">
                            Sign up!
                        </a>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>
@endsection
