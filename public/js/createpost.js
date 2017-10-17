
tinymce.init({
    selector: '#content',
    branding: false,
    height : 400,
    menubar: false,
    plugins: "codesample",
    toolbar: "undo redo | cut copy paste | bold italic underline strikethrough | bullist numlist | codesample"
});

$(document).ready(function(){
    var tags = [];

    $('#add-tag').on('click', function(){
        var curTag = '';
        var input = $('#input-tags').val();

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
        $('#input-tags').val('').focus();
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
            msg.text('Your post has been saved.');
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