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
