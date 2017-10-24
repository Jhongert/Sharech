@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/easy-autocomplete.min.css')}}">
@endsection

@section('content')
    <div class="row ">
        <div class="col-md-6">
            <div id="search-bar" >
                <input type="text" id="search"  placeholder="Search for...">
             </div>
        </div>
    </div>

    <div class="row">
        @if (count($posts) > 0)
        	@foreach ($posts as $post)
            	<div class="col-md-6">
            		<div class="post-item">
                        
                        <a class="avatar" href="{{ url('/developer/' . $post->user->name) }}"><img class="img-circle" src="{{ "https://s3.amazonaws.com/radiantimages/avatar/" . $post->user->avatar }}"> <span>{{ $post->user->name }}</span></a>

                		<a href="{{ url('/post/' . $post->url )}}"><h3>{{ $post->title }}</h3></a>
                		<p>{{ $post->description }}</p>
                	</div>
            	</div>
            @endforeach
        @else
            <div class="col-sm-12">
                <h1 class="text-center">Sorry, we could not find any post!</h1>
            </div>
        @endif
    </div>

@endsection

@section('page-script')
    <script src="{{ asset('js/jquery.easy-autocomplete.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){ 

            var options = {
                url: function(phrase) {
                    return "/posts/search/" + phrase;
                },

                getValue: function(element) {
                    return element.title;
                   
                },

                ajaxSettings: {
                    headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    method: "POST",
                    data: {
                        dataType: "json"
                    }
                },

                requestDelay: 200,

                list: {
                    onChooseEvent: function() {
                        var value = $('#search').getSelectedItemData().url;
                        window.location = '/post/' + value;
                    }   
                }
            };

            $("#search").easyAutocomplete(options);
        });
    </script>
@endsection