@extends('layouts.app')

 @section('css')
    <link href="{{ asset('css/prism.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jssocials.css') }}" rel="stylesheet">
 @endsection

@section('content')

    <div class="row">
    	<div class="col-md-8">
    		<div id="post">
        		<h1>{{ $post->title }}</h1>
        		<p>{{ $post->description }}</p>
                <div>{!! $post->content !!}</div>

                <div id="share" class="text-center"></div>

				<div id="comments-container">
                    @if (count($post->tags) > 0)
                        <div id="tags">
                            <ul>
                                <li class="tag"><i class="fa fa-tag" aria-hidden="true"></i></li>
                            @foreach ($post->tags as $tag)
                                <li class="tag"><a href="{{ url('/tag/' . $tag->name)}}">{{$tag->name}}</a></li>
                            @endforeach
                            </ul>
                        </div>
                    @endif

					<p><i class="fa fa-commenting-o" aria-hidden="true"></i> Comments</p>

					@foreach ($comments as $comment)
                        <div class="comment-item">
                            <a class="avatar" href="{{ url('/developer/' . $comment->user->name) }}"><img class="img-circle" src="{{ asset('avatar/' . $comment->user->avatar) }}"> <span>{{ $comment->user->name }}</span></a>

						
						    <div>{{ $comment->content }}</div>
                        </div>
					@endforeach
				</div>
                @if(Auth::check())
					<div id="comments-form">
						
		                <div class="form-group">
		                    <textarea id="content" name="content" placeholder="Add a comment"></textarea>
		                </div>
            			<div class="form-group clearfix">
                    		<button class="btn btn-primary" id="save-post" data-post-id={{ $post->id }}>Post</button>
                		</div>
					</div>
			    @endif
        	</div>
    	</div>
    	<div class="col-md-4">
            @if(count($related) > 0)
                <div id="related-posts">
                    <h3>See also</h3>
                    <ul>
                        @foreach ($related as $link)
                            <li class="related-link">
                                <a href="{{ url('/post/' . $link->url) }}">{{ $link->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
    	</div>
    </div>

@endsection

@section('page-script')
    <script type="text/javascript" src="{{ asset('js/prism.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/post.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jssocials.min.js') }}"></script>
@endsection