@extends('layouts.app')

@section('content')

    <div class="row">
        @if(Auth::guest())
            <div class="col-md-6">
           
            	<div class="row">
                    <div class="col-xs-4">
            		    <h1 class="text-center"><i class="fa fa-share-alt fa-3x"></i></h1>
                        <h1 class="text-center">Share</h1>
                    </div>
                    <div class="col-xs-4">
                        <h1 class="text-center"><i class="fa fa-search fa-3x"></i></h1>
                        <h1 class="text-center">Search</h1>
                    </div>
                    <div class="col-xs-4">
                        <h1 class="text-center"><i class="fa fa-users fa-3x"></i></h1>
                        <h1 class="text-center">Connect</h1>
            		</div>
            	</div>
                
                <div style="margin: 20px 0">
                    <p >is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </p>
                    <p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                @include('auth.signupform')
            </div>
        @else
            <h1>Dashboard</h1>
        @endif
    </div>

@endsection
