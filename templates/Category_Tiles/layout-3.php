<?php
$html = '';
$tags = array(
    'span' => array(
        'class' => array(),
        'style' => array(),
    ),
    'a' => array(
        'href'  => array(),
        'class' => array(),
    ),
    'i' => array(
        'class' => array(),
    ),
    'div'   => array(
        'class' => array(),
        'style' => array()
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
$html .= '<div class="coneblog-category-list box-' . $item['_id'] . '">';

    $html .= '<div class="icon-container">';
    if($item['selected_icon']['value']) {
        $html .= '<span class="coneblog-catlist-icon"><i class="'.$item['selected_icon']['value'].'"></i></span>';
    }
    $html .= '</div>';
    $html .= '<div class="text-container">';
        
        $html .= '<h3 class="category-name">';
            $html .= '<a href="'.$category_url.'" class="coneblog-category-tile-link">';
                $html .= $item['category_title'];
            $html .= '</a>';
        $html .= '</h3>';
        if ( 'yes' === $settings['show_post_count'] ) {
            $html .= '<div class="coneblog-catlist-post-count"><span>'.$post_count.' '.($post_count > 1 ? 'Posts' : 'Post').'</span></div>';
        }
    $html .= '</div>';
    
$html .= '</div>';
echo wp_kses($html, $tags);
?>