    @extends('layouts.app')

    @section('css')
        <link href="{{ asset('css/prism.css') }}" rel="stylesheet">
    @endsection

    @section('content')
    
        <div class="row">
            <div class="col-sm-12">
                @if($post->id == "")
                    <h3>Create post</h3>
                @else
                    <h3>Edit post</h3>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <textarea id="content" name="content" placeholder="Content">{{ htmlentities($post->content) }}</textarea>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="col-md-5">
                <div id="msg-container">
                    <p id="msg"></p>
                </div>
                
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Max 56 characters" autofocus value="{{ $post->title }}">
                    <span class="help-block"></span>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" placeholder="Max 150 characters">{{$post->description}}</textarea>
                    <span class="help-block"></span>
                </div>

                <div id="tag-container">
                    <h4>Tags</h4>
                    <div class="input-group input-group-md">
                        <input type="text" class="form-control" name="input-tags" id="input-tags">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="add-tag">Add</button>
                        </span>
                    </div>
                    <label>Separate tags with comma</label>

                    <ul id="tag-holder">
                        @foreach($post->tags as $tag)
                            <li class="tagItem"><i class="fa fa-trash" aria-hidden="true"></i>{{$tag->name}}</li>
                        @endforeach
                    </ul>

                </div>

                <div class="input-group" id="status">
                    <label class="form-control">Published</label>
                    <span class="input-group-addon">
                        <input type="checkbox" id="published" aria-label="..." 
                            @if($post->published == 1)
                               checked  
                            @endif
                        >
                    </span>
                </div><!-- /input-group -->

                <div class="form-group">
                    
                    <button class="btn btn-primary" id="save" data-id="{{ $post->id }}">Save</button>
                </div>
            </div>
        </div>
    
    @endsection

    @section('page-script')
        <script src="{{ asset('js/prism.js') }}"></script>
        <script src="{{ asset('js/tinymce/tinymce.js') }}"></script>
        <script src="{{ asset('js/helpers.js') }}"></script>
        <script src="{{ asset('js/createpost.js') }}"></script>
    @endsection