// This function is called by validate to display an error message
// if the input is invalid
function helpBlock(el, message){
    // Create a span
    var $span = $('<span class="help-block">');
    // Insert the message 
    $span.html('<strong>' + message + '</strong>');
    // Add the span after the element and set the focus to that element
    el.after($span).focus();
    // Add class "has-error to the element's parent"
    el.parent().addClass('has-error');
}