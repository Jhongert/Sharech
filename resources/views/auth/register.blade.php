@extends('layouts.app')

@section('css')
    <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            @include('auth.signupform')
        </div>
    </div>
</div>
@endsection