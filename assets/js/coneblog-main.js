function loadTabPosts(id) {
    //alert(id);
    jQuery.ajax({
        url: wpac_ajax_url.ajax_url,
        method: "post",
        data: {
            action : 'load_tab_content_template',
            category: id
        },
        success: function(html){
            jQuery("#tabPostsContainer").html(html);
            //console.log(id);
        }
    });
}