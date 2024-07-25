<?php
/**
 * Plugin Settings Panel.
 * @author     WP Cone <hello@wpcone.com>
 * @copyright  2020 WP Cone
 * @since      1.1.0
 * php version 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
/**
 * Include Admin helper functions.
 */
include CONEBLOG_PLUGIN_PATH .'admin/helper.php';

/**
 * Include Registered Settings and Sections.
 */
include CONEBLOG_PLUGIN_PATH .'admin/settings.php';

/**
 * Include Fields callback functions.
 */
include CONEBLOG_PLUGIN_PATH .'admin/fields.php';

/**
 * Include Admin menus.
 */
include CONEBLOG_PLUGIN_PATH .'admin/menus.php';

/**
 * Settings Panel HTML
 */
include CONEBLOG_PLUGIN_PATH .'admin/panel-html.php';
