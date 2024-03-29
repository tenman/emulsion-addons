<?php
/**
 * Customizer Settings
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( function_exists('emulsion_get_theme_operation_mode') && 'fse' == emulsion_get_theme_operation_mode() ) {
		return;
}

global $wp_customize;
add_action( 'customize_register', 'emulsion_remove_display_header_text', 11 );

function emulsion_remove_display_header_text( $wp_customize ) {
	/**
	 * Tneme not using header_textcolor blank
	 * Setting custom-logo will replace site-title site-description with the logo.
	 */
	/**
	 * For the Display Site Title and Tagline checkbox to work,
	 * the option value for 'header_textcolor' allow the value 'blank’
	 * but 'blank' is not the hex color value . It is not desirable to mix
	 *
	 * If you allow 'blank'
	 * please note that the customizer header text color setting may not be displayed
	 *
	 * For validation,
	 * comment out the add_action above and
	 * add set_theme_mod ('header_textcolor', 'blank');
	 *
	 * Check customizer fields
	 * Display Site Title and Tagline check box is not checked
	 * Color/Header text color is not displayed
	 *
	 * If you want to revert, undo the changes and
	 * reset in Theme Advanced settings / Reset theme settings to revert.
	 *
	 * This feature removal is implemented using an action hook,
	 * so you can easily remove the feature.
	 */

	$wp_customize->remove_control( 'display_header_text' );
}

if ( $wp_customize ) {

	$wp_customize->add_setting( 'header_textcolor', array( 'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color' ) );

	$wp_customize->selective_refresh->add_partial( 'header_textcolor', array(
		'selector' => '.header-text',
	) );
	/**
	 * Preview link icon
	 */
	$wp_customize->selective_refresh->add_partial( 'emulsion_heading_font_family', array(
		'selector' => '.entry-title, h1,h2,h3,h4,.h1,.h2,.h3,h4,.site-title',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_heading_font_weight', array(
		'selector' => '.entry-title, h1,h2,h3,h4,.h1,.h2,.h3,h4,.site-title',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_common_font_family', array(
		'selector' => '.entry-content',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_widget_meta_font_size', array(
		'selector' => '.sidebar-widget-area,.footer-widget-area,nav',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_widget_meta_title', array(
		'selector' => '.sidebar-widget-area,.footer-widget-area,nav',
	) );

	$wp_customize->selective_refresh->add_partial( 'emulsion_block_gallery_section_height', array(
		'selector' => '.wp-block-gallery',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_block_columns_section_height', array(
		'selector' => '.wp-block-columns',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_block_media_text_section_height', array(
		'selector' => '.wp-block-media-text',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_comments_bg', array(
		'selector' => '.comments',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_relate_posts_bg', array(
		'selector' => '.relate-content-wrapper',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_excerpt_length', array(
		'selector' => '.article-wrapper:first-child .content-excerpt',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_excerpt_length_grid', array(
		'selector' => '.layout-grid .article-wrapper:first-child .trancate',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_excerpt_length_stream', array(
		'selector' => '.layout-stream .article-wrapper:first-child .trancate',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_header_layout', array(
		'selector' => 'body > header',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_sidebar_position', array(
		'selector' => '.sidebar-widget-area',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_layout_author_archives', array(
		'selector' => '.author .page-wrapper',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_layout_tag_archives', array(
		'selector' => '.tag .page-wrapper',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_layout_homepage', array(
		'selector' => '.home:not(.page) .page-wrapper',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_layout_date_archives', array(
		'selector' => '.date .page-wrapper',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_layout_category_archives', array(
		'selector' => '.category .page-wrapper',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_layout_posts_page', array(
		'selector' => '.blog .page-wrapper',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_search_drawer', array(
		'selector' => '.drawer-wrapper .drawer-block',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_table_of_contents', array(
		'selector' => '.menu-placeholder',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_sticky_sidebar', array(
		'selector' => '.sidebar-widget-area',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_relate_posts', array(
		'selector' => '.relate-content-wrapper',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_post_display_date_format', array(
		'selector' => '.posted-on',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_common_font_size', array(
		'selector' => '.entry-content',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_common_font_family', array(
		'selector' => '.entry-content',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_header_gradient', array(
		'selector' => '.header-layer',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_footer_credit', array(
		'selector' => '.banner address',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_header_media_max_height', array(
		'selector' => '.header-layer',
	) );
	$wp_customize->selective_refresh->add_partial( 'display_header_text', array(
		'selector' => '.site-title-text, .site-description',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_header_background_color', array(
		'selector' => '.header-layer, .grid header',
	) );

	$wp_customize->selective_refresh->add_partial( 'emulsion_bg_image_text', array(
		'selector' => 'article',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_bg_image_blend_color', array(
		'selector' => 'html',
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_bg_image_blend_color_amount', array(
		'selector' => 'html',
	) );
	////////////////////////////
	$wp_customize->selective_refresh->add_partial( 'emulsion_border_global', array(
		'selector' => 'body.has-border-custom', 'fallback_refresh'	 => true,
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_border_global_style', array(
		'selector' => 'body.has-border-custom', 'fallback_refresh'	 => true,
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_border_global_width', array(
		'selector' => 'body.has-border-custom', 'fallback_refresh'	 => true,
	) );

	$wp_customize->selective_refresh->add_partial( 'emulsion_border_sidebar', array(
		'selector' => '.sidebar-widget-area.has-border-custom, .footer-widget-area.has-border-custom', 'fallback_refresh'	 => true,
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_border_sidebar_style', array(
		'selector' => '.sidebar-widget-area.has-border-custom, .footer-widget-area.has-border-custom', 'fallback_refresh'	 => true,
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_border_sidebar_width', array(
		'selector' => '.sidebar-widget-area.has-border-custom, .footer-widget-area.has-border-custom', 'fallback_refresh'	 => true,
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_border_grid', array(
		'selector' => '.grid.has-border-custom', 'fallback_refresh'	 => true,
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_border_grid_style', array(
		'selector' => '.grid.has-border-custom', 'fallback_refresh'	 => true,
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_border_grid_width', array(
		'selector' => '.grid.has-border-custom', 'fallback_refresh'	 => true,
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_border_stream', array(
		'selector' => '.stream.has-border-custom', 'fallback_refresh'	 => true,
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_border_stream_style', array(
		'selector' => '.stream.has-border-custom', 'fallback_refresh'	 => true,
	) );
	$wp_customize->selective_refresh->add_partial( 'emulsion_border_stream_width', array(
		'selector' => '.stream.has-border-custom', 'fallback_refresh'	 => true,
	) );
}

/**
 * Customize Preview js
 */
function emulsion_customize_preview_js() {

	$emulsion_current_data_version = emulsion_theme_info( 'Version', false );
	// need no cache

	if ( is_customize_preview() ) {

		wp_enqueue_script( 'emulsion-customize-preview',
			esc_url( plugin_dir_url( __DIR__ ). 'js/customize-preview.js' ), array( 'customize-preview' ), $emulsion_current_data_version, true );
		/* in iframe */
		wp_enqueue_style( 'emulsion-customize-preview-style',
			esc_url( plugin_dir_url( __DIR__ ). 'css/customize-preview.css' ), array( 'emulsion' ), $emulsion_current_data_version, 'all' );
		/* translation */
		add_filter('emulsion_inline_style_pre', 'emulsion_customizer_translate_css');


	}
}


function emulsion_customize_controle_js() {

	$emulsion_current_data_version = emulsion_theme_info( 'Version', false );

	wp_enqueue_script( 'customize-controle',
		esc_url( plugin_dir_url( __DIR__ ) . 'js/customize-controle.js' ), array( 'jquery' ), $emulsion_current_data_version, true );

	$translation_array = emulsion_customize_controle_translate();

	wp_localize_script( 'customize-controle', 'emulsion_customizer_controle', $translation_array );
}

function emulsion_customize_controle_translate() {

	$emulsion_customizer_redirect_setting_url	 = 'javascript:wp.customize.control( \'emulsion_customizer_preview_redirect\' ).focus()';
	$emulsion_section_notification_message		 = '<p>' . esc_html__( 'You can move to another page by clicking the preview link', 'emulsion-addons' ) . '</p>'
			. sprintf( ' <a href="%1$s">%2$s</a>', $emulsion_customizer_redirect_setting_url, esc_html__( 'Redirect setting', 'emulsion-addons' ) );
	$last_post_date								 = strtotime( get_lastpostdate() );

	$translation_array = array(
		'latest_post_id'											 => emulsion_get_customize_post_id( 'latest-post' ),
		'galley_post_id'											 => emulsion_get_customize_post_id( 'gallery' ),
		'columns_post_id'											 => emulsion_get_customize_post_id( 'columns' ),
		'media_text_post_id'										 => absint( emulsion_get_customize_post_id( 'media-text' ) ),
		'alignwide_post_id'											 => emulsion_get_customize_post_id( 'alignwide' ),
		'most_used_tag_slug'										 => emulsion_get_customize_post_id( 'tag-slug' ),
		'customizer_preview_redirect'								 => get_theme_mod( 'emulsion_customizer_preview_redirect', emulsion_get_var( 'emulsion_customizer_preview_redirect' ) ),
		'date_archive_query'										 => date( 'Ym', $last_post_date ),
		'header_gradient_setting'									 => get_theme_mod( 'emulsion_header_gradient', emulsion_get_var( 'emulsion_header_gradient' ) ),
		'code_box_gap_not_found_notification'						 => esc_html__( 'Gallery block was not found. Please display a preview with culumns block.', 'emulsion-addons' ),
		'code_narrow_width_notification'							 => esc_html__( 'The Main width must be the same as or greater than the Content width.', 'emulsion-addons' ),
		'code_too_width_notification'								 => esc_html__( 'Content width must be less than or equal to Main width.', 'emulsion-addons' ),
		'code_gallery_not_found_notification'						 => esc_html__( 'Gallery block was not found. Please display a preview with gallery block.', 'emulsion-addons' ),
		'code_columns_not_found_notification'						 => esc_html__( 'Columns block was not found. Please display a preview with columns block.', 'emulsion-addons' ),
		'code_media_text_not_found_notification'					 => esc_html__( 'Media text block was not found. Please display a preview with media text block.', 'emulsion-addons' ),
		'code_reset_theme_setting_notification'						 => esc_html__( 'The theme settings are reset. It can not be undone.', 'emulsion-addons' ),
		'code_relate_setting_alert'									 => esc_html__( 'This change does not reflect the settings for header media, Display title in header.', 'emulsion-addons' ),
		'code_fadeout_message_category_colors'						 => '<span class="emulsion_fadeout_message emulsion_fadeout_message_category_colors">'
			. '<span class="emulsion-spinner"></span>' . esc_html__( 'moving preview to category', 'emulsion-addons' ) . '</span>'
			. esc_html__( 'You can move to another page by clicking the preview link', 'emulsion-addons' )
			. sprintf( ' <a href="%1s">%2s</a>', $emulsion_customizer_redirect_setting_url, esc_html__( 'Redirect setting', 'emulsion-addons' ) ),
		'code_widgets_panel_notification'							 => '<p>' . esc_html__( 'When setting up the post sidebar, the post must be displayed in preview.', 'emulsion-addons' ) . '</p>'
			. '<p>' . esc_html__( 'When setting up the page sidebar, the page must be displayed in preview.', 'emulsion-addons' ) . '</p>',
		'code_header_image_notification'							 => esc_html__( 'Header media can not be displayed because the header layout is set to something other than custom.', 'emulsion-addons' ),
		'code_section_block_editor_box_gap_notification'			 => '<span class="emulsion_fadeout_message_section_block_editor_box_gap">'
			. '<span class="emulsion-spinner"></span>' . esc_html__( 'moving preview to has gallery block post', 'emulsion-addons' ) . '</span>' . $emulsion_section_notification_message,
		'code_section_block_editor_block_gallery_notification'		 => '<span class="emulsion_fadeout_message_section_block_editor_block_gallery">'
			. '<span class="emulsion-spinner"></span>' . esc_html__( 'moving preview to has gallery block post', 'emulsion-addons' ) . '</span>' . $emulsion_section_notification_message,
		'code_section_block_editor_block_columns_notification'		 => '<span class="emulsion_fadeout_message_section_block_editor_block_columns">'
			. '<span class="emulsion-spinner"></span>' . esc_html__( 'moving preview to has columns block post', 'emulsion-addons' ) . '</span>' . $emulsion_section_notification_message,
		'code_section_block_editor_block_media_text_notification'	 => '<span class="emulsion_fadeout_message_section_block_editor_block_media_text">'
			. '<span class="emulsion-spinner"></span>' . esc_html__( 'moving preview to has columns block post', 'emulsion-addons' ) . '</span>' . $emulsion_section_notification_message,
		'code_section_block_editor_alignwide_notification'			 => '<span class="emulsion_fadeout_message_section_block_editor_alignwide">'
			. '<span class="emulsion-spinner"></span>' . esc_html__( 'moving preview to has alignwide, alignfull post', 'emulsion-addons' ) . '</span>' . $emulsion_section_notification_message,
		'code_section_block_editor_not_found_notification'			 => '<p>' . esc_html__( 'No posts found related to settings', 'emulsion-addons' ) . '</p>',
		'code_section_scheme_notification'					 => '<span class="emulsion_fadeout_message_section_layout_homepage">'
			. '<span class="emulsion-spinner"></span>' . esc_html__( 'moving preview to home', 'emulsion-addons' ) . '</span>' . $emulsion_section_notification_message,
		'code_section_layout_homepage_notification'					 => '<span class="emulsion_fadeout_message_section_layout_homepage">'
			. '<span class="emulsion-spinner"></span>' . esc_html__( 'moving preview to home', 'emulsion-addons' ) . '</span>' . $emulsion_section_notification_message,
		'code_section_layout_category_archives_notification'		 => '<span class="emulsion_fadeout_message_section_layout_category_archives">'
			. '<span class="emulsion-spinner"></span>' . esc_html__( 'moving preview to category archives', 'emulsion-addons' ) . '</span>' . $emulsion_section_notification_message,
		'code_section_layout_author_archives_notification'			 => '<span class="emulsion_fadeout_message_section_layout_author_archives">'
			. '<span class="emulsion-spinner"></span>' . esc_html__( 'moving preview to author archives', 'emulsion-addons' ) . '</span>' . $emulsion_section_notification_message,
		'code_section_layout_date_archives_notification'			 => '<span class="emulsion_fadeout_message_section_layout_date_archives">'
			. '<span class="emulsion-spinner"></span>' . esc_html__( 'moving preview to date archives', 'emulsion-addons' ) . '</span>' . $emulsion_section_notification_message,
		'code_section_layout_tag_archives_notification'				 => '<span class="emulsion_fadeout_message_section_layout_tag_archives">'
			. '<span class="emulsion-spinner"></span>' . esc_html__( 'moving preview to tag archives', 'emulsion-addons' ) . '</span>' . $emulsion_section_notification_message,
		'code_section_header_image_notification'			 => '<span class="emulsion_fadeout_message_section_header_image">'
			. '<span class="emulsion-spinner"></span>' . esc_html__( 'moving preview to home', 'emulsion-addons' ) . '</span>' . $emulsion_section_notification_message,
		'code__section_layout_main_notification'					 => '<span class="emulsion_fadeout_message__section_layout_main">'
			. '<span class="emulsion-spinner"></span>' . esc_html__( 'moving preview to latest post', 'emulsion-addons' ) . '</span>' . $emulsion_section_notification_message,
		'background_image_notification'								 => '<span class="emulsion_fadeout_message__section_background_image">'
			. '<span class="emulsion-spinner"></span>' . esc_html__( 'moving preview to latest post', 'emulsion-addons' ) . '</span>' . $emulsion_section_notification_message
			. '<p>' . esc_html__( 'The background image is display only for single posts and pages.', 'emulsion-addons' ) . '</p>'
			. '<p>' . esc_html__( 'If you see a default button, press it to save and reload. Then, set your favorite background image.', 'emulsion-addons' ) . '</p>',
		'scheme_notification'						 => '<p>'.esc_html__( 'At this time, this setting does not support real-time preview', 'emulsion-addons' ).
		'<br />'. esc_html__( 'After changing the settings, save and reload your browser', 'emulsion-addons' ). '</p>'	,
	);
	return $translation_array;
}

add_action( 'customize_controls_enqueue_scripts', 'emulsion_customize_controle_js' );



function emulsion_customizer_translate_css( $css ) {

	if( ! is_customize_preview() ){
		return $css;
	}

	$layout_header			 = esc_html__( 'Layout Header', 'emulsion-addons' );
	$header_background		 = esc_html__( 'header background', 'emulsion-addons' );
	$meta_font_settings		 = esc_html__( 'meta font settings', 'emulsion-addons' );
	$general_font_setting	 = esc_html__( 'general font setting', 'emulsion-addons' );
	$block_columns_setting	 = esc_html__( 'block columns setting', 'emulsion-addons' );
	$footer_credit			 = esc_html__( 'footer credit, cols', 'emulsion-addons' );
	$header_background		 = esc_html__( 'header background', 'emulsion-addons' );
	$post_metadata			 = esc_html__( 'post metadata', 'emulsion-addons' );
	$menu_settings			 = esc_html__( 'menu settings', 'emulsion-addons' );
	$widget_settings		 = esc_html__( 'widget settings', 'emulsion-addons' );
	$relate_posts_background = esc_html__( 'relate posts background \00a0\00a0', 'emulsion-addons' );
	$search_drawer			 = esc_html__( 'search drawer', 'emulsion-addons' );
	$header_media			 = esc_html__( 'header media', 'emulsion-addons' );
	$layout_home_page		 = esc_html__( 'layout home page', 'emulsion-addons' );
	$excerpt_length			 = esc_html__( 'excerpt length', 'emulsion-addons' );
	$layout_category		 = esc_html__( 'layout category', 'emulsion-addons' );
	$block_media_text		 = esc_html__( 'block media text', 'emulsion-addons' );
	$table_of_contents		 = esc_html__( 'table of contents', 'emulsion-addons' );
	$sticky_sidebar			 = esc_html__( 'sticky sidebar', 'emulsion-addons' );
	$layout_sidebar			 = esc_html__( 'layout sidebar', 'emulsion-addons' );
	$display_relate_post	 = esc_html__( 'display relate post', 'emulsion-addons' );
	$layout_posts_page		 = esc_html__( 'layout posts page', 'emulsion-addons' );
	$layout_date_archive	 = esc_html__( 'layout date archive', 'emulsion-addons' );
	$layout_author			 = esc_html__( 'layout author', 'emulsion-addons' );
	$layout_tag_archive		 = esc_html__( 'layout tag archive', 'emulsion-addons' );
	$excerpt_length			 = esc_html__( 'excerpt length', 'emulsion-addons' );
	$gallery_block_settings	 = esc_html__( 'gallery block settings', 'emulsion-addons' );
	$header_media_height	 = esc_html__( 'header media height', 'emulsion-addons' );
	$emulsion_bg_image       = esc_html__( 'background image', 'emulsion-addons' );


	$css .= <<<CSS
body.is-singular .customize-partial-edit-shortcut-emulsion_bg_image_text:hover:after{
    content:'{$emulsion_bg_image}';
    left:24px;
}
body.home .customize-partial-edit-shortcut-custom_header:hover:after{
    content:'{$header_media}';
    left:24px;
}
body .header-layer .customize-partial-edit-shortcut-emulsion_header_layout:hover:after,
body .template-part-header .customize-partial-edit-shortcut-emulsion_header_layout:hover:after{
    content:'{$layout_header}';
    top:1.5rem;
}

body .template-part-header .customize-partial-edit-shortcut-emulsion_header_gradient:hover:after{
    content:'{$header_background}';
    top:1.5rem;
}
body .header-layer .customize-partial-edit-shortcut-emulsion_header_gradient:hover:after{
     content:'{$header_background}';
}
body.home .customize-partial-edit-shortcut-emulsion_widget_meta_font_size:hover:after{
    content:'{$meta_font_settings}';
}
body.home .customize-partial-edit-shortcut-emulsion_common_font_size:hover:after{
    content:'{$general_font_setting}';
}
body .sectionized-wp-block-columns .customize-partial-edit-shortcut-emulsion_block_columns_section_height:hover:after{
    content:'{$block_columns_setting}';
}
body .footer-layer .customize-partial-edit-shortcut-emulsion_footer_credit:hover:after{
    content:'{$footer_credit}';
}
body .template-part-header .customize-partial-edit-shortcut-emulsion_header_gradient:hover:after{
    content:'{$header_background}';
    top:1.5rem;
}
body .header-layer .customize-partial-edit-shortcut-emulsion_header_gradient:hover:after{
    content:'{$header_background}';
}

body .posted-on .customize-partial-edit-shortcut-emulsion_post_display_date_format:hover:after,
body .header-layer .customize-partial-edit-shortcut-emulsion_post_display_date_format:hover:after{
    content:'{$post_metadata}';
}
body .social-navigation .customize-partial-edit-shortcut[class*="customize-partial-edit-shortcut-nav_menu_instance"]:hover:after,
body .primary-menu-wrapper .customize-partial-edit-shortcut[class*="customize-partial-edit-shortcut-nav_menu_instance"]:hover:after{
    content:'{$menu_settings}';
    left:24px;
    top:9px;
}
body .header-layer-nav-menu .customize-partial-edit-shortcut[class*="customize-partial-edit-shortcut-nav_menu_instance"]:hover:after{
   content:'{$menu_settings}';
    top:-3px;
}
body .footer-widget-area  [class*="customize-partial-edit-shortcut-widget"]:hover:after,
body .sidebar-widget-area [class*="customize-partial-edit-shortcut-widget"]:hover:after{
    content:'{$widget_settings}';
    top:48px;
}
body .entry-content .customize-partial-edit-shortcut-emulsion_block_gallery_section_height:hover:after{
    content:'{$gallery_block_settings}';
    left:24px;
}
body .relate-content-wrapper .customize-partial-edit-shortcut-emulsion_relate_posts_bg:hover:after{
	content:'{$relate_posts_background}';
    left:24px;
    top:48px;
    text-align:right;

}
body .header-image-active .customize-partial-edit-shortcut-emulsion_header_media_max_height:hover:after{
	content:'{$header_media_height}';
}
body.home .header-layer .customize-partial-edit-shortcut-emulsion_header_media_max_height:hover:after{
	content:'{$header_media_height}';
}
body.home .drawer .customize-partial-edit-shortcut-emulsion_search_drawer:hover:after{
    content:'{$search_drawer}';
    left:24px;
}
body.home .customize-partial-edit-shortcut-custom_header:hover:after{
    content:'{$header_media}';
    left:24px;
}
body.home .customize-partial-edit-shortcut-emulsion_layout_homepage:hover:after{
    content:'{$layout_home_page}';
    left:24px;
}
body .content-excerpt .customize-partial-edit-shortcut-emulsion_excerpt_length:hover:after{
    content:'{$excerpt_length}';
}
body.category .customize-partial-edit-shortcut-emulsion_layout_category_archives:hover:after{
    content:'{$layout_category}';
    left:24px;
}
body .sectionized-wp-block-media-text .customize-partial-edit-shortcut-emulsion_block_media_text_section_height:hover:after{
    content:'{$block_media_text}';
}
body.on-scroll .menu-placeholder .customize-partial-edit-shortcut-emulsion_table_of_contents:hover:after{
    content:'{$table_of_contents}';
    top:9px;
    left:-220px;
}
body .sidebar-widget-area .customize-partial-edit-shortcut-emulsion_sticky_sidebar:hover:after{
    content:'{$sticky_sidebar}';
    top:9px;
    left:120px;
}
body .sidebar-widget-area .customize-partial-edit-shortcut-emulsion_sidebar_position:hover:after{
    content:'{$layout_sidebar}';
    top:9px;
}
body .relate-content-wrapper .customize-partial-edit-shortcut-emulsion_relate_posts:hover:after{
    content:'{$display_relate_post}';
    text-align:center;
    top:9px;
    left:24px;
}
body.blog .customize-partial-edit-shortcut-emulsion_layout_posts_page:hover:after{
    content:'{$layout_posts_page}';
    left:24px;
}
body.date .customize-partial-edit-shortcut-emulsion_layout_date_archives:hover:after{
    content:'{$layout_date_archive}';
    left:24px;
}
body.author .customize-partial-edit-shortcut-emulsion_layout_author_archives:hover:after{
    content:'{$layout_author}';
    left:24px;
}
body.tag .customize-partial-edit-shortcut-emulsion_layout_tag_archives:hover:after{
    content:'{$layout_tag_archive}';
    left:24px;
}
body.home .customize-partial-edit-shortcut-emulsion_excerpt_length_stream:hover:after,
body.archive .customize-partial-edit-shortcut-emulsion_excerpt_length_stream:hover:after{
    content:'{$excerpt_length}';
    top:6px;
}

CSS;
	return $css;
}

/**
 * Customizer left columns CSS
 */
function emulsion_customizer_style() {

	$text_section_emulsion_section_layout_homepage			 = esc_html__( 'Each Pages', 'emulsion-addons' );
	$text_section_emulsion_section_layout_header			 = esc_html__( 'General', 'emulsion-addons' );
	$text_section_emulsion_section_block_editor_alignwide	 = esc_html( 'Block Editor', 'emulsion-addons' );

	$css = '';
	if ( 'custom' !== get_theme_mod( 'emulsion_header_layout' ) ) {

		$css .= '#accordion-section-header_image .accordion-section-title{pointer-events:none;color:silver;cursor:default;}';
		$css .= '#customize-controls #accordion-section-header_image:hover .accordion-section-title{pointer-events:none;color:silver;border-color:silver;cursor:default;}';
	}

	$css .= <<<CUSTOMIZE_CSS
			/* todo */
#customize-theme-controls input[type="number"]{
			padding:0 0 0 8px;
}
#customize-theme-controls .customize-inside-control-row{
			display:block;
			line-height:1.5;
}
#customize-control-emulsion_title_fonts_weight,
#customize-control-emulsion_title_fonts_family{
			line-height:1.5;

}
#_customize-input-emulsion_title_fonts_family-radio-serif + label{
	font-size:2rem;
	font-family:serif;
}
#_customize-input-emulsion_title_fonts_family-radio-sans-serif + label{
	font-size:2rem;
			font-family:sans-serif;
			line-height:1.5;
}
#accordion-section-emulsion_section_post:before{
	content:'{$text_section_emulsion_section_layout_header}';
	display:block;
	padding:.75rem;
	background:#fff;
	color:#333;
	font-weight:700;
	border-left:4px solid #0073aa;
	border-bottom:1px solid #ddd;
	margin-top:15px;
}
#accordion-section-emulsion_section_block_editor_alignwide:before{
	content:'{$text_section_emulsion_section_block_editor_alignwide}';
	display:block;
	padding:.75rem;
	background:#fff;
	color:#333;
	font-weight:700;
	border-left:4px solid #0073aa;
	border-bottom:1px solid #ddd;
	margin-top:15px;
}
#accordion-section-emulsion_section_layout_header:before{
	content:'{$text_section_emulsion_section_layout_header}';
	display:block;
	padding:.75rem;
	background:#fff;
	color:#333;
	font-weight:700;
	border-left:4px solid #0073aa;
	border-bottom:1px solid #ddd;
	margin-top:15px;
}

#accordion-section-emulsion_section_layout_homepage:before{
	content:'{$text_section_emulsion_section_layout_homepage}';
	display:block;
	padding:.75rem;
	background:#fff;
	color:#333;
	font-weight:700;
	border-left:4px solid #0073aa;
	border-bottom:1px solid #ddd;
	margin-top:15px;
}
.customize-section-title-menu_locations-description,
.customize-section-description{
	line-height:1.5;
}
.emulsion-notice{
	float:none;
	clear:both;
	border-left:3px solid #f1c40f;
}

.notice.emulsion-notice{
	padding-top:0;
	padding-bottom:0;
	overflow:hidden;
}
.emulsion-customize-control-content{
	margin-bottom:.75rem;
}
.emulsion-customize-control-content .name{
	display:block;
	margin-bottom:1rem;
}
#customize-theme-controls{
	font-size:14px;
}
#customize-theme-controls .emulsion-notice .customize-control-title{

}
#customize-theme-controls .customize-control-title{
	font-size: 14px;
	font-weight:700;
	margin-top:.75rem;
	margin-bottom:.75rem;
}
#customize-theme-controls label{
	vertical-align:middle;
}
#customize-theme-controls input{
	margin-left:auto;
	margin-right:auto;
}
#customize-theme-controls .wp-picker-container,
#customize-theme-controls input[type="number"]{
	margin-left:24px;
}
#customize-theme-controls input[type="number"]{
	margin-left:24px;
	margin-right128px;
	width:calc( 100% - 152px );
}
#_customize-input-emulsion_common_font_size{


}
#_customize-input-emulsion_widget_meta_font_family-radio-serif + label,
#_customize-input-emulsion_heading_font_family-radio-serif + label,
#_customize-input-emulsion_common_font_family-radio-serif + label{
	font-family:serif;
	font-size: 14px;
}
#_customize-input-emulsion_widget_meta_font_family-radio-sans-serif + label,
#_customize-input-emulsion_heading_font_family-radio-sans-serif + label,
#_customize-input-emulsion_common_font_family-radio-sans-serif + label{
	font-family:sans-serif;
    font-size: 14px;
}
#_customize-input-emulsion_heading_font_weight-radio-Thin + label{
    font-size: 14px;
	font-weight:thin;
}
#_customize-input-emulsion_heading_font_weight-radio-Normal + label{
	font-size: 14px;
	font-weight:normal;
}
#_customize-input-emulsion_heading_font_weight-radio-Bold + label{
    font-size: 14px;
	font-weight:bold;
}
#_customize-input-emulsion_heading_font_scale-radio-2x + label{
    font-size: 14px;
	font-weight:normal;
}
#_customize-input-emulsion_heading_font_scale-radio-3x + label{
	font-size: 14px;
	font-weight:normal;
}
#_customize-input-emulsion_widget_meta_font_transform-radio-none + label,
#_customize-input-emulsion_heading_font_transform-radio-none + label{
	font-size: 14px;
}
#_customize-input-emulsion_widget_meta_font_transform-radio-uppercase + label,
#_customize-input-emulsion_heading_font_transform-radio-uppercase + label{
	font-size: 14px;
	text-transform:uppercase;
}
#_customize-input-emulsion_widget_meta_font_transform-radio-lowercase + label,
#_customize-input-emulsion_heading_font_transform-radio-lowercase + label{
	font-size: 14px;
	text-transform:lowercase;
}
#_customize-input-emulsion_widget_meta_font_transform-radio-capitalize + label,
#_customize-input-emulsion_heading_font_transform-radio-capitalize + label{
	font-size: 14px;
	text-transform:capitalize;
}
[checked="checked"] + label{
	font-weight:700;
}
#customize-controls .panel-meta > .customize-control-notifications-container{
		margin-top:1rem;
	margin-bottom:1rem;
}
.customize-control-notifications-container .notification-message{
	color: #555d66;
    background: #fff;
}
.emulsion_fadeout_message_section_layout_main,
.emulsion_fadeout_message_category_colors,
.emulsion_fadeout_message_section_layout_homepage,
.emulsion_fadeout_message_section_layout_category_archives,
.emulsion_fadeout_message_section_layout_author_archives,
.emulsion_fadeout_message_section_layout_date_archives,
.emulsion_fadeout_message_section_layout_tag_archives,
.emulsion_fadeout_message_section_advanced_excerpt{
	font-size: 13px;
	display:block;
	margin-bottom:1rem;
}
#customize-theme-controls p.customize-section-title-menu_locations-description,
.customize-section-description,
.customize-control-description{
	border:1px solid #ccc;
	padding:.5rem;
	background:#fff;
	color:#333;
	position:relative;
	padding-top:28px;
}
.customize-section-description:before,
.customize-control-description:before{
	content:'Description';
	font-size:11px;
	display:block;
	margin-bottom:11px;
	background:rgb(238,238,238);
	color:#333;
	padding:3px;
	position:absolute;
	top:-1px;
	left:-1px;
	border-right:1px solid #ccc;
	border-bottom:1px solid #ccc;

}
#customize-control-emulsion_widget_meta_font_size:after,
#customize-control-emulsion_common_font_size:after,
#customize-control-emulsion_content_margin_top:after,
#customize-control-emulsion_content_width:after,
#customize-control-emulsion_main_width:after,
#customize-control-emulsion_sidebar_width:after{
	content:'px';
}
#customize-control-emulsion_block_media_text_section_height:after,
#customize-control-emulsion_block_columns_section_height:after,
#customize-control-emulsion_block_gallery_section_height:after{
	content:'vh';
}
.emulsion-control-desc-notice{
	font-size: 13px;
	display:block;
	border:1px solid #ccc;
	padding:1rem;
	background:#fff;
	color:#333;
	margin-top:1rem;
	border-left:3px solid #f1c40f;
}
.emulsion_fadeout_message{
	border:1px solid #ccc;
	padding:.5rem;
	background:#fff;
	color:#333;
	display:block;
}
.customize-section-title .customize-section-back{
	position:absolute;
}
.customize-section-title .customize-section-back + h3{
	position:relative;
	left:48px;
}
#customize-control-emulsion_favorite_color_palette{
	visibility:hidden;
}
.emulsion-spinner {
     width: 1em;
     height: 1em;
	 display:inline-block;
     border: 3px solid rgba(200,200,200,0.4);
     border-top-color: rgba(200,200,200,0.9);
     border-radius: 50%;
     animation: emulsionSpinner 1.2s linear 0s infinite;
	vertical-align:middle;
	margin-right:1em;
}
@keyframes emulsionSpinner {
     0% {
		transform: rotate(0deg);
	}
	100% {
		 transform: rotate(360deg);
	}
}


CUSTOMIZE_CSS;
	if ( is_customize_preview() ) {
		wp_add_inline_style( 'customize-controls', $css );
	}
}

/**
 * hook
 */
add_action( 'customize_preview_init', 'emulsion_customize_preview_js' );
add_action( 'customize_controls_enqueue_scripts', 'emulsion_customizer_style' );

add_action( 'customize_register', 'emulsion_extend_customize_register', 11 );
add_action( 'customize_render_control_emulsion_layout_posts_page', 'emulsion_message_layout_posts_page' );
add_action( 'customize_render_control_emulsion_sidebar_position', 'emulsion_message_sidebar_position' );
add_action( 'customize_render_control_emulsion_footer_columns', 'emulsion_message_footer_columns' );
add_action( 'customize_render_control_emulsion_post_display_date', 'emulsion_message_post_display_date' );
add_action( 'customize_render_control_emulsion_header_layout', 'emulsion_message_header_layout' );
add_action( 'customize_render_control_emulsion_layout_homepage', 'emulsion_message_layout_homepage' );

/**
 * Messages
 */
function emulsion_message_layout_posts_page() {

	$is_show_on_front	 = sanitize_text_field( get_option( 'show_on_front' ) );
	$page_for_posts_id	 = sanitize_option( 'page_for_posts', get_option( 'page_for_posts' ) );
	$customizer_url		 = '';

	if ( $page_for_posts_id && 'page' == $is_show_on_front ) {

		$customizer_url = 'javascript:var url = wp.customize.settings.url.home + \'?page_id=' . absint( $page_for_posts_id ) . '\'; wp.customize.previewer.previewUrl.set( url );';


		printf( '<li id="%4$s" class="%5$s" >
				<label>
					<span class="customize-control-title">%1$s</span>
					<div class="emulsion-customize-control-content">
						<a href="%2$s" class="tooltip">%3$s</a>
					</div>
				</label>
			</li>', '<span class="dashicons dashicons-paperclip" title="change preview"></span>', // Title
				esc_attr( $customizer_url ), // link
				esc_html__( 'Move to posts page', 'emulsion-addons' ), //link label
				esc_attr( __FUNCTION__ ), esc_attr( 'notice emulsion-info' )
		);
	} else {

		$customizer_url = 'javascript:wp.customize.section( \'static_front_page\' ).focus()';

		printf( '<li id="%4$s" class="%5$s" >
				<label>
					<span class="customize-control-title">%1$s</span>
					<div class="emulsion-customize-control-content">
						<a href="%2$s" class="tooltip">%3$s</a>
					</div>
				</label>
			</li>', esc_html__( 'Have you finished setting up the posts page setting ? The layout settings are required before this setting.', 'emulsion-addons' ), // Title
				esc_attr( $customizer_url ), // link
				esc_html__( 'Setting: Posts page', 'emulsion-addons' ), //link label
				esc_attr( __FUNCTION__ ), esc_attr( 'notice emulsion-notice' )
		);
	}
}


function emulsion_message_sidebar_position() {

	if ( 'fse' == emulsion_get_theme_operation_mode() ) {
		return '';
	}

	$page_sidebar				 = is_active_sidebar( 'sidebar-3' ) && emulsion_get_supports( 'sidebar_page' ) ? true : false;
	$post_sidebar				 = is_active_sidebar( 'sidebar-1' ) && emulsion_get_supports( 'sidebar' ) ? true : false;
	$post_id					 = emulsion_get_customize_post_id( 'latest-post' );
	$each_post_sidebar_setting	 = get_post_meta( $post_id, 'emulsion_post_sidebar', true );


	if ( ! $page_sidebar || ! $post_sidebar ) {
		$widgets					 = get_option( 'sidebars_widgets', array() );
		$post_sidebar_widget		 = ! empty( $widgets['sidebar-1']) ? count( $widgets['sidebar-1'] ):1;
		$page_sidebar_widget		 = ! empty( $widgets['sidebar-3']) ? count( $widgets['sidebar-3'] ):1;

		$customizer_url = 'javascript:wp.customize.panel( \'widgets\' ).focus()';

		printf( '<li id="%4$s" class="%5$s" >
				<label>
					<span class="customize-control-title">%1$s</span>
					<div class="emulsion-customize-control-content">
						<a href="%2$s" class="tooltip">%3$s</a>
					</div>
				</label>
			</li>',
				esc_html__( 'Have you finished setting up your sidebar ?', 'emulsion-addons' ) .
				'<p style="font-weight:normal">' .
				sprintf( /* translators: 1: post sidebar widget count 2: page sidebar count */
						esc_html__( 'Maybe post sidebar: %1$d. page sidebar: %2$d. ', 'emulsion-addons' ), absint( $post_sidebar_widget ), absint( $page_sidebar_widget ) ) .
				'</p>',
				esc_attr( $customizer_url ),
				esc_html__( 'Go Setting: Sidebar Widgets', 'emulsion-addons' ),
				esc_attr( __FUNCTION__ ),
				esc_attr( 'notice emulsion-notice' )
		);
	}
}

function emulsion_message_footer_columns() {

	if ( 'fse' == emulsion_get_theme_operation_mode() ) {
		return '';
	}
	$footer_widget_page	 = is_active_sidebar( 'sidebar-4' ) && emulsion_get_supports( 'footer_page' ) ? true : false;
	$footer_widget		 = is_active_sidebar( 'sidebar-2' ) && emulsion_get_supports( 'footer' ) ? true : false;
	$page				 = get_pages( array( 'number' => '1', 'sort_column' => 'post_date' ) );
	if( empty( $page ) ) {
		return;
	}
	$page_id			 = absint( $page[0]->ID );
	$class				 = 'notice emulsion-notice';
	$widgets			 = get_option( 'sidebars_widgets', array() );
	$post_footer_widget	 = ! empty( $widgets['sidebar-2']) ? count( $widgets['sidebar-2'] ): 1;
	$page_footer_widget	 = ! empty( $widgets['sidebar-4']) ? count( $widgets['sidebar-4'] ): 1;

	if ( ! $footer_widget || ! $footer_widget_page ) {

		$customizer_url = 'javascript:wp.customize.panel( \'widgets\' ).focus()';

		printf( '<li id="%4$s" class="%5$s" >
				<label>
					<span class="customize-control-title">%1$s</span>
					<div class="emulsion-customize-control-content">
						<a href="%2$s" class="tooltip">%3$s</a>
					</div>
				</label>
			</li>', esc_html__( 'Have you finished setting up your the footer widgets ?', 'emulsion-addons' ) .
				'<p style="font-weight:normal">' .
				sprintf( /* translators: 1: post sidebar widget count 2: page sidebar count */
						esc_html__( 'Maybe post footer: %1$d. page footer: %2$d. ', 'emulsion-addons' ), absint( $post_footer_widget ), absint( $page_footer_widget ) ) .
				'</p>', esc_attr( $customizer_url ), esc_html__( 'Go Setting: Footer Widgets', 'emulsion-addons' ), esc_attr( __FUNCTION__ ), esc_attr( $class )
		);
	}
}

function emulsion_message_post_display_date() {

	$post_id		 = emulsion_get_customize_post_id( 'latest-post' );
	if( empty( $page ) ) {
		return;
	}

	$customizer_url	 = 'javascript:var url = wp.customize.settings.url.home + \'?p=' . absint( $post_id ) . '\'; wp.customize.previewer.previewUrl.set( url );';

	printf( '<li id="%4$s" class="%5$s" >
				<label>
					<span class="customize-control-title">%1$s</span>
					<div class="emulsion-customize-control-content">
						<a href="%2$s" class="tooltip">%3$s</a>
					</div>
				</label>
			</li>', '<span class="dashicons dashicons-paperclip" title="change preview"></span>', esc_attr( $customizer_url ), esc_html__( 'Move to last post', 'emulsion-addons' ), esc_attr( __FUNCTION__ ), esc_attr( 'notice emulsion-info' )
	);
}

function emulsion_message_header_layout() {
	$post_id					 = emulsion_get_customize_post_id( 'latest-post' );
	if( empty( $page ) ) {
		return;
	}
	$customizer_url_single_post	 = 'javascript:var url = wp.customize.settings.url.home + \'?p=' . absint( $post_id ) . '\'; wp.customize.previewer.previewUrl.set( url );';
	$default_category			 = get_option( 'default_category' );
	$customizer_url_category	 = 'javascript:var url_cat = wp.customize.settings.url.home + \'?cat=' . absint( $default_category ) . '\'; wp.customize.previewer.previewUrl.set( url_cat );';


	printf( '<li id="%4$s" class="%5$s" >
				<label>
					<span class="customize-control-title">%1$s</span>
					<div class="emulsion-customize-control-content">
						<p><a href="%2$s" class="tooltip">%3$s</a></p>
						<p><a href="%6$s" class="tooltip">%7$s</a></p>
					</div>
				</label>
			</li>', '<span class="dashicons dashicons-paperclip" title="change preview"></span>', esc_attr( $customizer_url_single_post ), esc_html__( 'Move to last post', 'emulsion-addons' ), esc_attr( __FUNCTION__ ), esc_attr( 'notice emulsion-info' ), esc_attr( $customizer_url_category ), esc_html__( 'Move to Category Archive', 'emulsion-addons' )
	);
}

function emulsion_message_layout_homepage() {

	$is_show_on_front	 = sanitize_text_field( get_option( 'show_on_front' ) );
	$page_on_front_id	 = sanitize_option( 'page_on_front', get_option( 'page_on_front' ) );
	$page_for_posts_id	 = sanitize_option( 'page_for_posts', get_option( 'page_for_posts' ) );


	if ( ! empty( $page_on_front_id ) && 'page' == $is_show_on_front ) {

		printf( '<li id="%3$s" class="%4$s" >
				<label>
					<span class="customize-control-title">%1$s</span>
					<div class="emulsion-customize-control-content">
						<p>%2$s</p>
					</div>
				</label>
			</li>', esc_html__( 'Notice', 'emulsion-addons' ), esc_html( 'Static page already set in home page. This feature is not available.', 'emulsion-addons' ), esc_attr( __FUNCTION__ ), esc_attr( 'notice emulsion-notice' )
		);
	}
}

if ( ! function_exists( 'emulsion_extend_customize_register' ) ) {

	/**
	 * register customizer args from conf.php
	 */
	function emulsion_extend_customize_register( $wp_customize ) {

		global $emulsion_theme_customize_sections, $emulsion_customize_args, $emulsion_theme_customize_panels;

		/**
		 * Create Panel
		 */
		foreach ( $emulsion_theme_customize_panels as $emulsion_panel_key => $emulsion_panel_val ) {

		//	if ( ! empty( $emulsion_panel_key ) && ! empty( $emulsion_panel_val ) ) {

				$wp_customize->add_panel( $emulsion_panel_key, $emulsion_panel_val );
		//	}
		}

		/**
		 * Create Section
		 */
		foreach ( $emulsion_theme_customize_sections as $emulsion_section_key => $emulsion_section_val ) {

		//	if ( ! empty( $emulsion_section_key ) && ! empty( $emulsion_section_val ) ) {

				$wp_customize->add_section( $emulsion_section_key, $emulsion_section_val );
		//	}
		}

		/**
		 * Create Default Controls
		 */
		$emulsion_customize_args = emulsion_argument_completion( $emulsion_customize_args );

		foreach ( $emulsion_customize_args as $key => $emulsion_mod_val ) {

		//	if ( ! empty( $key ) && is_string( $key ) ) {

				$id = $key;

				$wp_customize->add_setting( $id, array(
					'default'			 => $emulsion_customize_args[$key]['default'],
					'type'				 => $emulsion_customize_args[$key]['data_type'],
					'capability'		 => $emulsion_customize_args[$key]['capability'],
					'sanitize_callback'	 => $emulsion_customize_args[$key]['sanitize_callback'],
					'validate_callback'	 => $emulsion_customize_args[$key]['validate_callback'],
					'transport'			 => $emulsion_customize_args[$key]['transport'],
				) );

				$id = $key;

				$wp_customize->add_control( $id, array(
					'label'				 => $emulsion_customize_args[$key]['label'],
					'section'			 => $emulsion_customize_args[$key]['section'],
					'settings'			 => $id,
					'type'				 => $emulsion_customize_args[$key]['type'],
					'choices'			 => $emulsion_customize_args[$key]['choices'],
					'priority'			 => $emulsion_customize_args[$key]['priority'],
					'input_attrs'		 => $emulsion_customize_args[$key]['input_attrs'],
					'description'		 => $emulsion_customize_args[$key]['description'],
					'json'				 => $emulsion_customize_args[$key]['json'],
					'active_callback'	 => $emulsion_customize_args[$key]['active_callback'],
					'sanitize_callback'	 => $emulsion_customize_args[$key]['sanitize_callback'],
					'validate'			 => $emulsion_customize_args[$key]['validate'],
				) );
			}
		//}

		/**
		 * Create Custom Controls
		 */
		foreach ( $emulsion_customize_args as $key => $emulsion_mod_val ) {

			if ( 'WP_Customize_Color_Control' == emulsion_get_var( $key, 'extend_customize_control' ) ) {

				$key = $key;

				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
					'label'				 => emulsion_get_var( $key, 'label' ),
					'section'			 => emulsion_get_var( $key, 'section' ),
					'settings'			 => $key,
					'active_callback'	 => emulsion_get_var( $key, 'active_callback' ),
					'priority'			 => emulsion_get_var( $key, 'priority' ),
					'description'		 => emulsion_get_var( $key, 'description' ),
					'sanitize_callback'	 => emulsion_get_var( $key, 'sanitize_callback' ),
					'validate'			 => emulsion_get_var( $key, 'validate' ),
				) ) );
				$wp_customize->get_setting( $key )->transport = 'postMessage';
			}
		}
	}
}

if ( ! function_exists( 'emulsion_argument_completion' ) ) {

	function emulsion_argument_completion( $args ) {

		$defaults = array(
			'data_type'			 => 'theme_mod',
			'capability'		 => 'edit_theme_options',
			'theme_supports'	 => '',
			'default'			 => '',
			'transport'			 => 'refresh',
			'sanitize_callback'	 => '',
			'validate_callback'	 => '',
			'dirty'				 => false,
			'setting'			 => 'default',
			'priority'			 => 10,
			'section'			 => '',
			'label'				 => '',
			'description'		 => '',
			'choices'			 => array(),
			'input_attrs'		 => array(),
			'json'				 => array(),
			'type'				 => 'text',
			'active_callback'	 => '',
		);

		$results = array();

		foreach ( $args as $key => $val ) {

			$result_val = wp_parse_args( $val, $defaults );

			$results[$key] = apply_filters( 'emulsion_default_settings_' . $key, $result_val );
		}
		return $results;
	}

}
