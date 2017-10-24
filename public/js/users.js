$(document).ready(function(){
	var requestDelayTimeoutId;
	$('#name').on('keyup', function(){
		if (event.keyCode > 40 || event.keyCode === 8) {
			var input = $(this).val().trim();
			if(input !== ""){
				if (requestDelayTimeoutId !== undefined) {
					clearTimeout(requestDelayTimeoutId);
				}

				requestDelayTimeoutId = setTimeout(function(){ loadData(input) }, 400);
			}
		}
	});
});

function loadData(input){
	$.ajaxSetup({
	    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'user/validate/' + input,
        success: function(res){
        	var $el = $('#name')
            if(res == 'true'){
            	$el.css('background-image', 'url("images/invalid.png")');
            	helpBlock($('#name'), "Username is already taken")
            } else {
            	$el.css('background-image', 'url("images/valid.png")');
            	$el.parent().removeClass('has-error');
            	$el.next().remove();
            }
        }
    });
}