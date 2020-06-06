<?php
/**
 * Plugin Name: emulsion addons
 * Plugin URI:  https://github.com/tenman/emulsion-addons
 * Description: A plugin for customizing WordPress theme emulsion.
 * Version:     1.2.3
 * Author:      nobita
 * Author URI:  https://www.tenman.info/
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

$emulsion_addon_accept_theme_name	 = wp_get_theme( get_template() )->get( 'Name' );
$emulsion_addon_accept_theme_version = wp_get_theme( get_template() )->get( 'Version' );
$emulsion_root						 = plugin_dir_path( __FILE__ );

if ( 'emulsion' == $emulsion_addon_accept_theme_name &&
		version_compare( $emulsion_addon_accept_theme_version, '1.1.7', '>=' ) ) {

	include_once( $emulsion_root . 'includes/functions.php');

	include_once( $emulsion_root . 'includes/validate.php');
	include_once( $emulsion_root . 'includes/theme-supports-functions.php' );
	include_once( $emulsion_root . 'includes/theme-supports.php' );
	include_once( $emulsion_root . 'includes/color-functions.php' );
	include_once( $emulsion_root . 'includes/conf.php' );
	include_once( $emulsion_root . 'includes/template-tags.php' );
	include_once( $emulsion_root . 'includes/hooks.php' );

	include_once( $emulsion_root . 'includes/snippets.php' );
	include_once( $emulsion_root . 'includes/color.php' );
	include_once( $emulsion_root . 'includes/keyword-highlight.php' );
	include_once( $emulsion_root . 'includes/customize.php' );
	include_once( $emulsion_root . 'includes/metabox.php' );
	include_once( $emulsion_root . 'includes/wp-scss.php' );
	include_once( $emulsion_root . 'documents/documents.php' );
} else {

	add_action( 'admin_notices', 'emulsion_admin_notice' );
	return;
}

/**
 * Theme
 */
add_action( 'after_setup_theme', 'emulsion_addon_setup' );

if ( ! function_exists( 'emulsion_addon_setup' ) ) {

	function emulsion_addon_setup() {
		/**
		 * register scss variables for wp-scss plugin
		 */
		if ( function_exists( 'wp_scss_compile' ) ) {

			add_filter( 'wp_scss_variables', 'emulsion_wp_scss_set_variables' );
		}

		if ( emulsion_get_supports( 'background' ) ) {

			add_theme_support( 'custom-background', array(
				'default-color'			 => 'ffffff',
				'default-image'			 => '', //get_theme_file_uri( 'images/background-image.png' )
				'default-preset'		 => 'default',
				'default-position-x'	 => 'left',
				'default-position-y'	 => 'top',
				'default-size'			 => 'auto',
				'default-repeat'		 => 'repeat',
				'default-attachment'	 => 'scroll',
				'wp-head-callback'		 => 'emulsion_custom_background_cb',
				'admin-head-callback'	 => '',
				'admin-preview-callback' => '',
			) );
		}
		if ( empty( get_theme_mod( 'background_image' ) ) ) {

			add_filter( 'emulsion_custom_background_cb', '__return_false' );
			add_filter( 'body_class', 'emulsion_remove_background_img_class' );
		}
		
		/**
		 * Reset Theme mods
		 * set default
		 */
		$reset_val = get_theme_mod( 'emulsion_reset_theme_settings' );

		if ( 'reset' == $reset_val ) {
			emulsion_reset_customizer_settings();
		}

		emulsion_customizer_add_supports_layout();
		emulsion_customizer_add_supports_footer();

		/**
		 * Gutenberg
		 * Apply block editor style when theme style has been removed
		 *
		 */
		if ( is_page() && false == emulsion_metabox_display_control( 'page_style' ) ) {

			add_theme_support( 'wp-block-styles' );
		}
		if ( is_single() && false == emulsion_metabox_display_control( 'style' ) ) {

			add_theme_support( 'wp-block-styles' );
		}
		if ( ! emulsion_get_supports( 'enqueue' ) ) {

			add_theme_support( 'wp-block-styles' );
		}
	}

	if ( function_exists( 'has_header_video' ) ) {
		
		/**
		 * Header video
		 */
		add_filter( 'emulsion_custom_header_defaults', function( $args ) {
			$args['video'] = true;
			return $args;
		} );
		add_filter( 'header_video_settings', 'emulsion_video_controls' );
	}
}

/**
 * Notification
 */
function emulsion_admin_notice() {
	$emulsion_addon_theme_name = esc_html( wp_get_theme( get_template() )->get( 'Name' ) );

	printf( '<div class="notice notice-error is-dismissible emulsion-addon-error"><p> [<strong>%1$s</strong>] %2$s <a href="%3$s">%4$s</a></p></div>', $emulsion_addon_theme_name . esc_html__( ' or this child theme.', 'emulsion' ), esc_html__( 'emulsion addons plugin can not support this theme.', 'emulsion' ), esc_url( admin_url( 'plugins.php?plugin_status=active' ) ), esc_html__( 'You can disable it in the plugins page', 'emulsion' )
	);
}

/**
 * Deactivation
 */
register_deactivation_hook( __FILE__, 'emulsion_deactivate_plugin' );

function emulsion_deactivate_plugin(){
	emulsion_wp_scss_deactivate_check();
	set_theme_mod( 'header_textcolor', '');
}
register_activation_hook( __FILE__,  'emulsion_activate_plugin' );

function emulsion_activate_plugin(){

	emulsion_wp_scss_activate_check();
}