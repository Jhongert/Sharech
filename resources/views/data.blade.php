@foreach ($posts as $post)
	<div class="col-md-6">
		<div class="post-item" id="{{ $post->id }}">
            
            <a class="avatar" href="{{ url('/developer/' . $post->user->name) }}"><img class="img-circle" src="{{ "https://s3.amazonaws.com/radiantimages/avatar/" . $post->user->avatar }}"> <span>{{ $post->user->name }}</span></a>

    		<a href="{{ url('/post/' . $post->url )}}"><h3>{{ $post->title }}</h3></a>
    		<p>{{ $post->description }}</p>
    	</div>
	</div>
@endforeach