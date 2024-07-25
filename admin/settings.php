<?php
/**
 * custom option and settings
 */
function coneblog_settings_init() {
    
    // Register new settings for "Page Builders" section.
    register_setting( 'coneblog', 'coneblog_builders_elementor', ['default' => 'on']);
    //register_setting( 'coneblog', 'coneblog_builders_wordpress', ['default' => 'off']);

    // Register new settings for "Widgets" Section.
    register_setting( 'cb-widgets', 'coneblog_widgets_posts_grid', ['default' => 'on']);
    register_setting( 'cb-widgets', 'coneblog_widgets_posts_list', ['default' => 'on']);
    register_setting( 'cb-widgets', 'coneblog_widgets_posts_carousel', ['default' => 'on']);
    register_setting( 'cb-widgets', 'coneblog_widgets_category_tiles', ['default' => 'on']);
    register_setting( 'cb-widgets', 'coneblog_widgets_posts_classic', ['default' => 'on']);
    register_setting( 'cb-widgets', 'coneblog_widgets_posts_slider', ['default' => 'on']);
    register_setting( 'cb-widgets', 'coneblog_widgets_author_box', ['default' => 'on']);
    register_setting( 'cb-widgets', 'coneblog_widgets_news_ticker', ['default' => 'on']);

    // Register new settings for "Tools" page
    register_setting( 'cb-tools', 'coneblog_tools_social_sharing');
    register_setting( 'cb-tools', 'coneblog_tools_social_sharing_style');
    register_setting( 'cb-tools', 'coneblog_tools_social_sharing_position');
    register_setting( 'cb-tools', 'coneblog_tools_social_sharing_desktop_position');
    register_setting( 'cb-tools', 'coneblog_tools_social_sharing_mobile_position');
    register_setting( 'cb-tools', 'coneblog_tools_social_sharing_content_position');
    register_setting( 'cb-tools', 'coneblog_tools_social_sharing_facebook');
    register_setting( 'cb-tools', 'coneblog_tools_social_sharing_twitter');
    register_setting( 'cb-tools', 'coneblog_tools_social_sharing_whatsapp');
    register_setting( 'cb-tools', 'coneblog_tools_social_sharing_linkedin');
    register_setting( 'cb-tools', 'coneblog_tools_social_sharing_reddit');
    register_setting( 'cb-tools', 'coneblog_tools_social_sharing_pinterest');
    register_setting( 'cb-tools', 'coneblog_tools_social_sharing_mail');
    

    // Page Builders Section
    add_settings_section(
        'coneblog_section_builders',
        __( 'Page Builders.', 'coneblog-widgets' ),
        'coneblog_section_builders_callback',
        'coneblog'
    );

    // Widgets Section
    add_settings_section(
        'coneblog_section_widgets',
        __( 'Widgets.', 'coneblog-widgets' ),
        'coneblog_section_widgets_callback',
        'cb-widgets'
    );

    // Support Section
    add_settings_section(
        'coneblog_section_widgets',
        __( 'Widgets.', 'coneblog-widgets' ),
        'coneblog_section_widgets_callback',
        'cb-widgets'
    );

    // Tools Section
    add_settings_section(
        'coneblog_section_tools',
        __( 'Tools.', 'coneblog-widgets' ),
        'coneblog_section_tools_callback',
        'cb-tools'
    );
    /*
    * Register Setting Fields for Page Builders section
    */

    // Elementor
    add_settings_field(
        'coneblog_builders_elementor',
        'Elementor',
        'coneblog_builders_elementor_field_cb',
        'coneblog',
        'coneblog_section_builders'
    );
    // WordPress
   /*  add_settings_field(
        'coneblog_builders_wordpress',
        'WordPress',
        'coneblog_builders_wordpress_field_cb',
        'coneblog',
        'coneblog_section_builders'
    ); */

    /*
    * Register Setting Fields for Widgets Builders section
    */

    // Posts Grid
    add_settings_field(
        'coneblog_widgets_posts_grid',
        'Posts Grid',
        'coneblog_widgets_posts_grid_field_cb',
        'cb-widgets',
        'coneblog_section_widgets'
    );
    // Posts List
    add_settings_field(
        'coneblog_widgets_posts_list',
        'Posts List',
        'coneblog_widgets_posts_list_field_cb',
        'cb-widgets',
        'coneblog_section_widgets'
    );
    // Posts Carousel
    add_settings_field(
        'coneblog_widgets_posts_carousel',
        'Carousel',
        'coneblog_widgets_posts_carousel_field_cb',
        'cb-widgets',
        'coneblog_section_widgets'
    );
    // Posts Classic
    add_settings_field(
        'coneblog_widgets_posts_classic',
        'Classic Block',
        'coneblog_widgets_posts_classic_field_cb',
        'cb-widgets',
        'coneblog_section_widgets'
    );
    // Category Tiles
    add_settings_field(
        'coneblog_widgets_category_tiles',
        'Categories',
        'coneblog_widgets_category_tiles_field_cb',
        'cb-widgets',
        'coneblog_section_widgets'
    );
    // Posts Slider
    add_settings_field(
        'coneblog_widgets_posts_slider',
        'Slider',
        'coneblog_widgets_posts_slider_field_cb',
        'cb-widgets',
        'coneblog_section_widgets'
    );
    // Author Box
    add_settings_field(
        'coneblog_widgets_author_box',
        'Author Box',
        'coneblog_widgets_author_box_field_cb',
        'cb-widgets',
        'coneblog_section_widgets'
    );
    // News Ticker
    add_settings_field(
        'coneblog_widgets_news_ticker',
        'News Ticker',
        'coneblog_widgets_news_ticker_field_cb',
        'cb-widgets',
        'coneblog_section_widgets'
    );
    
    /**
     * Fields for Tools page 
     */
    // Social Sharing
    add_settings_field(
        'coneblog_tools_social_sharing',
        'Social Sharing',
        'coneblog_tools_social_sharing_field_cb',
        'cb-tools',
        'coneblog_section_tools'
    );
    add_settings_field(
        'coneblog_tools_social_sharing_style',
        'Style',
        'coneblog_tools_social_sharing_style_field_cb',
        'cb-tools',
        'coneblog_section_tools'
    );
    add_settings_field(
        'coneblog_tools_social_sharing_position',
        'Position',
        'coneblog_tools_social_sharing_position_field_cb',
        'cb-tools',
        'coneblog_section_tools'
    );
    add_settings_field(
        'coneblog_tools_social_sharing_desktop_position',
        'Desktop Position',
        'coneblog_tools_social_sharing_desktop_position_field_cb',
        'cb-tools',
        'coneblog_section_tools'
    );
    add_settings_field(
        'coneblog_tools_social_sharing_mobile_position',
        'Mobile Position',
        'coneblog_tools_social_sharing_mobile_position_field_cb',
        'cb-tools',
        'coneblog_section_tools'
    );
    add_settings_field(
        'coneblog_tools_social_sharing_content_position',
        'Content Position',
        'coneblog_tools_social_sharing_content_position_field_cb',
        'cb-tools',
        'coneblog_section_tools'
    );
    add_settings_field(
        'coneblog_tools_social_sharing_facebook',
        'Facebook',
        'coneblog_tools_social_sharing_facebook_field_cb',
        'cb-tools',
        'coneblog_section_tools'
    );
    add_settings_field(
        'coneblog_tools_social_sharing_twitter',
        'Twitter',
        'coneblog_tools_social_sharing_twitter_field_cb',
        'cb-tools',
        'coneblog_section_tools'
    );
    add_settings_field(
        'coneblog_tools_social_sharing_whatsapp',
        'WhatsApp',
        'coneblog_tools_social_sharing_whatsapp_field_cb',
        'cb-tools',
        'coneblog_section_tools'
    );
    add_settings_field(
        'coneblog_tools_social_sharing_linkedin',
        'LinkedIn',
        'coneblog_tools_social_sharing_linkedin_field_cb',
        'cb-tools',
        'coneblog_section_tools'
    );
    add_settings_field(
        'coneblog_tools_social_sharing_reddit',
        'Reddit',
        'coneblog_tools_social_sharing_reddit_field_cb',
        'cb-tools',
        'coneblog_section_tools'
    );
    add_settings_field(
        'coneblog_tools_social_sharing_pinterest',
        'Pinterest',
        'coneblog_tools_social_sharing_pinterest_field_cb',
        'cb-tools',
        'coneblog_section_tools'
    );
    add_settings_field(
        'coneblog_tools_social_sharing_mail',
        'Email',
        'coneblog_tools_social_sharing_mail_field_cb',
        'cb-tools',
        'coneblog_section_tools'
    );
}

/**
 * Register our coneblog_settings_init to the admin_init action hook.
 */
add_action( 'admin_init', 'coneblog_settings_init' );

/**
 * Section Callback Functions.
 */
function coneblog_section_builders_callback( $args ) {
    return;
}
function coneblog_section_widgets_callback( $args ) {
    return;
}
function coneblog_section_support_callback( $args ) {
    return;
}
function coneblog_section_tools_callback( $args ) {
    return;
}