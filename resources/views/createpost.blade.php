    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Create post</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <form id="snippetForm">
                    <div class="form-group">
                        <input type="text" id="title" name="title" class="form-control" placeholder="Title (Max 56 characters)" autofocus>
                    </div>
                    <div class="form-group">
                        <textarea id="content" name="content" class="form-control" placeholder="Content"></textarea>
                    </div>
                </form>
            </div>

            <div class="col-md-4">
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
                        content: $('#content').val().trim(),
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

                 // Check for empty content
                var content = $('#content');
               
                if (content.val().trim() == ""){
                    var $l = $('<label class="text-danger small">');
                    $l.text('Enter the content');
                    content.after($l).focus();
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