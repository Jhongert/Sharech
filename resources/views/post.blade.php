@extends('layouts.app')

 @section('css')
    <link href="{{ asset('css/prism.css') }}" rel="stylesheet">
 @endsection

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-8">
    		<div id="post">
        		<h1>{{ $post->title }}</h1>
        		<div>{{ $post->description }}</div>
                <div>{!! $post->content !!}</div>
				<div id="comments-container">
					<h3>Comments</h3>
					@foreach ($comments as $comment)
						<a href="#">{{ $comment->user->name }}</a>
						<div>{{ $comment->content }}</div>
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
    	</div>
    </div>
</div>
@endsection

@section('page-script')
    <script src="{{ asset('js/prism.js') }}"></script>
    <script type="text/javascript">
    	$('#save-post').on('click', function(){
    		//check for empty description
	        var content = $('#content');
	        if (content.val().trim() == ""){
	            var $l = $('<label class="text-danger small">');
	            $l.text('Enter the content');
	            $('#content').after($l);
	            return false;
	        }

	        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = {
                content: $('#content').val().trim(),
                post_id: $(this).data('post-id')
            };

            $.ajax({
                type: 'POST',
                url: '/comment',
                data: data,
                success: function(data){
                    if(data != 'error'){
                    	var $a = $('<a>');
                    	$a.attr('href', '#').text(data);
                    	$('#comments-container').append($a);

                    	var $div = $('<div class"comment-item">');
                    	$div.append($('#content').val().trim());
                    	$('#comments-container').append($div);

                    	$('#content').val('');
                    } else {
                    	console.log(data);
                    }
                }
            });
	    });
    </script>
@endsection