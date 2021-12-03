// jQuery Document
$(document).ready(function(){
    //keyup event is used to automatically resize the content textarea, 
    //and update teaser's contents when not visible
    $("#exampleFormControlTextarea1").keyup(function () {
        if ($(this).val().length > 200) {
            $(this).attr("rows", 12); //expand textarea size
            if (!($("#teasercheckbox").prop("checked"))){
                $("#teasercheckbox").click(); //check the show teaser checkbox
            }
            $("#teasercheckbox").prop("disabled", true); //disable the show teaser checkbox until user goes below 200 characters
        }
        else {
            $(this).attr("rows", 3); //shrink textarea size
            $("#teasercheckbox").prop("disabled", false); //enable the show teaser checkbox
        };
        if ($("#teaser-form").is(":hidden")) {
            var teasercontent = $(this).val().substring(0, 200);
            $("#teaser").val(teasercontent);
        }
    });
    //show and hide the teaser field based on user setting, .show() 
    // and .hide() are used with prop() instead of .toggle in case
    // checkbox's state and teaser's visibility somehow become desynced
    $("#teasercheckbox").click(function () {
        if ($(this).prop("checked")) {
            $("#teaser-form").show();
        }
        else {
            $("#teaser-form").hide();
        }
    });
    //remove the checkbox input since we don't want to send its state with the form
    $("postform").submit(function() {
        $(this).children('#teasercheckbox').remove();
     });
});