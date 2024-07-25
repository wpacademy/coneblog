<?php
/**
 * Helper Functions.
 *
 * @category   Functions
 * @package    ConeBlogWidgets
 * @subpackage WordPress
 */
namespace ConeBlogWidgets\Classes;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();
if ( ! class_exists( 'Helper' ) ) {
class Helper
{
    /**
     * Get post category name for current post
     * @return string
     */
    public static function coneblog_post_category() {
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
        }
    }
    /**
     * Generate post term box
     * @return string
     */
    public static function coneblog_post_term_box() {
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="grid-post-term"><span class="term-name">' . esc_html( $categories[0]->name ) . '</span></a>';
        }
    }
    /**
     * Get All Post Types
     * @return array
     */
    public static function coneblog_get_post_types() {
        $post_types = get_post_types(['public' => true, 'show_in_nav_menus' => true], 'objects');
        $post_types = wp_list_pluck($post_types, 'label', 'name');
    
        return array_diff_key($post_types, ['elementor_library', 'attachment']);
    }
    /**
     * Get All Post Categories
     * @return array
     */
    public static function coneblog_get_categories() {
        $categories = get_categories( array("hide_empty" => false) );
        /* foreach ($categories as $category => $object) {
            $list_cats[] = array ('name' => $object->name, 'term_id' => $object->term_id);
        } */
        return $categories;
    }
    /**
     * Return post orederby options
     * @return array
     */
    public static function coneblog_get_post_orderby_options() {
        $orderby = array(
            'ID' => 'Post ID',
            'author' => 'Post Author',
            'title' => 'Title',
            'date' => 'Date',
            'modified' => 'Last Modified Date',
            'parent' => 'Parent Id',
            'rand' => 'Random',
            'comment_count' => 'Comment Count',
            'menu_order' => 'Menu Order',
        );
    
        return $orderby;
    }
    /**
     * Return post query args
     * @return array
     */
    public static function coneblog_get_query_args($settings = [], $post_type = 'post') {
        $settings = wp_parse_args($settings, [
            'post_type' => $post_type,
            'posts_ids' => [],
            'orderby' => 'date',
            'order' => 'desc',
            'posts_per_page' => 5,
            'offset' => 0,
            'post__not_in' => [],
        ]);
    
        $args = [
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
            'ignore_sticky_posts' => 1,
            'post_status' => 'publish',
            'posts_per_page' => $settings['posts_per_page'],
            'offset' => $settings['offset'],
        ];
    
        if ('by_id' === $settings['post_type']) {
            $args['post_type'] = 'any';
            $args['post__in'] = empty($settings['posts_ids']) ? [0] : $settings['posts_ids'];
        } else {
            $args['post_type'] = $settings['post_type'];
    
            if ($args['post_type'] !== 'page') {
                $args['tax_query'] = [];
    
                $taxonomies = get_object_taxonomies($settings['post_type'], 'objects');
    
                foreach ($taxonomies as $object) {
                    $setting_key = $object->name . '_ids';
    
                    if (!empty($settings[$setting_key])) {
                        $args['tax_query'][] = [
                            'taxonomy' => $object->name,
                            'field' => 'term_id',
                            'terms' => $settings[$setting_key],
                        ];
                    }
                }
    
                if (!empty($args['tax_query'])) {
                    $args['tax_query']['relation'] = 'AND';
                }
            }
        }
    
        if (!empty($settings['authors'])) {
            $args['author__in'] = $settings['authors'];
        }
    
        if (!empty($settings['post__not_in'])) {
            $args['post__not_in'] = $settings['post__not_in'];
        }
    
        return $args;
    }
    /**
     * Return class name for small grid items
     * @return string
     */
    public static function coneblog_small_grid_class($layout = 1, $index = 1) {
        if($layout == 1 && $index != 1) {
            echo " small-grid";
        } elseif($layout == 2 && $index != 1 && $index != 2) {
            echo " small-grid";
        } elseif($layout == 3 && $index != 1 && $index != 2) {
            echo " small-grid";
        } elseif($layout == 4 && $index != 1) {
            echo " small-grid";
        } elseif($layout == 5) {
            echo " small-grid";
        } else {
            echo "";
        }
    }
    /**
     * Return modified excerpt with custom specified limit
     * @return string
     */
    public static function coneblog_list_excerpt($count=20) {
        $excerpt = get_the_excerpt();
        $limit = $count;
        $new_excerpt = wp_trim_words($excerpt, $limit);
        return $new_excerpt;
    }
    /**
     * Return HTML with meta information for the current post-date/time
     * @return string
     */
    public static function coneblog_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$html = '<span class="posted-on"><i class="icon-calendar"></i> ' .$posted_on. '</span>';
        $tags = array(
            'span' => array(
                'class' => array()
            ),
            'i' => array(
                'class' => array()
            )
        );
        echo wp_kses($html, $tags);

    }
    /**
     * Return HTML with meta information for the post author
     * @return string
     */
    public static function coneblog_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'styloblog' ),
			'<span class="author vcard"><i class="icon-user"></i> <a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
        $html = '<span class="byline"> ' . $byline . '</span>';
        $tags = array(
            'span' => array(
                'class' => array()
            ),
            'i' => array(
                'class' => array()
            ),
            'a' => array(
                'href'  => array(),
                'class' => array(),
            )
        );
		echo wp_kses($html, $tags);

    }
    /**
     * Return commend count with a leave comment link
     * @return string
     */
    public static function coneblog_entry_comments() {
		$comment_count = get_comments_number(get_the_ID());
		if($comment_count == 0) {
            $tags = array(
                'span' => array(
                    'class' => array()
                ),
                'i' => array(
                    'class' => array()
                ),
                'a' => array(
                    'href'  => array(),
                    'class' => array(),
                )
            );
			echo wp_kses('<span class="post-meta post-comments"><i class="icon-chat"></i> <a href="'.esc_url(get_comments_link( get_the_ID()) ).'">'. esc_html__(" 0", "coneblog-widgets") .'</a></span>', $tags);
		} elseif($comment_count = 1){
			echo wp_kses('<span class="post-meta post-comments"><i class="icon-chat"></i>'.esc_html($comment_count).' <a href="'.esc_url(get_comments_link( get_the_ID() )).'">'. esc_html__(" Comment", "flashwp-lite") .'</a></span>', $tags);
		} else {
			echo wp_kses('<span class="post-meta post-comments"><i class="icon-chat"></i>'.esc_html($comment_count).' <a href="'.esc_url(get_comments_link( get_the_ID() )).'">'. esc_html__(" Comments", "flashwp-lite") .'</a></span>', $tags);
		}

    }

    /**
     * Convert HEX  value of color into RGBA
     *
     * @param string $color
     * @param float $opacity
     * @return string
     */
    public static function coneblog_hex2rgba($color, $opacity = false) {
 
        $default = 'rgb(0,0,0)';
     
        //Return default if no color provided
        if(empty($color))
              return $default; 
     
        //Sanitize $color if "#" is provided 
            if ($color[0] == '#' ) {
                $color = substr( $color, 1 );
            }
     
            //Check if color has 6 or 3 characters and get values
            if (strlen($color) == 6) {
                    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
            } elseif ( strlen( $color ) == 3 ) {
                    $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
            } else {
                    return $default;
            }
     
            //Convert hexadec to rgb
            $rgb =  array_map('hexdec', $hex);
     
            //Check if opacity is set(rgba or rgb)
            if($opacity){
                if(abs($opacity) > 1)
                    $opacity = 1.0;
                $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
            } else {
                $output = 'rgb('.implode(",",$rgb).')';
            }
     
            //Return rgb(a) color string
            return $output;
    }
    /**
     * Get Latest Post by Author ID
     *
     * @param int $id
     * @return string Formatted Post Link
     */
    public static function coneblog_author_recent_post($id,$limit) {
        $author_id = intval($id);
        $posts_limit = intval($limit);
        $tags = array(
            'a' => array(
                'href'  => array(),
                'class' => array(),
            )
        );
        if(isset($author_id) && $author_id !="") {

            $the_query = new \WP_Query( array( 'author' => $author_id, 'post_status' => 'publish', 'posts_per_page' => $posts_limit ) );
            
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $html =  '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
                    echo wp_kses($html, $tags);
                }
            }
            /* Restore original Post Data */
            wp_reset_postdata();
        }
    }
}
}