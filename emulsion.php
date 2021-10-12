<?php

/**
 * Plugin Name: emulsion addons
 * Plugin URI:  https://github.com/tenman/emulsion-addons
 * Description: A plugin for customizing WordPress theme emulsion.
 * Version:     2.0.7
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

if ( 'emulsion' == $emulsion_addon_accept_theme_name || 'emulsion-dev' == $emulsion_addon_accept_theme_name) {

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
	add_action( 'wp_enqueue_scripts', 'emulsion_pallet_styles' );
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
		if ( ! empty( get_theme_mod( 'background_color' ) ) && get_theme_support( 'custom-background' )[0]['default-color'] !== get_theme_mod( 'background_color' ) ) {

			set_theme_mod( 'emulsion_background_remenber', get_theme_mod( 'background_color' ) );
		} else {

			remove_theme_mod( 'emulsion_background_remenber' );
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
		$emulsion_favorite_color_name = esc_html__( 'Silver', 'emulsion-addons' );

		if ( function_exists( 'emulsion_theme_default_val' ) ) {

			$emulsion_favorite_color_palette		 = sanitize_text_field( get_theme_mod( 'emulsion_favorite_color_palette', false ) );
			$emulsion_favorite_color_palette_default = sanitize_text_field( emulsion_theme_default_val( 'emulsion_favorite_color_palette' ) );

			if ( $emulsion_favorite_color_palette !== $emulsion_favorite_color_palette_default ) {

				$emulsion_favorite_color_name = esc_html__( 'My Color', 'emulsion-addons' );
			}
		}

		if ( 'enable' == get_theme_mod( 'emulsion_theme_color_palette' ) ) {

			add_theme_support(
					'editor-color-palette', array(
				array(
					'name'	 => esc_html__( 'Black', 'emulsion-addons' ),
					'slug'	 => sanitize_title( 'black' ),
					'color'	 => '#333333',
				),
				array(
					'name'	 => esc_html__( 'Gray', 'emulsion-addons' ),
					'slug'	 => sanitize_title( 'gray' ),
					'color'	 => '#A9A9A9',
				),
				array(
					'name'	 => esc_html__( 'White', 'emulsion-addons' ),
					'slug'	 => sanitize_title( 'white' ),
					'color'	 => '#ffffff',
				),
				array(
					'name'	 => esc_html__( 'Alert', 'emulsion-addons' ),
					'slug'	 => sanitize_title( 'alert' ),
					'color'	 => 'rgba(231, 76, 60,.4)',
				),
				array(
					'name'	 => esc_html__( 'Notice', 'emulsion-addons' ),
					'slug'	 => sanitize_title( 'notice' ),
					'color'	 => 'rgba(163, 140, 8,.4)',
				),
				array(
					'name'	 => esc_html__( 'Info', 'emulsion-addons' ),
					'slug'	 => sanitize_title( 'info' ),
					'color'	 => 'rgba(22, 160, 133,.4)',
				),
				array(
					'name'	 => esc_html__( 'Cool', 'emulsion-addons' ),
					'slug'	 => sanitize_title( 'cool' ),
					'color'	 => 'rgba(52, 152, 219,.4)',
				),
				array(
					'name'	 => $emulsion_favorite_color_name,
					'slug'	 => sanitize_title_with_dashes( $emulsion_favorite_color_name ),
					'color'	 => $emulsion_favorite_color_palette,
				),
			) );
		}

		/**
		 * Block Editor experimantal styles
		 *
		 */
		if ( emulsion_the_theme_supports( 'block_experimentals' ) ) {

			emulsion_add_supports( 'block_experimentals' );
		}
		/**
		 * Date format Japan era
		 * replace Y年n月j日 to 令和[0-9]年n月j日
		 */
		if ( emulsion_the_theme_supports( 'japan_era' ) ) {

			emulsion_add_supports( 'japan_era' );
		}
		/**
		 * FSE
		 */
		if ( false === emulsion_the_theme_supports( 'full_site_editor' ) ) {

			emulsion_remove_supports( 'full_site_editor' );
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
	/**
	 * emulsion theme suppports
	 */
	'disable' == get_theme_mod( 'emulsion_relate_posts', emulsion_get_var( 'emulsion_relate_posts' ) ) ? emulsion_remove_supports( 'relate_posts' ) : '';
	'disable' == get_theme_mod( 'emulsion_tooltip', emulsion_get_var( 'emulsion_tooltip' ) ) ? emulsion_remove_supports( 'tooltip' ) : '';
	'disable' == get_theme_mod( 'emulsion_search_drawer', emulsion_get_var( 'emulsion_search_drawer' ) ) ? emulsion_remove_supports( 'search_drawer' ) : '';
	'full_text' == get_theme_mod( 'emulsion_layout_search_results', emulsion_get_var( 'emulsion_layout_search_results' ) ) ? emulsion_remove_supports( 'search_keyword_highlight' ) : '';
	'disable' == get_theme_mod( 'emulsion_alignfull', emulsion_get_var( 'emulsion_alignfull' ) ) ? emulsion_remove_supports( 'alignfull' ) : '';
	'no' == get_theme_mod( 'emulsion_title_in_header', emulsion_get_var( 'emulsion_title_in_header' ) ) ? emulsion_remove_supports( 'title_in_page_header' ) : '';
	'disable' == get_theme_mod( 'emulsion_table_of_contents', emulsion_get_var( 'emulsion_table_of_contents' ) ) ? emulsion_remove_supports( 'toc' ) : '';
	'remove' == get_theme_mod( 'emulsion_page_header', emulsion_get_var( 'emulsion_page_header' ) ) ? emulsion_remove_supports( 'header' ) : '';

	'disable' == get_theme_mod( 'emulsion_instantclick', emulsion_get_var( 'emulsion_instantclick' ) ) ? emulsion_remove_supports( 'instantclick' ) : '';
	'disable' == get_theme_mod( 'emulsion_lazyload', emulsion_get_var( 'emulsion_lazyload' ) ) ? emulsion_remove_supports( 'lazyload' ) : '';

}



function emulsion_pallet_styles() {

	wp_register_style( 'emulsion-pallet', esc_url( plugin_dir_url( __DIR__ ) . 'emulsion-addons/css/color-pallet.css' ), array(), time(), 'all' );

	wp_enqueue_style( 'emulsion-pallet' );
}

/**
 * Deactivation
 */
register_deactivation_hook( __FILE__, 'emulsion_deactivate_plugin' );

function emulsion_deactivate_plugin() {
	emulsion_wp_scss_deactivate_check();
	set_theme_mod( 'header_textcolor', '' );
}

register_activation_hook( __FILE__, 'emulsion_activate_plugin' );

function emulsion_activate_plugin() {

	emulsion_wp_scss_activate_check();
}


function emulsion_relate_posts_shortcode( ){

	return emulsion_get_related_posts();
}
add_shortcode( 'emulsion_relate_posts', 'emulsion_relate_posts_shortcode' );


