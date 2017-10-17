@extends('layouts.app')

@section('content')
    <div class="row">
		
        <div class="col-md-6">
        	<div id="user-avatar">
        		<h3>Change picture</h3>
            	

            	@if (count($errors) > 0)
					<div class="alert alert-danger">
						<strong>Whoops!</strong> There were some problems with your input.<br><br>
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				@if ($message = Session::get('success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>	
					    <strong>{{ $message }}</strong>
					</div>
				@endif

            	<img src="{{ asset('avatar/' . \Auth::User()->avatar) }}" >
				<form method="post" action="/user/image" enctype="multipart/form-data">
					{{ csrf_field() }}
			        <div class="form-group">
			            <input type="file" name="image" required>
			        </div>
			        <div class="form-group">
			            <button type="submit" class="btn btn-primary btn-block">
			                Upload new picture
			            </button>
			        </div>
				</form>
            </div>
        </div>

        <div class="col-md-6">
            <div id="changepassword-form">
 				<h3>Change password</h3>
			    <form  method="POST" action="{{ route('register') }}">
			        {{ csrf_field() }}
			        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			        	<label>Old password</label>
			            <input id="old-password" type="text" class="form-control" name="old-password" value="{{ old('name') }}" required autofocus>

			            @if ($errors->has('name'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('name') }}</strong>
			                </span>
			            @endif
			        </div>

			        

			        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			        	<label>New password</label>
			            <input id="password" type="password" class="form-control" name="password" required>

			            @if ($errors->has('password'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('password') }}</strong>
			                </span>
			            @endif
			        </div>

			        <div class="form-group">
			        	<label>Confirm password</label>
			            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
			        </div>

			        <div class="form-group">
			            <button type="submit" class="btn btn-primary btn-block">
			                Change password
			            </button>
			        </div>
			    </form>
			</div>
        </div>
    </div>
@endsection