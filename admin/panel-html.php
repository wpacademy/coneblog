<?php
function coneblog_options_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    
    <div class="coneblog-admin-wrap">
        <div class="coneblog-panel-head">
            <?php
            $page_name = '';
            if ( isset( $_GET['page'])) {
                $page_name = sanitize_text_field( wp_unslash( $_GET['page'] ) );
            }
            //echo $page_name;
            ?>
            <div class="side-panel-col">
                <div class="panel-logo">
                    <span><img src="<?php echo esc_url(CONEBLOG_ASSETS_PATH) ?>img/logo-admin-screen.png" alt="ConeBlog Logo"></span>
                    <span class="cb-logo-title"><?php esc_html_e( 'ConeBlog', 'coneblog-widgets'); ?></span>
                </div>
            </div>
            <div class="side-panel-col">
                <ul class="coneblog-panel-tabs">
                    <li>
                        <a href="admin.php?page=coneblog" class="panel-tab-link<?php echo( esc_attr($page_name == 'coneblog' ? ' active': '') ) ?>">
                        <i class="icon-cubes"></i> Builders</a>
                    </li>
                    <li>
                        <a href="admin.php?page=cb-widgets" class="panel-tab-link<?php echo( esc_attr($page_name == 'cb-widgets' ? ' active': '') ) ?>">
                        <i class="icon-group"></i> Widgets</a>
                    </li>
                    <li>
                        <a href="admin.php?page=cb-tools" class="panel-tab-link<?php echo( esc_attr($page_name == 'cb-tools' ? ' active': '') ) ?>">
                        <i class="icon-magic"></i> Tools</a>
                    </li>
                    <li>
                        <a href="admin.php?page=cb-support" class="panel-tab-link<?php echo( esc_attr($page_name == 'cb-support' ? ' active': '') ) ?>">
                        <i class="icon-support"></i> Support</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="coneblog-panel-content <?php echo 'page-'.esc_attr($page_name) ?>">
                <?php
                // add error/update messages
        
                // check if the user have submitted the settings
                // WordPress will add the "settings-updated" $_GET parameter to the url
                if ( isset( $_GET['settings-updated'] ) ) {
                    // add settings saved message with the class of "updated"
                    add_settings_error( 'coneblog_messages', 'coneblog_message', __( 'Settings Saved', 'coneblog-widgets' ), 'updated' );
                }
            
                // show error/update messages
                settings_errors( 'coneblog_messages' );
                ?>
                <form action="options.php" method="post">
                    <?php
                    if($page_name == 'coneblog') {
                        // output security fields for the registered setting "coneblog"
                        settings_fields( 'coneblog' );
                        ?>
                        <h2 class="panel-section-heading"><?php esc_html_e('Page Builders', 'coneblog-widgets') ?></h2>
                        <h3 class="panel-section-subheading"><?php esc_html_e( 'Select the Page builders you want to enable ConeBlog widgets on.', 'coneblog-widgets' ); ?></h3>
                        <!-- <div class="cb-builder-notice"><?php esc_html_e( 'You should enable only one page builder. Activating multiple builders at the same time may cause compatibility issues.', 'coneblog-widgets' ) ?></div> -->
                        <div class="form-fields-row">
                            <?php
                                // Output setting fields for page builders section
                                coneblog_settings_section_field( 'coneblog', 'coneblog_builders_elementor' );
                                //coneblog_settings_section_field( 'coneblog', 'coneblog_builders_wordpress' );
                            ?>
                        </div>
                        
                        <?php
                    }
                    if($page_name == 'cb-widgets') {
                        // output security fields for the registered setting "coneblog"
                        settings_fields( 'cb-widgets' );
                        ?>
                        <h2 class="panel-section-heading"><?php esc_html_e('Widgets') ?></h2>
                        <h3 class="panel-section-subheading"><?php esc_html_e( 'Select the widgets you want to enable.', 'coneblog-widgets' ); ?></h3>
                        <div class="form-fields-row widgets-row">
                            <?php
                                // Output setting fields for page widgets section
                                coneblog_settings_section_field( 'cb-widgets', 'coneblog_widgets_posts_grid' );
                                coneblog_settings_section_field( 'cb-widgets', 'coneblog_widgets_posts_list' );
                                coneblog_settings_section_field( 'cb-widgets', 'coneblog_widgets_posts_carousel' );
                                coneblog_settings_section_field( 'cb-widgets', 'coneblog_widgets_posts_classic' );
                                coneblog_settings_section_field( 'cb-widgets', 'coneblog_widgets_category_tiles' );
                                coneblog_settings_section_field( 'cb-widgets', 'coneblog_widgets_posts_slider' );
                                coneblog_settings_section_field( 'cb-widgets', 'coneblog_widgets_author_box' );
                                coneblog_settings_section_field( 'cb-widgets', 'coneblog_widgets_news_ticker' );
                            ?>
                        </div>
                        
                        <?php
                    }
                    if($page_name == 'cb-support') { ?>
                        <h2 class="panel-section-heading"><?php esc_html_e('Help & Support') ?></h2>
                        <h3 class="panel-section-subheading"><?php esc_html_e( 'Feel free to reach us for help or support via any of the channel mentioned below.', 'coneblog-widgets' ); ?></h3>
                        <div class="cb-supoort-boxes-container">

                            <div class="cb-support-box">
                                <div class="cb-support-box-icon">
                                    <img src="<?php echo esc_url(CONEBLOG_ASSETS_PATH) ?>img/admin_icons/doc.png" alt="Documentation">
                                </div>
                                <div class="cb-support-box-text">Documentation</div>
                                <div class="cb-support-box-link">
                                    <a href="https://wpcone.com/docs/plugins/coneblog/" target="_blank">Read Now</a>
                                </div>
                            </div>

                            <div class="cb-support-box">
                                <div class="cb-support-box-icon">
                                    <img src="<?php echo esc_url(CONEBLOG_ASSETS_PATH) ?>img/admin_icons/fb-group.png" alt="Facebook Group">
                                </div>
                                <div class="cb-support-box-text">Social Community</div>
                                <div class="cb-support-box-link">
                                    <a href="https://www.facebook.com/groups/wpcone" target="_blank">Join Group</a>
                                </div>
                            </div>

                            <div class="cb-support-box">
                                <div class="cb-support-box-icon">
                                    <img src="<?php echo esc_url(CONEBLOG_ASSETS_PATH) ?>img/admin_icons/forums.png" alt="Forums">
                                </div>
                                <div class="cb-support-box-text">Forums</div>
                                <div class="cb-support-box-link">
                                    <a href="https://wordpress.org/support/plugin/coneblog-widgets/" target="_blank">Post Question</a>
                                </div>
                            </div>

                        </div>
                    <?php } ?>
                    <?php
                    if($page_name == 'cb-tools') {
                        // output security fields for the registered setting "coneblog"
                        settings_fields( 'cb-tools' );
                    ?>
                        <h2 class="panel-section-heading"><?php esc_html_e('Tools') ?></h2>
                        <h3 class="panel-section-subheading"><?php esc_html_e( 'Manage plugin features here.', 'coneblog-widgets' ); ?></h3>
                        <div class="form-field-row"><?php coneblog_settings_section_field( 'cb-tools', 'coneblog_tools_social_sharing' ); ?></div>
                        <div id="socilSubControls" class="form-field-row mt-10 sub-row<?php echo ( esc_attr(get_option('coneblog_tools_social_sharing') != "on" ? ' hidden' : '') ) ?>">
                            <div class="sub-section">
                                <h4>Style</h4>
                                <?php coneblog_settings_section_field( 'cb-tools', 'coneblog_tools_social_sharing_style' ); ?>
                            </div>
                            <div class="sub-section">
                                <h4>Position</h4>
                                <div class="sub-section-row mb-10">
                                    <?php coneblog_settings_section_field( 'cb-tools', 'coneblog_tools_social_sharing_position' ); ?>
                                </div>
                                <div id="contentPositionControls" class="sub-section-row<?php echo ( esc_attr(get_option('coneblog_tools_social_sharing_position') == "1" ? ' hidden' : '') ) ?>">
                                    <div class="sub-section-col">
                                        <?php coneblog_settings_section_field( 'cb-tools', 'coneblog_tools_social_sharing_content_position' ); ?>
                                    </div>
                                </div>
                                <div id="floatingPositionControls" class="sub-section-row<?php echo ( esc_attr(get_option('coneblog_tools_social_sharing_position') == "2" ? ' hidden' : '') ) ?>">
                                    <div class="sub-section-col">
                                        <span class="desktop-icon"><i class="icon-desktop"></i></span>
                                        <?php coneblog_settings_section_field( 'cb-tools', 'coneblog_tools_social_sharing_desktop_position' ); ?>
                                    </div>
                                    <div class="sub-section-col">
                                        <span class="mobile-icon"><i class="icon-mobile"></i></span>
                                        <?php coneblog_settings_section_field( 'cb-tools', 'coneblog_tools_social_sharing_mobile_position' ); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-section">
                                <h4>Services</h4>
                                <?php
                                    coneblog_settings_section_field( 'cb-tools', 'coneblog_tools_social_sharing_facebook' );
                                    coneblog_settings_section_field( 'cb-tools', 'coneblog_tools_social_sharing_twitter' );
                                    coneblog_settings_section_field( 'cb-tools', 'coneblog_tools_social_sharing_whatsapp' );
                                    coneblog_settings_section_field( 'cb-tools', 'coneblog_tools_social_sharing_linkedin' );
                                    coneblog_settings_section_field( 'cb-tools', 'coneblog_tools_social_sharing_reddit' );
                                    coneblog_settings_section_field( 'cb-tools', 'coneblog_tools_social_sharing_pinterest' );
                                    coneblog_settings_section_field( 'cb-tools', 'coneblog_tools_social_sharing_mail' );
                                ?>
                            </div>
                            
                        </div>
                    <?php }
                    // output save settings button
                    submit_button( 'Save Settings' );
                    ?>
                </form>
        </div> 
    </div>
    
    <?php
}
?>