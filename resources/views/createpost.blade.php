    @extends('layouts.app')

    @section('css')
        <link href="{{ asset('css/prism.css') }}" rel="stylesheet">
    @endsection

    @section('content')
    <div class="container">
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
    </div>
    @endsection

    @section('page-script')
    <script src="{{ asset('js/prism.js') }}"></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <!-- <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script> -->
    <script>
        tinymce.init({
            selector: '#content',
            branding: false,
            height : 400,
            menubar: false,
            plugins: "codesample",
            toolbar: "undo redo | cut copy paste | bold italic underline strikethrough | bullist numlist | codesample"
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var tags = [];

            $('#add-tag').on('click', function(){
                var curTag = '';
                var input = $('#tags').val();
                var arrayTags = input.split(',');
                for(var i = 0; i < arrayTags.length; i++){
                    curTag = arrayTags[i].trim().toUpperCase();
                    if( curTag != "" && !tags.includes(curTag) ){
                        var li = $('<li>');
                        li.html('<i class="fa fa-trash" aria-hidden="true"></i>' + curTag);
                        $('#tag-holder').append(li);
                        tags.push(curTag);
                    }
                }
                $('#tags').val('').focus();
            });


            $(document).on('click', '.fa-trash', function(){
                var text = $(this).parent().text();
                tags.splice(tags.indexOf(text), 1);
                $(this).parent().remove();
            });


            $('#save').on('click', function(event){

                if(validate()){

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var data = {
                        title: $('#title').val().trim(),
                        description: $('#description').val().trim(),
                        content: tinymce.get('content').getContent(),
                        published: $('#published').is(":checked"),
                        tags: tags
                    };

                    $.ajax({
                        type: 'POST',
                        url: '/post/store',
                        data: data,
                        success: function(data){
                            showMsg(data);
                        }
                    });
                }
            });

            function validate(){
                // Remove all error messages
                $('label.text-danger').remove();

                // Check for empty title
                var title = $('#title');
               
                if (title.val().trim() == ""){
                    var $l = $('<label class="text-danger small">');
                    $l.text('Enter the title');
                    title.after($l).focus();
                    return false;
                }

                // Check for title longer than 56 characters
                if (title.val().trim().length > 56){
                    var $l = $('<label class="text-danger small">');
                    $l.text('Title can\'t be longer than 56 characters, current (' + title.val().trim().length + ')' );
                    title.after($l).focus();
                    return false;
                }

                //check for empty description
                var description = $('#description');
                if (description.val().trim() == ""){
                    var $l = $('<label class="text-danger small">');
                    $l.text('Enter the description');
                    $('#description').after($l);
                    return false;
                }

                 // Check for empty content
                //var content = $('#content');
               var content = tinymce.get('content').getContent();
                if (content.trim() == ""){
                    var $l = $('<label class="text-danger small">');
                    $l.text('Enter the content');
                    $('#content').after($l);
                    return false;
                }

                
                return true;
            }

            function showMsg(status){
                var msg = $('#msg');

                msg.removeClass('alert alert-success alert-danger');

                $('#msg-container').css({'height':'58px'});

                if(status == 'ok'){
                    msg.text('Data has been saved successfully.');
                    msg.addClass('alert alert-success');

                } else {
                    msg.text('Oops, An error has occurred saving the data.');
                    msg.addClass('alert alert-danger');
                }
                window.setTimeout(function(){
                    $('#msg-container').css('height', 0);
                }, 3000);
            }
        });
    </script>
    @endsection