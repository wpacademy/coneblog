<?php
/**
 * Widgets Loader class.
 *
 * @category   Class
 * @package    ConeBlogWidgets
 * @subpackage WordPress
 * @author     WP Cone <hello@wpcone.com>
 * @copyright  2020 WP Cone
 * @since      1.0.0
 * php version 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

/**
 * Main ConeBlog Widgets Class
 *
 * The init class that runs the ConeBlog Widgets plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 */
final class CONEBLOG_WIDGETS {

	/**
	 * Page buildres
	 */
	private $builder_elementor;
	private $builder_wordpress;
	private $social_sharing;
	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.4.9';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.10.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		
		// Get page builders status;
		$this->builder_elementor = get_option( 'coneblog_builders_elementor' );
		//$this->builder_wordpress = get_option( 'coneblog_builders_wordpress' );
		$this->social_sharing = get_option( 'coneblog_tools_social_sharing' );

		// Load the translation.
		add_action( 'init', array( $this, 'i18n' ) );

		// Initialize the plugin.
		add_action( 'plugins_loaded', array( $this, 'php_version' ));
		add_action( 'plugins_loaded', array( $this, 'load_elementor_widgets' ));
		//add_action( 'plugins_loaded', array( $this, 'load_coneblog_shortcodes' ));

		if($this->social_sharing == "on"){
			add_action( 'plugins_loaded', array( $this, 'load_cb_social_sharing' ));
		}

		//Enqueue Scripts
		add_action('wp_enqueue_scripts', array($this, 'coneblog_widget_scripts'));
		add_action('admin_enqueue_scripts', array($this, 'coneblog_admin_scripts'));

		if($this->builder_elementor == "on"){
			add_action('elementor/editor/before_enqueue_scripts', array($this, 'coneblog_widget_scripts'));
		}
		//Register Image Sizes
		add_action( 'init', array( $this, 'coneblog_image_sizes' ) );

		//Add custom class to Body element
		add_filter( 'body_class', function( $classes ) {
			return array_merge( $classes, array( 'coneblog-widgets' ) );
		} );

	}
	/**
     * Plugin scripts & styles
     *
     * @since v1.0.0
     */
	public function coneblog_widget_scripts() {
		if($this->builder_elementor == "on"){
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'coneblog-posts-carousel-script', CONEBLOG_ASSETS_PATH. 'owl/carousel.min.js', array(), '2.3.4', false );
			wp_enqueue_script( 'coneblog-plugin-main', CONEBLOG_ASSETS_PATH. 'js/coneblog-main.js', array(), '1.0.0', false );
			wp_enqueue_style( 'coneblog-font-icons', CONEBLOG_ASSETS_PATH. 'css/fontello.css', [], '1.0.0' );
			wp_enqueue_style( 'coneblog-editor-icons', CONEBLOG_ASSETS_PATH. 'css/coneblog-icons.css', [], '1.0.0' );
			wp_enqueue_style( 'coneblog-elementor-widgets', CONEBLOG_ASSETS_PATH. 'css/cbel-widgets.css', [], '1.0.0' );
			wp_enqueue_style( 'coneblog-posts-carousel-owl-style', CONEBLOG_ASSETS_PATH. 'owl/assets/owl.carousel.min.css', array(), '2.3.4' );
			wp_enqueue_style( 'coneblog-posts-carousel-theme', CONEBLOG_ASSETS_PATH. 'owl/assets/owl.theme.default.min.css', array(), '2.3.4' );
			wp_enqueue_style( 'coneblog-animate-css', plugins_url( '/assets/css/animate.min.css', CONEBLOG_WIDGETS ), array(), '4.1.1' );
		}
		if($this->social_sharing == "on"){
			wp_enqueue_style( 'coneblog-social-icons', CONEBLOG_ASSETS_PATH. 'css/social.css', [], '1.0.0' );
		}
	}
	public function coneblog_admin_scripts($hook) {
		//print_r($hook);
		if($hook == 'toplevel_page_coneblog' || $hook == 'coneblog_page_cb-widgets' || $hook == 'coneblog_page_cb-support' || $hook == 'coneblog_page_cb-tools') {

			//Plugin Back-end CSS
			wp_enqueue_style('coneblog-admin-css', CONEBLOG_ASSETS_PATH. 'css/admin.css');
			wp_enqueue_style('coneblog-admin-fonts', CONEBLOG_ASSETS_PATH. 'css/fontello.css');
			//Plugin Back-end JS
			wp_enqueue_script('coneblog-admin-js', CONEBLOG_ASSETS_PATH. 'js/panel.js', 'jQuery', '1.0.0', true );
		} 
		
	}
	/**
     * Plugin Image sizes
     *
     * @since v1.0.0
     */
	public function coneblog_image_sizes() {
		add_image_size( 'coneblog-carousel-thumb', 280, 480, true );
		add_image_size( 'coneblog-carousel-thumb-small', 320, 220, true );
		add_image_size( 'coneblog-grid-thumb', 800, 620, true );
		add_image_size( 'coneblog-classic-thumb', 480, 320, true );
		add_image_size( 'coneblog-classic-thumb-large', 640, 420, true );
		add_image_size( 'coneblog-slider-wide', 1920, 900, true );
		add_image_size( 'cb-author-avatar-md', 200, 200, true );
	}
	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'coneblog-widgets' );
	}
	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function load_elementor_widgets() {
		
		if($this->builder_elementor == "on"){
			// Check if Elementor installed and activated.
			if (!did_action('elementor/loaded')) {
				add_action( 'admin_notices', array( $this, 'coneblog_notice_missing_main_plugin' ) );
				return;
			}

			// Check for required Elementor version.
			if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', array( $this, 'coneblog_notice_minimum_elementor_version' ) );
				return;
			}

			// Once we get here, We have passed all validation checks so we can safely include our widgets.
			require_once 'elementor-widgets.php';
		}
		
	}
	/**
	 * Register Shortcodes for WordPress and other page builders.
	 * This method also load kirki customizer framework.
	 * 
	 * @since 1.1.0
	 * @access public
	 */
	/* public function load_coneblog_shortcodes(){
		if($this->builder_wordpress == "on" && $this->builder_elementor != "on"){
			// Check if kirki customizer framework plugin is installed and activated. If not, then load local framework files.
			if ( ! in_array( 'kirki/kirki.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )  ) {
				require_once CONEBLOG_PLUGIN_PATH. 'inc/frameworks/kirki/kirki.php';
			}
			// Check if Shortcodes are enabled, load shortcodes.
			if($this->builder_wordpress == "on"){
				require_once 'shortcodes.php';
				require_once CONEBLOG_PLUGIN_PATH. 'inc/frameworks/kirki-config.php';
			}
		}
	} */
	/**
	 * Load ConeBlog Social Sharing
	 *
	 * @return void
	 */
	public function load_cb_social_sharing() {
		require_once CONEBLOG_PLUGIN_PATH. 'inc/cb-social.php';
	}
	/**
	 * Check PHP version
	 * @since 1.0.0
	 * @access public
	 */
	public function php_version() {
		// Check for required PHP version.
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'coneblog_admin_notice_minimum_php_version' ) );
			return;
		}
	}

	/**
	 * Admin notice
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	function coneblog_notice_missing_main_plugin() {

		$message = sprintf(
			__( '%1$s requires %2$s to be installed and activated to function properly. %3$s', 'coneblog-widgets' ),
			'<strong>' . __( 'ConBlog Widgets - Elementor', 'coneblog-widgets' ) . '</strong>',
			'<strong>' . __( 'Elementor', 'coneblog-widgets' ) . '</strong>',
			'<a href="' . esc_url( admin_url( 'plugin-install.php?s=Elementor&tab=search&type=term' ) ) . '">' . __( 'Please click here to install/activate Elementor', 'coneblog-widgets' ) . '</a>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 5px 0">%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	function coneblog_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'coneblog-widgets' ),
			'<strong>' . esc_html__( 'ConBlog Widgets - Elementor', 'coneblog-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'coneblog-widgets' ) . '</strong>',
			MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function coneblog_admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'coneblog-widgets' ),
			'<strong>' . esc_html__( 'ConeBlog Widgets', 'coneblog-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'coneblog-widgets' ) . '</strong>',
			MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
	
}

// Instantiate CONEBLOG_WIDGETS.
new CONEBLOG_WIDGETS();
