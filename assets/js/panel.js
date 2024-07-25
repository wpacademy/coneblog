jQuery(document).ready(function($){
    var value = $("#cbToolSharing").val();
    //alert(value);
    $("#cbToolSharing").click(function(){
        $("#socilSubControls").toggle();
    });
});
function toggle_position_fields(){
    var position = jQuery("#cbToolsSharingPosition").val();
    if(position == 1) {
        jQuery("#floatingPositionControls").show();
        jQuery("#contentPositionControls").hide();
    }
    if(position == 2) {
        jQuery("#floatingPositionControls").hide();
        jQuery("#contentPositionControls").show();
    }
}