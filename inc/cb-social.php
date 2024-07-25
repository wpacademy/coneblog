<?php
/**
 * Social Sharing class.
 *
 * @category   Class
 * @package    ConeBlogWidgets
 * @subpackage WordPress
 * @author     WP Cone <hello@wpcone.com>
 * @copyright  2020 WP Cone
 * @since      1.3.0
 * php version 7.4
 */
namespace ConeBlogWidgets\Classes;
if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
if ( ! class_exists( 'ConeBlog_Social_Sharing' ) ) {
class ConeBlog_Social_Sharing {

    /**
     * Register Properties
     */
    private $style;
    private $position;
    private $desktop_position;
    private $mobile_position;
    private $content_position;
    private $service_facebook;
    private $service_twitter;
    private $service_whatsapp;
    private $service_email;
    private $service_reddit;
    private $service_linkedin;
    private $service_pinterest;
    private $page_title;
    private $page_url;
    private $protocol;

    public function __construct(){

        $this->style = get_option('coneblog_tools_social_sharing_style');
        $this->position = get_option('coneblog_tools_social_sharing_position');
        $this->desktop_position = get_option('coneblog_tools_social_sharing_desktop_position');
        $this->mobile_position = get_option('coneblog_tools_social_sharing_mobile_position');
        $this->content_position = get_option('coneblog_tools_social_sharing_content_position');
        $this->service_facebook = get_option('coneblog_tools_social_sharing_facebook');
        $this->service_twitter = get_option('coneblog_tools_social_sharing_twitter');
        $this->service_whatsapp = get_option('coneblog_tools_social_sharing_whatsapp');
        $this->service_email = get_option('coneblog_tools_social_sharing_mail');
        $this->service_reddit = get_option('coneblog_tools_social_sharing_reddit');
        $this->service_linkedin = get_option('coneblog_tools_social_sharing_linkedin');
        $this->service_pinterest = get_option('coneblog_tools_social_sharing_pinterest');
        
        if($this->position == '1') {
            add_action('wp_footer', array( $this, 'cb_social_icons' ));
        }
        if($this->position == '2') {
            add_filter('the_content', array( $this, 'cb_social_icons_content_position' ), 99);
        }
    }

    /**
     * Social Icons Floating Bar
     * This function prints the social icons html in the wp_footer.
     */
    public function cb_social_icons(){

        $post_img = '';
        if(is_single() || is_page()){
            $this->page_title = get_the_title(get_the_ID());
            $this->page_url = get_the_permalink(get_the_ID());
            $post_img = get_the_post_thumbnail_url(get_the_ID(), 'medium');
        }
        if(is_home() || is_front_page()) {
            $this->page_title = get_bloginfo('name').(get_bloginfo('description') != "" ? ' | '.get_bloginfo('description') : '');
            $this->page_url = home_url();
        }
        if(is_archive()) {
            
            $this->protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

            $this->page_title = get_the_archive_title();
            if ( is_category() ) {
                $this->page_title = single_cat_title( '', false );
            } elseif ( is_tag() ) {
                $this->page_title = single_tag_title( '', false );
            } elseif ( is_author() ) {
                $this->page_title = '<span class="vcard">' . get_the_author() . '</span>';
            } elseif ( is_post_type_archive() ) {
                $this->page_title = post_type_archive_title( '', false );
            } elseif ( is_tax() ) {
                $this->page_title = single_term_title( '', false );
            }
            
            $this->page_url = $this->protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        }
        $position_class = '';
        if($this->position == '1') {
            $position_class = ' floating desktop-'.$this->desktop_position.' mobile-'.$this->mobile_position.'';
        }
        if($this->position == '2') {
            $position_class = ' inside-content';
        }
        $html = '';
        $html .= '<div class="cb-social-sharing'.$position_class.'">';
            $html .= '<ul class="cb-social-icons style-'.$this->style.'">';
                if($this->service_facebook == "on") {
                    $html .= '<li><a href="https://www.facebook.com/sharer.php?u='.$this->page_url.'" class="cb-fb-icon" target="_blank"><i class="icon-facebook"></i></a></li>';
                }
                if($this->service_twitter == "on") {
                    $html .= '<li><a href="https://twitter.com/share?url='.$this->page_url.'&text='.$this->page_title.'" class="cb-tw-icon" target="_blank"><i class="icon-twitter"></i></a></li>';
                }
                if($this->service_whatsapp == "on") {
                    $html .= '<li><a href="https://api.whatsapp.com/send?&text='.$this->page_title.' '.$this->page_url.'" class="cb-wa-icon" target="_blank"><i class="icon-whatsapp"></i></a></li>';
                }
                if($this->service_linkedin == "on") {
                    $html .= '<li><a href="https://www.linkedin.com/shareArticle?url='.$this->page_url.'&title='.$this->page_title.'" class="cb-in-icon" target="_blank"><i class="icon-linkedin"></i></a></li>';
                }
                if($this->service_pinterest == "on") {
                    $html .= '<li><a href="https://pinterest.com/pin/create/bookmarklet/?media='.$post_img.'&url='.$this->page_url.'&description='.$this->page_title.'" class="cb-pin-icon" target="_blank"><i class="icon-pinterest"></i></a></li>';
                }
                if($this->service_reddit == "on") {
                    $html .= '<li><a href="https://reddit.com/submit?url='.$this->page_url.'&title='.$this->page_title.'" class="cb-rd-icon" target="_blank"><i class="icon-reddit"></i></a></li>';
                }
                if($this->service_email == "on") {
                    $html .= '<li><a href="mailto:?subject='.$this->page_title.'&body='.$this->page_title.' - '.$this->page_url.'" class="cb-em-icon"><i class="icon-mail"></i></a></li>';
                }
            $html .= '</ul>';
        $html .= '</div>';
        $tags = array(
            'span' => array(
                'class' => array(),
                'style' => array(),
            ),
            'a' => array(
                'href'  => array(),
                'class' => array(),
                'target' => array(),
            ),
            'i' => array(
                'class' => array(),
            ),
            'div'   => array(
                'class' => array(),
                'style' => array()
            ),
            'ul' => array(
                'class' => array()
            ),
            'li' => array(
                'class' => array()
            ),
        );
        if($this->position == '1') {
            echo wp_kses($html, $tags);
        } else {
            return wp_kses($html, $tags);
        }
        
    }
    public function cb_social_icons_content_position($content) {
        if(is_single()){
            if($this->content_position == '1') {
                $content = $this->cb_social_icons() . $content;
            }
            if($this->content_position == '2') {
                $content = $content. $this->cb_social_icons();
            }
        }
        
        return $content;
    }
}
new ConeBlog_Social_Sharing();
}