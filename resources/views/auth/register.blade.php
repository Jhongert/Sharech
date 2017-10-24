@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            @include('auth.signupform')
        </div>
    </div>
</div>
@endsection

@section('page-script')
	<script type="text/javascript" src="{{ asset('js/helpers.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/users.js') }}"></script>
@endsection