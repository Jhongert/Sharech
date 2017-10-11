@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	@foreach ($posts as $post)
        	<div class="col-md-6">
        		<div class="post-item">
                    <p><a href="#">{{ $post->user->name }}</a></p>
            		<a href="{{ url('/post/' . $post->url )}}"><h3>{{ $post->title }}</h3></a>
            		<p>{{ $post->description }}</p>
            		<a href="{{ url('/post/' . $post->url )}}">Read more...</a>
            	</div>
        	</div>
        @endforeach
    </div>
</div>
@endsection