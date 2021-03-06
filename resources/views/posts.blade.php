@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/easy-autocomplete.min.css')}}">
@endsection

@section('content')
    <div class="row ">
        <div class="col-md-6 col-md-offset-3">
            <div id="search-bar" >
                <input type="text" id="search"  placeholder="Search">
             </div>
        </div>
    </div>

    <div class="row" id="posts-container">
        @if (isset($tag))
            <div class="col-sm-12">
                <h4>Posts tagged with {{$tag}}</h4>
            </div>
        @endif

        @if (count($posts) > 0)
            @include('data')
        @else
            <div class="col-sm-12">
                <h1 class="text-center">Sorry, we could not find any post!</h1>
            </div>
        @endif
    </div>
     <div class="ajax-load text-center">
        <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
    </div>
    <p class="text-center end-of-page">There are no more posts to show</p>
    <div id="to-top">
        <span><i class="fa fa-arrow-up" aria-hidden="true"></i></span>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/jquery.easy-autocomplete.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){ 
            var offset = 6;

            var path = window.location.pathname;
            var params = path.split('/');

            if (!params[2]) {
                var url = '/posts/getPosts/';
            } else if (params[2] === 'tag') {
                var url = '/posts/getPostsByTagName/' + params[3] + '/';
            } else {
                var url = '/posts/getPostsByUserName/' + params[3] + '/';
            }

             console.log(url);

            // When the user clicks on the button, scroll to the top of the document
            $('#to-top').on('click', function(){
                document.body.scrollTop = 0; // For IE and Firefox
                document.documentElement.scrollTop = 0 // For Chrome, Safari and Opera
            });

            // Infinite scroll
            var end = false;

            $(window).scroll(function() {
                if(document.body.scrollTop > 120 || document.documentElement.scrollTop > 120){
                    $('#to-top').show();
                } else {
                    $('#to-top').hide();
                }
                if(end == false && ($(window).scrollTop() + $(window).height() >= $(document).height()))
                {
                    getPosts(offset);
                    offset += 6;
                }
            });

            function getPosts(offset){
                $.ajax(
                    {
                        url: url + offset,
                        type: "get",
                        beforeSend: function()
                        {
                            $('.ajax-load').show();
                        }
                    })
                    .done(function(data)
                    {
                        $('.ajax-load').hide();
                        if(data) {
                            $("#posts-container").append(data);
                        } else {
                            complete();
                        }
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError)
                    {
                          alert('server not responding...');
                    });
            }
            // This function is called if the server does not return more data
            function complete(){
                end = true;
                $('.end-of-page').show();
            }

            // AutoComplete config
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