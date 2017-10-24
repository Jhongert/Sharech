// Button save on click event
$(document).ready(function(){
    $('#save-post').on('click', function(){
    	/** 
            Check for empty description
        **/
        // Get the textarea element
        var content = $('#content');
        if (content.val().trim() == ""){
            // If the textarea is empty
            // create a label element with classes
            var $l = $('<label class="text-danger small">');

            // add text to label
            $l.text('Enter the content');

            // add label to the DOM after the textarea
            $('#content').after($l);

            // exit the function
            return false;
        }

        // setup ajax headers
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // create an object with the content and post_id
        var data = {
            content: $('#content').val().trim(),
            post_id: $(this).data('post-id')
        };

        // ajax post request
        $.ajax({
            type: 'POST',
            url: '/comment',
            data: data,
            success: function(data){
                // if the data returned by the server is different than error
                
                if(data != 'error'){
                    // create a main div container to add user's avatar and comment
                    var $div = $('<div class="comment-item">');

                    // create an img element for user photo
                    var $img = $('<img class="img-circle">');
                    $img.attr('src', 'https://s3.amazonaws.com/radiantimages/avatar/' + data.avatar);

                    // create a span element for the user name
                    var $span = $('<span>').text(data.name);

                    
                    // create a link to hold user photo and name
                    // and append the img and span to the link ($a)
                    var $a = $('<a>');
                    $a.attr('href', '/developer/' + data.name).addClass('avatar');
                    $a.append($img).append($span);

                    // add $a element to $div elemente (comment-item)
                	$div.append($a);

                    //create a div element to add the content
                    var $divContent = $('<div>');
                    $divContent.append($('#content').val().trim());

                    // add $divContent to $div
                    $div.append($divContent);

                    // add $div to the main container
                	$('#comments-container').append($div);

                    // empty the textarea
                	$('#content').val('');
                } else {
                	console.log(data);
                }
            }
        });
    });
});