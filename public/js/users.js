$(document).ready(function(){
	var requestDelayTimeoutId;
	$('#name').on('keyup', function(){
		var input = $(this).val();

		//if (event.keyCode > 40) {
			
			//if(input !== ""){
				if (requestDelayTimeoutId !== undefined) {
					clearTimeout(requestDelayTimeoutId);
				}

				requestDelayTimeoutId = setTimeout(function(){ loadData(input) }, 400);
			//}
		//}
		// if(!/^[0-9a-za-z]+$/.test(input)){
		// 	helpBlock($(this), 'Username may only contain alphanumeric characters');
		// 	return;
		// }
	});
});

function loadData(input){
	console.log(input);
	var $el = $('#name');

	if (input.length < 5 || input.length > 16){
		helpBlock($el, 'Username must be between 5 and 16 characters');
		$el.css('background-image', 'url("images/invalid.png")');
		return;
	}
	
	if(!/^[0-9a-za-z]+$/.test(input)){
		helpBlock($el, 'Username may only contain alphanumeric characters');
		$el.css('background-image', 'url("images/invalid.png")');
		return;
	}

	$.ajaxSetup({
	    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'user/validate/' + input,
        success: function(res){
        	var $el = $('#name');
            if(res == 'true'){
            	$el.css('background-image', 'url("images/invalid.png")');
            	helpBlock($el, "Username is already taken")
            } else {
            	
            	$el.css('background-image', 'url("images/valid.png")');
            	$el.parent().removeClass('has-error');
            	$el.next().empty();
            }
        }
    });
}