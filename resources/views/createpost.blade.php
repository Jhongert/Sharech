    @extends('layouts.app')

    @section('css')
        <link href="{{ asset('css/prism.css') }}" rel="stylesheet">
    @endsection

    @section('content')
    
        <div class="row">
            <div class="col-sm-12">
                <h1>Create post</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <textarea id="content" name="content" placeholder="Content"></textarea>
                </div>
            </div>

            <div class="col-md-5">

                <div class="form-group">
                    <input type="text" id="title" name="title" class="form-control" placeholder="Title (Max 56 characters)" autofocus>
                </div>

                <div class="form-group">
                    <textarea id="description" name="description" class="form-control" placeholder="Description"></textarea>
                </div>

                <div id="tag-container">
                    <h4>Tags</h4>
                    <div class="input-group input-group-md">
                        <input type="text" class="form-control" name="tags" id="tags">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="add-tag">Add</button>
                        </span>
                    </div>
                    <label>Separate tags with comma</label>

                    <ul id="tag-holder"></ul>

                </div>

                <div class="input-group" id="status">
                    <label class="form-control">Published</label>
                    <span class="input-group-addon">
                        <input type="checkbox" id="published" aria-label="...">
                    </span>
                </div><!-- /input-group -->

                <div class="form-group">
                    <div id="msg-container">
                        <p id="msg"></p>
                    </div>
                    <button class="btn btn-primary" id="save">Save</button>
                </div>
            </div>
        </div>
    
    @endsection

    @section('page-script')
        <script src="{{ asset('js/prism.js') }}"></script>
        <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ asset('js/createpost.js') }}"></script>
    @endsection