<?php
function coneblod_set_default_settings() {
    add_option('coneblog_builders_elementor', 'on');
    //add_option('coneblog_builders_wordpress', 'off');
    add_option('coneblog_widgets_posts_grid', 'on');
    add_option('coneblog_widgets_posts_list', 'on');
    add_option('coneblog_widgets_posts_carousel', 'on');
    add_option('coneblog_widgets_category_tiles', 'on');
    add_option('coneblog_widgets_posts_classic', 'on');
    add_option('coneblog_widgets_posts_slider', 'on');
    add_option('coneblog_widgets_author_box', 'on');
    add_option('coneblog_widgets_news_ticker', 'on');
    add_option('coneblog_tools_social_sharing', 'on');
    add_option('coneblog_tools_social_sharing_style', '1');
    add_option('coneblog_tools_social_sharing_position', '1');
    add_option('coneblog_tools_social_sharing_desktop_position', '1');
    add_option('coneblog_tools_social_sharing_mobile_position', '1');
    add_option('coneblog_tools_social_sharing_content_position', '1');
    add_option('coneblog_tools_social_sharing_facebook', 'on');
    add_option('coneblog_tools_social_sharing_twitter', 'on');
    add_option('coneblog_tools_social_sharing_whatsapp', 'on');
    add_option('coneblog_tools_social_sharing_mail', 'on');
    add_option('coneblog_tools_social_sharing_linkedin', 'off');
    add_option('coneblog_tools_social_sharing_reddit', 'off');
    add_option('coneblog_tools_social_sharing_pinterest', 'off');
}