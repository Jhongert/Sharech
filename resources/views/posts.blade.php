@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/easy-autocomplete.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div id="search-bar" class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
    	@foreach ($posts as $post)
        	<div class="col-md-6">
        		<div class="post-item">
                    
                    <a class="avatar" href="#"><img class="img-circle" src="{{ asset('images/' . $post->user->avatar) }}"> <span>{{ $post->user->name }}</span></a>

            		<a href="{{ url('/post/' . $post->url )}}"><h3>{{ $post->title }}</h3></a>
            		<p>{{ $post->description }}</p>
            	</div>
        	</div>
        @endforeach
    </div>

@endsection

@section('page-script')
@endsection