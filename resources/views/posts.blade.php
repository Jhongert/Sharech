@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/easy-autocomplete.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8">
            <div id="search-bar" >
                <input type="text" id="search" class="form-control" placeholder="Search for...">
       
                 <button class="btn btn-default" id="search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
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
    <script src="{{ asset('js/jquery.easy-autocomplete.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){

           

        var options = {
            url: function(phrase) {
                return "posts/search/" + phrase;
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

            template: {
                type: "custom",
                method: function(value, item) {
                    return '<a href="post/' + item.url + '">' + value + '</a>';  
                }
            },

            list: {
                onChooseEvent: function() {
                    var value = $('#search').getSelectedItemData().url;
                    window.location = '/post/' + value;
                }   
            }
        };

        $("#search").easyAutocomplete(options);

        $('#search').on('keyup', function(event){
            if(event.keyCode == 13) {
                alert('ll');
            }
        });
    });
    </script>
@endsection