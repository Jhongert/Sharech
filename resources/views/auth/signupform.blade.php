<div id="signup-form">
    <h1>Sign up</h1>
    <form  method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name">User name</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus autocomplete="off" placeholder="Alphanumeric, 5-16 characters">
            <span class="help-block">
                @if ($errors->has('name'))
                    <strong>{{ $errors->first('name') }}</strong>
                @endif
            </span>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">E-Mail Address</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            <span class="help-block">
                @if ($errors->has('email'))
                    <strong>{{ $errors->first('email') }}</strong>
                @endif
            </span>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control" name="password" required placeholder="6 or more characters">

            <span class="help-block">
                @if ($errors->has('password'))
                    <strong>{{ $errors->first('password') }}</strong>
                @endif
            </span>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
        
         <div class="form-group{{ $errors->has('CaptchaCode') ? ' has-error' : '' }}">
            {!! captcha_image_html('RegisterCaptcha') !!}
            <input class="form-control" type="text" id="CaptchaCode" name="CaptchaCode" placeholder="Captcha">
            <span class="help-block">
                @if ($errors->has('CaptchaCode'))
                    <strong>{{ $errors->first('CaptchaCode') }}</strong>
                @endif
            </span>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">
                Create Account
            </button>
        </div>
    </form>
</div>
@section('page-script')
    <script type="text/javascript" src="{{ asset('js/helpers.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/users.js') }}"></script>
@endsection