<?php

/**
 * Plugin Name: emulsion addons
 * Plugin URI:  https://github.com/tenman/emulsion-addons
 * Description: A plugin for customizing WordPress theme emulsion.
 * Version:     3.0.5
 * Author:      nobita
 * Author URI:  https://www.tenman.info/
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

$emulsion_addon_accept_theme_name	 = wp_get_theme( get_template() )->get( 'Name' );
$emulsion_addon_accept_theme_version = wp_get_theme( get_template() )->get( 'Version' );
$emulsion_root						 = plugin_dir_path( __FILE__ );

$priview_theme		 = filter_input( INPUT_GET, 'customize_theme', FILTER_SANITIZE_SPECIAL_CHARS );
$priview_theme_id	 = filter_input( INPUT_GET, 'customize_messenger_channel', FILTER_SANITIZE_SPECIAL_CHARS );

if ( version_compare( $emulsion_addon_accept_theme_version, '3.0.5', '<' ) ) {

	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	deactivate_plugins( 'emulsion-addons/emulsion.php' );

	add_action( 'admin_notices', 'emulsion_addons_admin_version_notice' );

	function emulsion_addons_admin_version_notice() {
		printf( '<div class="notice notice-error is-dismissible emulsion-addon-error"><p>%1$s</p></div>', __('Deactivated the plugin. emulsion-addons version 3.0.5 requires emulsion theme 3.0.5.','emulsion') );
	}
}

if ( $priview_theme_id && $priview_theme !== $emulsion_addon_accept_theme_name ) {

	//Live Preview keeps the current theme name set unless you save it.
	//In this case, a fatal error will occur if you refer to a function of the plugin theme,
	//so stop the operation of the plugin and enable preview.

	return '';
}

$priview_theme		 = filter_input( INPUT_GET, 'theme', FILTER_SANITIZE_SPECIAL_CHARS );
$priview_theme_id	 = filter_input( INPUT_GET, 'return', FILTER_SANITIZE_SPECIAL_CHARS );

if ( $priview_theme_id && $priview_theme !== $emulsion_addon_accept_theme_name ) {

	//Live Preview keeps the current theme name set unless you save it.
	//In this case, a fatal error will occur if you refer to a function of the plugin theme,
	//so stop the operation of the plugin and enable preview.

	return '';
}

if ( ! function_exists( 'edit_theme_options' ) ) {

	include_once( ABSPATH . 'wp-includes/pluggable.php' );
}


if (  false !== strpos($emulsion_addon_accept_theme_name, 'emulsion') || get_template_directory() !== get_stylesheet_directory() ) {
	include_once( $emulsion_root . 'includes/functions.php');
	include_once( $emulsion_root . 'includes/validate.php');
	include_once( $emulsion_root . 'includes/theme-supports-functions.php' );
	include_once( $emulsion_root . 'includes/theme-supports.php' );
	include_once( $emulsion_root . 'includes/color-functions.php' );
	//include_once( $emulsion_root . 'includes/conf.php' );
	include_once( $emulsion_root . 'includes/template-tags.php' );
	include_once( $emulsion_root . 'includes/hooks.php' );
	include_once( $emulsion_root . 'includes/keyword-highlight.php' );
	include_once( $emulsion_root . 'documents/documents.php' );
} else {


	return;
}

/**
 * Theme
 */
add_action( 'after_setup_theme', 'emulsion_addon_setup' );

if ( ! function_exists( 'emulsion_addon_setup' ) ) {

	function emulsion_addon_setup() {

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

		if ( function_exists( 'emulsion_the_theme_supports' ) ) {

			/**
			 * FSE
			 */
			if ( false === emulsion_the_theme_supports( 'full_site_editor' ) ) {

				emulsion_remove_supports( 'full_site_editor' );
			}
			/**
			 * Classic Social Link
			 */
			if ( false === emulsion_the_theme_supports( 'social-link-menu' ) ) {

				emulsion_remove_supports( 'social-link-menu' );
			}

		}

	}
}

/**
 * Deactivation
 */

function emulsion_relate_posts_shortcode() {
	return do_blocks( emulsion_get_related_posts() );
}

add_shortcode( 'emulsion_relate_posts', 'emulsion_relate_posts_shortcode' );

