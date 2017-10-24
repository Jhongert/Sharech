$(document).ready(function(){
    tinymce.init({
        selector: '#content',
        branding: false,
        height : 420,
        menubar: false,
        plugins: "codesample",
        toolbar: "undo redo | cut copy paste | bold italic underline strikethrough | bullist numlist | codesample"
    });

    var tags = [];
    
    $('.tagItem').each(function(index){
        tags.push($(this).text().trim());
    });

    $('#add-tag').on('click', function(){
        var curTag = '';
        var input = $('#input-tags').val();

        var arrayTags = input.split(',');

        for(var i = 0; i < arrayTags.length; i++){
            curTag = arrayTags[i].trim().toUpperCase();
            if( curTag != "" && !tags.includes(curTag) ){
                var li = $('<li>');
                li.addClass('tagItem').html('<i class="fa fa-trash" aria-hidden="true"></i>' + curTag);
                $('#tag-holder').append(li);
                tags.push(curTag);
            }
        }
        $('#input-tags').val('').focus();
    });


    $(document).on('click', '.fa-trash', function(){
        var text = $(this).parent().text();
        tags.splice(tags.indexOf(text), 1);
        $(this).parent().remove();
    });


    $('#save').on('click', function(event){

        if(validate()){

            var data = {
                title: $('#title').val().trim(),
                description: $('#description').val().trim(),
                content: tinymce.get('content').getContent(),
                published: $('#published').is(":checked"),
                tags: tags
            };

            var type = 'POST';
            var url = '/post/store';

            var id = $(this).data('id');
            if( id != ''){
                type = 'PUT'
                url = '/post/' + id;
                data.id = id;
            } 

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: type,
                url: url,
                data: data,
                success: function(data){
                    showMsg(data);
                }
            });
        }
    });

    function validate(){
        // Remove all error messages and error classes
        $('span.help-block').remove();
        $('.has-error').removeClass('has-error');

        // Check if title is empty
        var title = $('#title');
       
        if (title.val().trim() == ""){
            helpBlock(title, 'Enter the title');
            return false;
        }

        // Check if title is longer than 56 characters
        if (title.val().trim().length > 56){
            helpBlock(title, 'Title can\'t be longer than 56 characters, current (' + title.val().trim().length + ')');
            return false;
        }

        //check if description isempty 
        var description = $('#description');
        if (description.val().trim() == ""){
            helpBlock(description, 'Enter the description');
            return false;
        }

         // Check for empty content
        var textArea = $('#content');
        var content = tinymce.get('content').getContent();
        if (content.trim() == ""){
            helpBlock(textArea, 'Enter the content');
            return false;
        }

        return true;
    }

    function showMsg(data){
        var msg = $('#msg');

        msg.removeClass('alert alert-success alert-danger');

        $('#msg-container').css({'height':'58px'});

        if(data == 'ok'){
            msg.text('Your post has been saved.');
            msg.addClass('alert alert-success');

        } else {
            msg.text('Oops,' + data);
            msg.addClass('alert alert-danger');
        }
        window.setTimeout(function(){
            $('#msg-container').css('height', 0);
        }, 3000);
    }
});