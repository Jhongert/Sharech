// This function is called by validate to display an error message
// if the input is invalid
function helpBlock(el, message){
    // Create a span
    var $span = $(el).next();
    //var $span = $('<span class="help-block">');
    // Insert the message 
    //console.log($span);
    //$span.html('<strong>' + message + '</strong>');
    $span.html('<strong>' + message + '</strong>');
    // Add the span after the element and set the focus to that element
    //el.after($span).focus();
    el.focus();
    // Add class "has-error to the element's parent"
    el.parent().addClass('has-error');
}