// This function is called by validate to display an error message
// if the input is invalid
function helpBlock(el, message){
    // get the span element that is after the input
    var $span = $(el).next();
  
    // Insert the message 
    $span.html('<strong>' + message + '</strong>');
    // Set the focus 
    el.focus();
    // Add class "has-error to the element's parent"
    el.parent().addClass('has-error');
}