<?php
/**
 * WP-SCSS Plugin Helper script
 *
 * @see https://wordpress.org/plugins/wp-scss/
 */

/**
 * Check WP-SCSS Plugin is ACTIVE
 * After activating the theme, the WP - SCSS plug - in must activate.
 *
 * 'active' == get_theme_mod('emulsion_wp_scss_status')
 */
function emulsion_set_wp_scss_options() {

	$wpscss_options = get_option( 'wpscss_options', false );

	if ( false == $wpscss_options ) {

		$emulsion_scss_dir	 = '/source/scss/';
		$emulsion_css_dir	 = '/css/';

		if ( $wpscss_options['scss_dir'] !== $emulsion_scss_dir || $wpscss_options['css_dir'] !== $emulsion_css_dir ) {
			if ( file_exists( get_theme_file_path( $emulsion_scss_dir ) ) ) {

				$wpscss_options['scss_dir'] = $emulsion_scss_dir;
			}
			if ( file_exists( get_theme_file_path( $emulsion_css_dir ) ) ) {

				$wpscss_options['css_dir'] = $emulsion_css_dir;
			}

			update_option( 'wpscss_options', $wpscss_options );
		}
	}
}
// TODO
register_activation_hook( WP_CONTENT_DIR . '/plugins/wp-scss/wp-scss.php', 'emulsion_wp_scss_activate_check' );

function emulsion_wp_scss_activate_check() {
	set_theme_mod( 'emulsion_wp_scss_status', 'active' );
	emulsion_set_wp_scss_options();
}

register_deactivation_hook( WP_CONTENT_DIR . '/plugins/wp-scss/wp-scss.php', 'emulsion_wp_scss_deactivate_check' );

function emulsion_wp_scss_deactivate_check() {
	set_theme_mod( 'emulsion_wp_scss_status', 'deactive' );
}

if( function_exists( 'emulsion_is_plugin_active' ) 
		&& emulsion_is_plugin_active( 'wp-scss/wp-scss.php' ) 
		&& 'active' !== get_theme_mod( 'emulsion_wp_scss_status', false ) ) {
	
	//When you switch themes, cooperation with wp-scss may be canceled, and if the plugin is active, cooperate.
	//Do nothing if wp-scss is active before installing the theme.
	set_theme_mod( 'emulsion_wp_scss_status', 'active' );
	emulsion_set_wp_scss_options();
}
if( function_exists( 'emulsion_is_plugin_active' ) && ! emulsion_is_plugin_active( 'wp-scss/wp-scss.php' ) ){
	set_theme_mod( 'emulsion_wp_scss_status', 'deactive' );
}
// End TODO

if ( 'active' == get_theme_mod( 'emulsion_wp_scss_status' ) ) {

	add_filter( 'wp_scss_needs_compiling', 'emulsion_wp_scss_needs_compiling' );
}

function emulsion_wp_scss_needs_compiling( $compile ) {

	if ( ! is_user_logged_in() ) {
		return false;
	}
	if ( current_user_can( 'edit_theme_options' ) && ! is_customize_preview( ) ) {

		$reset_val = get_theme_mod( 'emulsion_reset_theme_settings' );

		if ( 'reset' == $reset_val ) {
			return true;
		}

		if( 'yes' == emulsion_get_css_variables_values( 'is_changed' ) ) {
			return true;
		}
	}
	return $compile;
}



/**
 * Creating SCSS variables for wp-scss plugin
 * @global type $emulsion_custom_header_defaults
 * @return string
 */
/**
 * register scss variables for wp-scss plugin
 */
function emulsion_wp_scss_set_variables() {

	global $emulsion_custom_header_defaults;

	$stream_condition	 = emulsion_get_css_variables_values( 'stream' );
	$grid_condition		 = emulsion_get_css_variables_values( 'grid' );

	$variables			 = array(
		'background_image_dim'				 => emulsion_get_css_variables_values( 'background_image_dim' ),
		'heading_font_scale'				 => emulsion_get_css_variables_values( 'heading_font_scale' ),
		'heading_font_base'					 => emulsion_get_css_variables_values( 'heading_font_base' ),
		'header_media_max_height'			 => emulsion_get_css_variables_values( 'header_media_max_height' ),
		'post_display_date'					 => emulsion_get_css_variables_values( 'post_display_date' ),
		'post_display_author'				 => emulsion_get_css_variables_values( 'post_display_author' ),
		'post_display_category'				 => emulsion_get_css_variables_values( 'post_display_category' ),
		'post_display_tag'					 => emulsion_get_css_variables_values( 'post_display_tag' ),
		'sub_background_color_lighten'		 => emulsion_get_css_variables_values( 'sub_background_color_lighten' ),
		'sub_background_color_darken'		 => emulsion_get_css_variables_values( 'sub_background_color_darken' ),
		'favorite_color_palette'			 => emulsion_get_css_variables_values( 'favorite_color_palette' ),
		'header_category'					 => emulsion_get_css_variables_values( 'header_category' ), // Not CSS variables
		'wp_scss_status'					 => get_theme_mod( 'emulsion_wp_scss_status', 'active' ),
		'header_category'					 => emulsion_get_css_variables_values( 'header_category' ), // Not CSS variables
		'header_gradient'					 => emulsion_get_css_variables_values( 'header_gradient' ), // Not CSS variables
		'content_margin_top'				 => emulsion_get_css_variables_values( 'content_margin_top' ),
		'colors_for_editor'					 => emulsion_get_css_variables_values( 'colors_for_editor' ),
		'general_text_color'				 => emulsion_get_css_variables_values( 'general_text_color' ),
		'general_link_hover_color'			 => emulsion_get_css_variables_values( 'general_link_hover_color' ),
		'general_link_color'				 => emulsion_get_css_variables_values( 'general_link_color' ),
		'excerpt_linebreak'					 => emulsion_get_css_variables_values( 'excerpt_linebreak' ),
		'comments_link_color'				 => emulsion_get_css_variables_values( 'comments_link_color' ),
		'comments_color'					 => emulsion_get_css_variables_values( 'comments_color' ),
		'comments_bg'						 => emulsion_get_css_variables_values( 'comments_bg' ),
		'sidebar_link_color'				 => emulsion_get_css_variables_values( 'sidebar_link_color' ),
		'sidebar_hover_color'				 => emulsion_get_css_variables_values( 'sidebar_hover_color' ),
		'sidebar_color'						 => emulsion_get_css_variables_values( 'sidebar_color' ),
		'sidebar_background'				 => emulsion_get_css_variables_values( 'sidebar_background' ),
		'primary_menu_link_color'			 => emulsion_get_css_variables_values( 'primary_menu_link_color' ),
		'primary_menu_color'				 => emulsion_get_css_variables_values( 'primary_menu_color' ),
		'primary_menu_background'			 => emulsion_get_css_variables_values( 'primary_menu_background' ),
		'relate_posts_link_color'			 => emulsion_get_css_variables_values( 'relate_posts_link_color' ),
		'relate_posts_color'				 => emulsion_get_css_variables_values( 'relate_posts_color' ),
		'relate_posts_bg'					 => emulsion_get_css_variables_values( 'relate_posts_bg' ),
		'media_text_section_link_color'		 => emulsion_get_css_variables_values( 'media_text_section_link_color' ),
		'media_text_section_color'			 => emulsion_get_css_variables_values( 'media_text_section_color' ),
		'media_text_section_bg'				 => emulsion_get_css_variables_values( 'media_text_section_bg' ),
		'media_text_section_height'			 => emulsion_get_css_variables_values( 'media_text_section_height' ),
		'columns_section_link_color'		 => emulsion_get_css_variables_values( 'columns_section_link_color' ),
		'columns_section_color'				 => emulsion_get_css_variables_values( 'columns_section_color' ),
		'columns_section_bg'				 => emulsion_get_css_variables_values( 'columns_section_bg' ),
		'columns_section_height'			 => emulsion_get_css_variables_values( 'columns_section_height' ),
		'gallery_section_link_color'		 => emulsion_get_css_variables_values( 'gallery_section_link_color' ),
		'gallery_section_color'				 => emulsion_get_css_variables_values( 'gallery_section_color' ),
		'gallery_section_bg'				 => emulsion_get_css_variables_values( 'gallery_section_bg' ),
		'gallery_section_height'			 => emulsion_get_css_variables_values( 'gallery_section_height' ),
		'status'							 => get_theme_mod( 'emulsion_wp_scss_status' ),
		'image_sizes'						 => emulsion_get_images_width_for_scss(), // Old gallery caliculate wrapper width
		'header_text_color'					 => emulsion_get_css_variables_values( 'header_text_color' ),
		'header_link_color'					 => emulsion_get_css_variables_values( 'header_link_color' ),
		'header_hover_color'				 => emulsion_get_css_variables_values( 'header_hover_color' ),
		'header_bg_color'					 => emulsion_get_css_variables_values( 'header_background_color' ),
		'header_background_gradient_color'	 => emulsion_get_css_variables_values( 'header_background_gradient_color' ),
		'theme_image_dir'					 => emulsion_get_css_variables_values( 'theme_image_dir' ),
		'upload_base_dir'					 => emulsion_get_css_variables_values( 'upload_base_dir' ),
		'header_image_ratio'				 => emulsion_get_css_variables_values( 'header_image_ratio' ),
		'background_color'					 => emulsion_get_css_variables_values( 'background_color' ),
		'stream-condition'					 => empty( $stream_condition ) ? 'body' : $stream_condition,
		'grid-condition'					 => empty( $grid_condition ) ? 'body' : $grid_condition,
		'language'							 => esc_attr( get_locale() ),
		'hover_color'						 => emulsion_get_css_variables_values( 'hover_color' ),
		'sidebar_width'						 => emulsion_get_css_variables_values( 'sidebar_width' ),
		'sidebar-position'					 => emulsion_get_css_variables_values( 'sidebar_position' ),
		'i18n_no_title'						 => esc_html__( 'No Title', 'emulsion' ),
		'editor_font_sizes'					 => emulsion_get_css_variables_values( 'font_sizes' ),
		'editor_color_palettes'				 => emulsion_get_css_variables_values( 'color_palette' ),
		'body_id'							 => '#' . emulsion_theme_info( 'Slug', false ),
		'footer_widget_width'				 => emulsion_get_css_variables_values('footer_widget_width'),
		'common_font_size'					 => emulsion_get_css_variables_values( 'common_font_size' ),
		'common_font_family'				 => emulsion_get_css_variables_values( 'common_font_family' ),
		'heading_font_family'				 => emulsion_get_css_variables_values( 'heading_font_family' ),
		'heading_font_weight'				 => emulsion_get_css_variables_values( 'heading_font_weight' ),
		'heading_font_scale'				 => emulsion_get_css_variables_values( 'heading_font_scale' ),
		'heading_font_transform'			 => emulsion_get_css_variables_values( 'heading_font_transform' ),
		'meta_data_font_size'				 => emulsion_get_css_variables_values( 'widget_meta_font_size' ),
		'meta_data_font_family'				 => emulsion_get_css_variables_values( 'widget_meta_font_family' ),
		'meta_data_font_transform'			 => emulsion_get_css_variables_values( 'widget_meta_font_transform' ),
		'layout_homepage'					 => emulsion_get_css_variables_values( 'layout_homepage' ),
		'layout_date_archives'				 => emulsion_get_css_variables_values( 'layout_date_archives' ),
		'layout_category_archives'			 => emulsion_get_css_variables_values( 'layout_category_archives' ),
		'layout_tag_archives'				 => emulsion_get_css_variables_values( 'layout_tag_archives' ),
		'layout_author_archives'			 => emulsion_get_css_variables_values( 'layout_author_archives' ),
		'layout_posts_page'					 => emulsion_get_css_variables_values( 'layout_posts_page' ),
		'content_width'						 => emulsion_get_css_variables_values( 'content_width' ),
		'box_gap'							 => emulsion_get_css_variables_values( 'box_gap' ),
		'main_width'						 => emulsion_get_css_variables_values( 'main_width' ),
		'align_offset'						 => emulsion_get_css_variables_values( 'align_offset' ),
		'sidebar_width'						 => emulsion_get_css_variables_values( 'sidebar_width' ),
		'content_gap'						 => emulsion_get_css_variables_values( 'content_gap' ),
		'content_line_height'				 => emulsion_get_css_variables_values( 'content_line_height' ),
		'common_line_height'				 => emulsion_get_css_variables_values( 'common_line_height' ),
		'caption_height'					 => emulsion_get_css_variables_values( 'caption_height' ),
		'default_header_height'				 => emulsion_get_css_variables_values( 'default_header_height' ),
		'full_width_negative_margin'		 => emulsion_get_css_variables_values( 'full_width_nagative_margin' ),
	);

	return $variables;
}

