@extends('layouts.app')

@section('content')
    <div class="row">
		
        <div class="col-md-6">
        	<div id="user-avatar">
        		<h3>Change picture</h3>
            	

            	@if ($errors->has('image'))
					<div class="alert alert-danger alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>	
						<strong>{{ $errors->first('image') }}</strong>
					</div>
				@endif

				@if ($message = Session::get('uploaded'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>	
					    <strong>{{ $message }}</strong>
					</div>
				@endif

            	<img src="{{ "https://s3.amazonaws.com/radiantimages/avatar/" . \Auth::User()->avatar }}" >
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

 				@if ($message = Session::get('wrongPassword'))
					<div class="alert alert-danger alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>	
						<strong>{{ $message }}</strong> 
					</div>
				@endif

 				@if ($message = Session::get('passwordOk'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>	
					    <strong>{{ $message }}</strong>
					</div>
				@endif

			    <form  method="POST" action="/user/password">
			        {{ csrf_field() }}
			        <div class="form-group{{ $errors->has('oldPassword') ? ' has-error' : '' }}">
			        	<label>Old password</label>
			            <input id="oldPassword" type="password" class="form-control" name="oldPassword" required autofocus>

			            @if ($errors->has('oldPassword'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('oldPassword') }}</strong>
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