<?php
/**
 * Setting fields callback functions
 * @param array $args
 */
function coneblog_builders_elementor_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_builders_elementor');
    if($value == 'on') {
        $checked = 'checked';
    }
    //var_dump($value);
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-field-box">';
        $html .= '<div class="switch-box-icon"><img src="'.CONEBLOG_ASSETS_PATH.'img/admin_icons/elementor.png" alt="Elementor"></div>';
        $html .= '<div class="switch-box-title">Elementor</div>';
        $html .= '<div class="switch-box-control">';
            $html .= '<label class="switch">';
            $html .= '<input id="cbBuilderElementor" name="coneblog_builders_elementor" type="checkbox" '.$checked.' />';
            $html .= '<span class="slider round"></span>';
            $html .= '</label>';
        $html .= '</div>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'label' => array(
            'class' => array()
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
/* function coneblog_builders_wordpress_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_builders_wordpress');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-field-box">';
        $html .= '<div class="switch-box-icon"><img src="'.CONEBLOG_ASSETS_PATH.'img/admin_icons/wordpress.png" alt="WordPress"></div>';
        $html .= '<div class="switch-box-title">Shortcodes</div>';
        $html .= '<div class="switch-box-control">';
            $html .= '<label class="switch">';
            $html .= '<input id="cbBuilderWordPress" name="coneblog_builders_wordpress" type="checkbox" '.$checked.' />';
            $html .= '<span class="slider round"></span>';
            $html .= '</label>';
        $html .= '</div>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'label' => array(
            'class' => array()
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
} */
/*
 * Setting Field Callbacks for Widgets section
 */
function coneblog_widgets_posts_grid_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_widgets_posts_grid');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-field-box">';
        $html .= '<div class="switch-box-icon"><img src="'.CONEBLOG_ASSETS_PATH.'img/admin_icons/grid.png" alt="Posts Grid"></div>';
        $html .= '<div class="switch-box-title">Grid 1</div>';
        $html .= '<div class="switch-box-control">';
            $html .= '<label class="switch">';
            $html .= '<input id="cbWidgetGridPosts" name="coneblog_widgets_posts_grid" type="checkbox" '.$checked.' />';
            $html .= '<span class="slider round"></span>';
            $html .= '</label>';
        $html .= '</div>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'label' => array(
            'class' => array()
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_widgets_posts_list_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_widgets_posts_list');
    if($value == 'on') {
        $checked = 'checked';
    }
    //var_dump($value);
    $html  = '';
    $html .= '<div class="switch-field-box">';
        $html .= '<div class="switch-box-icon"><img src="'.CONEBLOG_ASSETS_PATH.'img/admin_icons/list.png" alt="Posts List"></div>';
        $html .= '<div class="switch-box-title">List 1</div>';
        $html .= '<div class="switch-box-control">';
            $html .= '<label class="switch">';
            $html .= '<input id="cbWidgetPostsList" name="coneblog_widgets_posts_list" type="checkbox" '.$checked.' />';
            $html .= '<span class="slider round"></span>';
            $html .= '</label>';
        $html .= '</div>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'label' => array(
            'class' => array()
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_widgets_posts_carousel_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_widgets_posts_carousel');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-field-box">';
        $html .= '<div class="switch-box-icon"><img src="'.CONEBLOG_ASSETS_PATH.'img/admin_icons/carousel.png" alt="Posts Carousel"></div>';
        $html .= '<div class="switch-box-title">Carousel</div>';
        $html .= '<div class="switch-box-control">';
            $html .= '<label class="switch">';
            $html .= '<input id="cbWidgetCarousel" name="coneblog_widgets_posts_carousel" type="checkbox" '.$checked.' />';
            $html .= '<span class="slider round"></span>';
            $html .= '</label>';
        $html .= '</div>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'label' => array(
            'class' => array()
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_widgets_posts_classic_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_widgets_posts_classic');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-field-box">';
        $html .= '<div class="switch-box-icon"><img src="'.CONEBLOG_ASSETS_PATH.'img/admin_icons/classic.png" alt="Classic Posts"></div>';
        $html .= '<div class="switch-box-title">Classic</div>';
        $html .= '<div class="switch-box-control">';
            $html .= '<label class="switch">';
            $html .= '<input id="cbWidgetClassicPosts" name="coneblog_widgets_posts_classic" type="checkbox" '.$checked.' />';
            $html .= '<span class="slider round"></span>';
            $html .= '</label>';
        $html .= '</div>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'label' => array(
            'class' => array()
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_widgets_category_tiles_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_widgets_category_tiles');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-field-box">';
        $html .= '<div class="switch-box-icon"><img src="'.CONEBLOG_ASSETS_PATH.'img/admin_icons/categories.png" alt="Category Tiles"></div>';
        $html .= '<div class="switch-box-title">Categories</div>';
        $html .= '<div class="switch-box-control">';
            $html .= '<label class="switch">';
            $html .= '<input id="cbWidgetCatTiles" name="coneblog_widgets_category_tiles" type="checkbox" '.$checked.' />';
            $html .= '<span class="slider round"></span>';
            $html .= '</label>';
        $html .= '</div>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'label' => array(
            'class' => array()
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_widgets_posts_slider_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_widgets_posts_slider');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-field-box">';
        $html .= '<div class="switch-box-icon"><img src="'.CONEBLOG_ASSETS_PATH.'img/admin_icons/slider.png" alt="Posts Slider"></div>';
        $html .= '<div class="switch-box-title">Slider</div>';
        $html .= '<div class="switch-box-control">';
            $html .= '<label class="switch">';
            $html .= '<input id="cbWidgetSlider" name="coneblog_widgets_posts_slider" type="checkbox" '.$checked.' />';
            $html .= '<span class="slider round"></span>';
            $html .= '</label>';
        $html .= '</div>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'label' => array(
            'class' => array()
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_widgets_author_box_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_widgets_author_box');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-field-box">';
        $html .= '<div class="switch-box-icon"><img src="'.CONEBLOG_ASSETS_PATH.'img/admin_icons/author.png" alt="Author Box"></div>';
        $html .= '<div class="switch-box-title">Author Box</div>';
        $html .= '<div class="switch-box-control">';
            $html .= '<label class="switch">';
            $html .= '<input id="cbWidgetAuthorBox" name="coneblog_widgets_author_box" type="checkbox" '.$checked.' />';
            $html .= '<span class="slider round"></span>';
            $html .= '</label>';
        $html .= '</div>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'label' => array(
            'class' => array()
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_widgets_news_ticker_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_widgets_news_ticker');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-field-box">';
        $html .= '<div class="switch-box-icon"><img src="'.CONEBLOG_ASSETS_PATH.'img/admin_icons/news-ticker.png" alt="News Ticker"></div>';
        $html .= '<div class="switch-box-title">News Ticker</div>';
        $html .= '<div class="switch-box-control">';
            $html .= '<label class="switch">';
            $html .= '<input id="cbWidgetNewsTicker" name="coneblog_widgets_news_ticker" type="checkbox" '.$checked.' />';
            $html .= '<span class="slider round"></span>';
            $html .= '</label>';
        $html .= '</div>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'label' => array(
            'class' => array()
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_tools_social_sharing_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_tools_social_sharing');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-box-md">';
        $html .= '<div class="switch-box-title">Social Sharing</div>';
        $html .= '<div class="switch-box-control">';
            $html .= '<label class="switch">';
            $html .= '<input id="cbToolSharing" name="coneblog_tools_social_sharing" type="checkbox" '.$checked.' />';
            $html .= '<span class="slider round"></span>';
            $html .= '</label>';
        $html .= '</div>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'label' => array(
            'class' => array()
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_tools_social_sharing_facebook_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_tools_social_sharing_facebook');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-box-inline">';
        $html .= '<span class="switch-box-title">Facebook</span>';
        $html .= '<span class="switch-box-control">';
            $html .= '<input id="cbToolSharingFB" name="coneblog_tools_social_sharing_facebook" type="checkbox" '.$checked.' />';
        $html .= '</span>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_tools_social_sharing_twitter_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_tools_social_sharing_twitter');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-box-inline">';
        $html .= '<span class="switch-box-title">Twitter</span>';
        $html .= '<span class="switch-box-control">';
            $html .= '<input id="cbToolSharingTW" name="coneblog_tools_social_sharing_twitter" type="checkbox" '.$checked.' />';
        $html .= '</span>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_tools_social_sharing_whatsapp_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_tools_social_sharing_whatsapp');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-box-inline">';
        $html .= '<span class="switch-box-title">WhatsApp</span>';
        $html .= '<span class="switch-box-control">';
            $html .= '<input id="cbToolSharingWA" name="coneblog_tools_social_sharing_whatsapp" type="checkbox" '.$checked.' />';
        $html .= '</span>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_tools_social_sharing_linkedin_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_tools_social_sharing_linkedin');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-box-inline">';
        $html .= '<span class="switch-box-title">LinkedIn</span>';
        $html .= '<span class="switch-box-control">';
            $html .= '<input id="cbToolSharingIN" name="coneblog_tools_social_sharing_linkedin" type="checkbox" '.$checked.' />';
        $html .= '</span>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_tools_social_sharing_reddit_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_tools_social_sharing_reddit');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-box-inline">';
        $html .= '<span class="switch-box-title">Reddit</span>';
        $html .= '<span class="switch-box-control">';
            $html .= '<input id="cbToolSharingReddit" name="coneblog_tools_social_sharing_reddit" type="checkbox" '.$checked.' />';
        $html .= '</span>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_tools_social_sharing_pinterest_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_tools_social_sharing_pinterest');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-box-inline">';
        $html .= '<span class="switch-box-title">Pinterest</span>';
        $html .= '<span class="switch-box-control">';
            $html .= '<input id="cbToolSharingPin" name="coneblog_tools_social_sharing_pinterest" type="checkbox" '.$checked.' />';
        $html .= '</span>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_tools_social_sharing_mail_field_cb( ) {
    $checked = '';
    $value = get_option('coneblog_tools_social_sharing_mail');
    if($value == 'on') {
        $checked = 'checked';
    }
    // Could use ob_start.
    $html  = '';
    $html .= '<div class="switch-box-inline">';
        $html .= '<span class="switch-box-title">E-Mail</span>';
        $html .= '<span class="switch-box-control">';
            $html .= '<input id="cbToolSharingMail" name="coneblog_tools_social_sharing_mail" type="checkbox" '.$checked.' />';
        $html .= '</span>';
    $html .= '</div>';
    $tags = array(
        'span' => array(
            'class' => array()
        ),
        'img' => array(
            'src' => array(),
            'alt' => array(),
        ),
        'a' => array(
            'href'  => array(),
            'class' => array(),
        ),
        'div'   => array(
            'class' => array(),
        ),
        'input' => array(
            'id'    => array(),
            'name'  => array(),
            'type'  => array(),
            'checked'   => array()
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_tools_social_sharing_style_field_cb( ) {
        
        $value = get_option('coneblog_tools_social_sharing_style');

        $html  = '';
        $html .= '<select name="coneblog_tools_social_sharing_style" id="cbToolsSharingStyle">';
            switch($value){

                case 1:
                    $html .= '<option value="1">Flat</option>';
                    $html .= '<option value="2">Rounded</option>';
                    $html .= '<option value="3">Circle</option>';
                    break;
                case 2:
                    $html .= '<option value="2">Rounded</option>';
                    $html .= '<option value="3">Circle</option>';
                    $html .= '<option value="1">Flat</option>';
                    break;
                case 3:
                    $html .= '<option value="3">Circle</option>';
                    $html .= '<option value="2">Rounded</option>';
                    $html .= '<option value="1">Flat</option>';
                    break;
                default:
                    $html .= '<option value="1">Flat</option>';
                    $html .= '<option value="2">Rounded</option>';
                    $html .= '<option value="3">Circle</option>';
            }
        $html .= '</select>';
        $tags = array(
            'option'   => array(
                'value' => array(),
            ),
            'select' => array(
                'id'    => array(),
                'name'  => array(),
            )
        );
        echo wp_kses($html, $tags);
}
function coneblog_tools_social_sharing_desktop_position_field_cb( ) {
        
    $value = get_option('coneblog_tools_social_sharing_desktop_position');

    $html  = '';
    $html .= '<select name="coneblog_tools_social_sharing_desktop_position" id="cbToolsDesktopPosition">';
        switch($value){
            case 1:
                $html .= '<option value="1">Floating - Left</option>';
                $html .= '<option value="2">Floating - Right</option>';
                $html .= '<option value="3">Disabled</option>';
                break;
            case 2:
                $html .= '<option value="2">Floating - Right</option>';
                $html .= '<option value="1">Floating - Left</option>';
                $html .= '<option value="3">Disabled</option>';
                break;
            case 3:
                $html .= '<option value="3">Disabled</option>';
                $html .= '<option value="1">Floating - Left</option>';
                $html .= '<option value="2">Floating - Right</option>';
                break;
            default:
                $html .= '<option value="1">Floating - Left</option>';
                $html .= '<option value="2">Floating - Right</option>';
                $html .= '<option value="3">Disabled</option>';
        }
    $html .= '</select>';
    $tags = array(
        'option'   => array(
            'value' => array(),
        ),
        'select' => array(
            'id'    => array(),
            'name'  => array(),
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_tools_social_sharing_mobile_position_field_cb( ) {
        
    $value = get_option('coneblog_tools_social_sharing_mobile_position');

    $html  = '';
    $html .= '<select name="coneblog_tools_social_sharing_mobile_position" id="cbToolsMobilePosition">';
        switch($value){
            case 1:
                $html .= '<option value="1">Fixed - Bottom</option>';
                $html .= '<option value="2">Disabled</option>';
                break;
            case 2:
                $html .= '<option value="2">Disabled</option>';
                $html .= '<option value="1">Fixed - Bottom</option>';
                break;
            default:
                $html .= '<option value="1">Fixed - Bottom</option>';
                $html .= '<option value="2">Disabled</option>';
        }
    $html .= '</select>';
    $tags = array(
        'option'   => array(
            'value' => array(),
        ),
        'select' => array(
            'id'    => array(),
            'name'  => array(),
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_tools_social_sharing_position_field_cb( ) {
        
    $value = get_option('coneblog_tools_social_sharing_position');

    $html  = '';
    $html .= '<select name="coneblog_tools_social_sharing_position" id="cbToolsSharingPosition" onchange="toggle_position_fields()">';
        switch($value){
            case 1:
                $html .= '<option value="1">Floating Bar</option>';
                $html .= '<option value="2">Single Post</option>';
                break;
            case 2:
                $html .= '<option value="2">Single Post</option>';
                $html .= '<option value="1">Floating Bar</option>';
                break;
            default:
                $html .= '<option value="1">Floating Bar</option>';
                $html .= '<option value="2">Single Post</option>';
        }
    $html .= '</select>';
    $tags = array(
        'option'   => array(
            'value' => array(),
        ),
        'select' => array(
            'id'    => array(),
            'name'  => array(),
        )
    );
    echo wp_kses($html, $tags);
}
function coneblog_tools_social_sharing_content_position_field_cb( ) {
        
    $value = get_option('coneblog_tools_social_sharing_content_position');

    $html  = '';
    $html .= '<select name="coneblog_tools_social_sharing_content_position" id="cbToolsSharingContentPosition">';
        switch($value){
            case 1:
                $html .= '<option value="1">Before Content</option>';
                $html .= '<option value="2">After Content</option>';
                break;
            case 2:
                $html .= '<option value="2">After Content</option>';
                $html .= '<option value="1">Before Content</option>';
                break;
            default:
                $html .= '<option value="1">Before Content</option>';
                $html .= '<option value="2">After Content</option>';
        }
    $html .= '</select>';
    $tags = array(
        'option'   => array(
            'value' => array(),
        ),
        'select' => array(
            'id'    => array(),
            'name'  => array(),
        )
    );
    echo wp_kses($html, $tags);
}