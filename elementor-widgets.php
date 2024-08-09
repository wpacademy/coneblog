<?php
/**
 * Widgets class.
 *
 * @category   Class
 * @package    ConeBlogWidgets
 * @subpackage WordPress
 */

namespace ConeBlogWidgets;
// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Class Plugin
 *
 * Main Plugin class
 *
 * @since 1.0.0
 */
class Widgets {

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $instance = null;

	/**
	 * Activae widgets
	 */
	private $widget_grid;
	private $widget_list;
	private $widget_carousel;
	private $widget_classic;
	private $widget_categories;
	private $widget_slider;
	private $author_box;
	private $news_ticker;
	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
	/**
     * Add elementor category
     *
     * @since v1.0.0
     */
    public function register_elementor_categories($elements_manager)
    {
        $elements_manager->add_category(
            'coneblog-widgets',
            [
                'title' => __('Cone Blog', 'coneblog-widgets'),
                'icon' => 'fas fa-plug',
            ], 10);
	}
	
	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once 'widgets/elementor/posts-grid.php';
		require_once 'widgets/elementor/posts-list.php';
		require_once 'widgets/elementor/posts-classic.php';
		require_once 'widgets/elementor/posts-carousel.php';
		require_once 'widgets/elementor/posts-slider.php';
		require_once 'widgets/elementor/category-tiles.php';
		require_once 'widgets/elementor/author-box.php';
		require_once 'widgets/elementor/news-ticker.php';
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {

		// It's now safe to include Widgets files.
		$this->include_widgets_files();

		// Get widget status
		$this->widget_grid = get_option( 'coneblog_widgets_posts_grid' );
		$this->widget_list = get_option( 'coneblog_widgets_posts_list' );
		$this->widget_carousel = get_option( 'coneblog_widgets_posts_carousel' );
		$this->widget_categories = get_option( 'coneblog_widgets_category_tiles' );
		$this->widget_classic = get_option( 'coneblog_widgets_posts_classic' );
		$this->widget_slider = get_option( 'coneblog_widgets_posts_slider' );
		$this->author_box = get_option( 'coneblog_widgets_author_box' );
		$this->news_ticker = get_option( 'coneblog_widgets_news_ticker' );

		// Load active widgets
		if($this->widget_grid == "on") {
			$widgets_manager->register( new Widgets\STBFeaturedGrid() );
		}
		if($this->widget_list == "on") {
			$widgets_manager->register( new Widgets\coneblog_Posts_List() );
		}
		if($this->widget_classic == "on") {
			$widgets_manager->register( new Widgets\coneblog_Classic_Posts() );
		}
		if($this->widget_carousel == "on") {
			$widgets_manager->register( new Widgets\coneblog_Carousel_Posts() );
		}
		if($this->widget_categories == "on") {
			$widgets_manager->register( new Widgets\coneblog_Category_Tiles() );
		}
		if($this->widget_slider == "on") {
			$widgets_manager->register( new Widgets\coneblog_Slider_Posts() );
		}
		if($this->author_box == "on") {
			$widgets_manager->register( new Widgets\coneblog_Author_Box() );
		}
		if($this->news_ticker == "on") {
			$widgets_manager->register( new Widgets\coneblog_News_Ticker() );
		}
		
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		// Register the widgets.
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
		add_action('elementor/elements/categories_registered', array($this, 'register_elementor_categories'));
	}
	
}

// Instantiate the Widgets class.
Widgets::instance();
