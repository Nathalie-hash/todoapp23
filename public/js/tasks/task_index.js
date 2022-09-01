
function task_markAs(e, taskId, submit = true){
    var valStatus = $(e).is(':checked') ? 'done' : 'pending';
    $('#task_status_'+taskId).val(valStatus);

    if(submit) $(e).parent().submit(); 
}

function showResponse(responseText, statusText, xhr, $form){

    if($form.attr('trindex')){
        $("#"+$form.attr('trindex')).remove();
        alert("task deleted");
        return;
    }
    alert("status changed"); 
}
 
//http://jquery.malsup.com/form/#options-object

function showError(context, xhr, xhp, $form){
    console.log(context.responseText);
    alert("error occured");
}


$(window).on('load', function(e){
    var options = { 
        success:       showResponse,
        error: showError
    }; 

    $('.task_ajax_form').ajaxForm(options); 
});