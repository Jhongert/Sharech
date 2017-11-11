@foreach ($posts as $post)
	<div class="col-md-6">
		<div class="post-item">
            
            <a class="avatar" href="{{ url('posts/user/' . $post->user->name) }}"><img class="img-circle" src="{{ "https://s3.amazonaws.com/radiantimages/avatar/" . $post->user->avatar }}"> <span>{{ $post->user->name }}</span></a>
			<span class="date">{{ date("F j, Y", strtotime($post->created_at)) }}</span>
    		<a href="{{ url('/post/' . $post->url )}}"><h3>{{ $post->title }}</h3></a>
    		<p>{{ $post->description }}</p>
    	</div>
	</div>
@endforeach