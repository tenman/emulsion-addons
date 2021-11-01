<?php
/**
 * Theme default settings
 *
 * Background color
 * Fonts  General
 * Fonts Heading
 * Fonts Widget and metadata
 * Layout
 * Footer
 * Advanced
 * Block editor
 * Post
 *
 * Panel
 * Section
 * Active Callback
 */

/**
 * Note:content width
 * required smaller than emulsion_main_width value (default 1280)
 * unit: px
 */
$content_width			 = ! isset( $content_width ) ? 720 : $content_width;
$emulsion_setting_type	 = 'theme_mod';
$emulsion_customize_cap	 = 'edit_theme_options';


$emulsion_customize_args = array(

	/**
	 * Background color
	 */
	"emulsion_header_gradient"				 => array(
		'section'					 => 'colors',
		'priority'					 => 7,
		'default'					 => emulsion_addons_default_values( "emulsion_header_gradient", "disable" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Gradient header', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Display gradation with Background Color and Sub Background Color.', 'emulsion-addons' ),
		'validate'					 => 'emulsion_header_gradient_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'enable'	 => esc_html__( 'Enable', 'emulsion-addons' ),
			'disable'	 => esc_html__( 'Disable', 'emulsion-addons' ),
		),
	),
	"emulsion_header_background_color"		 => array(
		'section'					 => 'colors',
		'default'					 => emulsion_addons_default_values( "emulsion_header_background_color", '#eeeeee' ),
		'priority'					 => 8,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Header Background Color', 'emulsion-addons' ),
		'description'				 => '',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'sanitize_hex_color',
		'validate'					 => 'emulsion_header_background_color_validate',
		'extend_customize_control'	 => 'WP_Customize_Color_Control',
		'extend_customize_setting'	 => '',
	),
	"emulsion_header_sub_background_color"	 => array(
		'section'					 => 'colors',
		'default'					 => emulsion_addons_default_values( "emulsion_header_sub_background_color", '#eeeeee' ),
		'priority'					 => 8,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Header Sub Background Color', 'emulsion-addons' ),
		'description'				 => '',
		'sanitize_callback'			 => 'sanitize_hex_color',
		'validate'					 => 'emulsion_header_sub_background_color_validate',
		'extend_customize_control'	 => 'WP_Customize_Color_Control',
		'extend_customize_setting'	 => '',
	),

	"emulsion_category_colors"					 => array(
		'section'					 => 'colors',
		'priority'					 => 9,
		'default'					 => emulsion_addons_default_values( "emulsion_category_colors", "disable" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Category Color', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Add category colors to header', 'emulsion-addons' ). '<br />'.
										emulsion_control_description( 'emulsion_category_colors' ),
		'validate'					 => 'emulsion_category_colors_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'enable'	 => esc_html__( 'Enable', 'emulsion-addons' ),
			'disable'	 => esc_html__( 'Disable', 'emulsion-addons' ),
		),
	),
	"emulsion_sidebar_background"				 => array(
		'section'					 => 'colors',
		'default'					 => emulsion_addons_default_values( "emulsion_sidebar_background", emulsion_sidebar_background() ),//
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Sidebar Background Color', 'emulsion-addons' ),
		'description'				 => '',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'sanitize_hex_color',
		'validate'					 => 'emulsion_sidebar_background_validate',
		'extend_customize_control'	 => 'WP_Customize_Color_Control',
		'extend_customize_setting'	 => '',
	),
	"emulsion_primary_menu_background"			 => array(
		'section'					 => 'colors',
		'default'					 => emulsion_addons_default_values( "emulsion_primary_menu_background", emulsion_sidebar_background() ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Primary Menu Background Color', 'emulsion-addons' ),
		'description'				 => emulsion_control_description('emulsion_primary_menu_background'),
		'active_callback'			 => '',
		'sanitize_callback'			 => 'sanitize_hex_color',
		'validate'					 => 'emulsion_primary_menu_background_validate',
		'extend_customize_control'	 => 'WP_Customize_Color_Control',
		'extend_customize_setting'	 => '',
	),
	"emulsion_relate_posts_bg"					 => array(
		'section'					 => 'colors',
		'default'					 => emulsion_addons_default_values( "emulsion_relate_posts_bg", '#eeeeee' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Relate Posts background Color', 'emulsion-addons' ),
		'description'				 => emulsion_control_description( 'emulsion_relate_posts_bg' ),
		'active_callback'			 => '',
		'sanitize_callback'			 => 'sanitize_hex_color',
		'validate'					 => 'emulsion_relate_posts_bg_validate',
		'extend_customize_control'	 => 'WP_Customize_Color_Control',
		'extend_customize_setting'	 => '',
	),
	"emulsion_comments_bg"						 => array(
		'section'					 => 'colors',
		'default'					 => emulsion_addons_default_values( "emulsion_comments_bg", '#eeeeee' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Comments background Color', 'emulsion-addons' ),
		'description'				 => emulsion_control_description( 'emulsion_comments_bg' ),
		'active_callback'			 => '',
		'sanitize_callback'			 => 'sanitize_hex_color',
		'validate'					 => 'emulsion_comments_bg_validate',
		'extend_customize_control'	 => 'WP_Customize_Color_Control',
		'extend_customize_setting'	 => '',
	),
	"emulsion_bg_image_text"		 => array(
		'section'					 => 'background_image',
		'default'					 => emulsion_addons_default_values( "emulsion_bg_image_text", 'current' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Text Color', 'emulsion-addons' ),
		'description'				 => '',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'validate'					 => 'emulsion_bg_image_text_validate',
		'extend_customize_control'	 => '',
		'extend_customize_setting'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'current'			 => esc_html__( 'Current Setting Color', 'emulsion-addons' ),
			'white'	 => esc_html__( 'White', 'emulsion-addons' ),
		),
	),
	"emulsion_bg_image_blend_color"		 => array(
		'section'					 => 'background_image',
		'default'					 => emulsion_addons_default_values( "emulsion_bg_image_blend_color", '#000000' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Color to blend with image', 'emulsion-addons' ),
		'description'				 => '',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'sanitize_hex_color',
		'validate'					 => 'emulsion_bg_image_blend_color_validate',
		'extend_customize_control'	 => 'WP_Customize_Color_Control',
		'extend_customize_setting'	 => '',

	),
	"emulsion_bg_image_blend_color_amount"	 => array(
		'section'					 => 'background_image',
		'default'					 => emulsion_addons_default_values( "emulsion_bg_image_blend_color_amount", 0 ),
		'priority'					 => 11,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Blend Color Amount', 'emulsion-addons' ),
		'description'				 => '',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'absint',
		'validate'					 => 'emulsion_bg_image_blend_color_amount_validate',
		'extend_customize_control'	 => '',
		'extend_customize_setting'	 => '',
		'type'						 => 'range',
		'input_attrs'				 => array(
			'min'	 => 0,
			'max'	 => 100,
			'step'	 => 1,
		),
	),
	"emulsion_background_css_pattern"			 => array(
		'section'					 => 'colors',
		'priority'					 => 10,
		'default'					 =>  emulsion_addons_default_values( "emulsion_background_css_pattern", "none" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Background Pattern', 'emulsion-addons' ),
		'description'				 => esc_html__( 'The background color must be set in advance', 'emulsion-addons' ).'<br />'.
										esc_html__( 'This setting does not support preview.Please open a blog and check it.', 'emulsion-addons' ),
		'validate'					 => 'emulsion_background_css_pattern_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'none'			 => esc_html__( 'None', 'emulsion-addons' ),
			'carbon-fiber'	 => esc_html__( 'Carbon Fiber pattern', 'emulsion-addons' ),
			'seigaiha'		 => esc_html__( 'Seigaiha pattern', 'emulsion-addons' ),
			'cicada'		 => esc_html__( 'Cicada Principle', 'emulsion-addons' ),
			'lattice'		 => esc_html__( 'Lattice pattern', 'emulsion-addons' ),
			'hexagonal'		 => esc_html__( 'Hexagon pattern', 'emulsion-addons' ),
		),
	),

	"emulsion_general_link_color"				 => array(
		'section'					 => 'colors',
		'priority'					 => 10,
		'default'					 =>  emulsion_addons_default_values( "emulsion_general_link_color", emulsion_link_colors() ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Link Color', 'emulsion-addons' ),
		'description'				 => esc_html__( 'set link color', 'emulsion-addons' ),
		'validate'					 => 'emulsion_general_link_color_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'sanitize_hex_color',
		'extend_customize_control'	 => 'WP_Customize_Color_Control',
	),
	"emulsion_general_link_hover_color"		 => array(
		'section'					 => 'colors',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_general_link_hover_color", emulsion_hover_colors() ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Link Hover Color', 'emulsion-addons' ),
		'description'				 => esc_html__( 'set hover color', 'emulsion-addons' ),
		'validate'					 => 'emulsion_general_link_hover_color_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'sanitize_hex_color',
		'extend_customize_control'	 => 'WP_Customize_Color_Control',
	),
	"emulsion_general_text_color"				 => array(
		'section'					 => 'colors',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_general_text_color", emulsion_contrast_color() ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Text Color', 'emulsion-addons' ),
		'description'				 => esc_html__( 'set text color', 'emulsion-addons' ),
		'validate'					 => 'emulsion_general_text_color_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'sanitize_hex_color',
		'extend_customize_control'	 => 'WP_Customize_Color_Control',
	),
	/**
	 * Fonts  General
	 */
	"emulsion_common_font_size"				 => array(
		'section'					 => 'emulsion_section_fonts_general',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_common_font_size", 16 ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'				 => 'px',
		'label'						 => esc_html__( 'Base font size', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_common_font_size_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'absint',
		'extend_customize_control'	 => '',
		'type'						 => 'number',
		'input_attrs'				 => array(
			'min'	 => 13,
			'max'	 => 24,
			'step'	 => 1,
		),
	),
	"emulsion_common_font_family"				 => array(
		'section'					 => 'emulsion_section_fonts_general',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_common_font_family", "sans-serif" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Base font family', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_common_font_family_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'serif'		 => esc_html__( 'Serif', 'emulsion-addons' ),
			'sans-serif' => esc_html__( 'Sans Serif', 'emulsion-addons' ),
		),
	),
	"emulsion_common_google_font_url"			 => array(
		'section'					 => 'emulsion_section_fonts_general',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_common_google_font_url", "" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Google fonts', 'emulsion-addons' ),
		'description'				 => sprintf( '<a href="%1$s" target="blank" rel="nofollow noopener noreferrer">%2$s</a>', 'https://fonts.google.com/', esc_html__( 'Google fonts', 'emulsion-addons' ) ) .
		' ' . esc_html__( '( new tab )', 'emulsion-addons' ),
		'validate'					 => 'emulsion_common_google_font_url_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'esc_attr',
		'extend_customize_control'	 => '',
		'type'						 => 'url',
		'input_attrs'				 => array(
			/* translators: Here is an example of google font url. Please do not translate, please show original text */
			'placeholder' => esc_html__( 'https://fonts.googleapis.com/css?family=Roboto', 'emulsion-addons' ),
		),
	),
	/**
	 * Fonts Heading
	 */
	"emulsion_heading_font_family"				 => array(
		'section'					 => 'emulsion_section_fonts_heading',
		'priority'					 => 9,
		'default'					 => emulsion_addons_default_values( "emulsion_heading_font_family", "serif" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Font Family', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_title_fonts_family_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'serif'		 => esc_html__( 'Serif', 'emulsion-addons' ),
			'sans-serif' => esc_html__( 'Sans Serif', 'emulsion-addons' ),
		),
	),
	"emulsion_heading_font_weight"				 => array(
		'section'					 => 'emulsion_section_fonts_heading',
		'priority'					 => 9,
		'default'					 => emulsion_addons_default_values( "emulsion_heading_font_weight", '700' ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Font Weight', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_heading_font_weight_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'absint',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'100'	 => esc_html__( 'Thin', 'emulsion-addons' ),
			'400'	 => esc_html__( 'Normal', 'emulsion-addons' ),
			'700'	 => esc_html__( 'bold', 'emulsion-addons' ),
		),
	),
	"emulsion_heading_font_base"				 => array(
		'section'					 => 'emulsion_section_fonts_heading',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_heading_font_base", get_theme_mod( "emulsion_common_font_size", 16 ) ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => 'px',
		'label'						 => esc_html__( 'Base font size', 'emulsion-addons' ),
		'description'				 => esc_html__( 'heading base font size', 'emulsion-addons' ),
		'validate'					 => 'emulsion_heading_font_base_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'absint',
		'extend_customize_control'	 => '',
		'type'						 => 'number',
		'input_attrs'				 => array(
			'min'	 => 10,
			'max'	 => 48,
			'step'	 => 1,
		),
	),
	"emulsion_heading_font_scale"				 => array(
		'section'					 => 'emulsion_section_fonts_heading',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_heading_font_scale", 'xxx' ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Font Scale', 'emulsion-addons' ),
		'description'				 => esc_html__( 'h1 element font size, 3 times or 2 times heading base font size.', 'emulsion-addons' ),
		'validate'					 => 'emulsion_heading_font_scale_validate', //ch
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'xx'	 => esc_html__( '2x ', 'emulsion-addons' ),
			'xxx'	 => esc_html__( '3x bigger', 'emulsion-addons' ),
		),
	),
	"emulsion_heading_font_transform"			 => array(
		'section'					 => 'emulsion_section_fonts_heading',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_heading_font_transform", 'uppercase' ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Text transform', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_heading_font_transform_validate', //ch
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'none'		 => esc_html__( 'none', 'emulsion-addons' ),
			'uppercase'	 => esc_html__( 'uppercase', 'emulsion-addons' ),
			'lowercase'	 => esc_html__( 'lowercase', 'emulsion-addons' ),
			'capitalize' => esc_html__( 'capitalize', 'emulsion-addons' ),
		),
	),
	"emulsion_heading_google_font_url"			 => array(
		'section'					 => 'emulsion_section_fonts_heading',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_heading_google_font_url",  "" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Google fonts', 'emulsion-addons' ),
		'description'				 => sprintf( '<a href="%1$s" target="blank" rel="nofollow noopener noreferrer">%2$s</a>', 'https://fonts.google.com/', esc_html__( 'Google fonts', 'emulsion-addons' ) ) .
		' ' . esc_html__( '( new tab )', 'emulsion-addons' ),
		'validate'					 => 'emulsion_heading_google_font_url_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'esc_url',
		'extend_customize_control'	 => '',
		'type'						 => 'url',
		'input_attrs'				 => array(
			/* translators: Here is an example of google font url. Please do not translate, please show original text */
			'placeholder' => __( 'https://fonts.googleapis.com/css?family=Roboto', 'emulsion-addons' ),
		),
	),
	/**
	 * Fonts Widget and metadata
	 */
	"emulsion_widget_meta_font_size"			 => array(
		'section'					 => 'emulsion_section_fonts_widget_meta',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_widget_meta_font_size", 13 ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'			 => 'px',
		'label'						 => esc_html__( 'Font Size', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_widget_meta_font_size_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'absint',
		'extend_customize_control'	 => '',
		'type'						 => 'number',
		'input_attrs'				 => array(
			'min'	 => 10,
			'max'	 => 24,
			'step'	 => 1,
		),
	),
	"emulsion_widget_meta_font_family"			 => array(
		'section'					 => 'emulsion_section_fonts_widget_meta',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_widget_meta_font_family", "sans-serif" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Font Family', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_widget_meta_font_family_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'serif'		 => esc_html__( 'Serif', 'emulsion-addons' ),
			'sans-serif' => esc_html__( 'Sans Serif', 'emulsion-addons' ),
		),
	),
	"emulsion_widget_meta_font_transform"		 => array(
		'section'					 => 'emulsion_section_fonts_widget_meta',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_widget_meta_font_transform", 'none' ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Text Transform', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_widget_meta_font_transform_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'none'		 => esc_html__( 'none', 'emulsion-addons' ),
			'uppercase'	 => esc_html__( 'uppercase', 'emulsion-addons' ),
			'lowercase'	 => esc_html__( 'lowercase', 'emulsion-addons' ),
			'capitalize' => esc_html__( 'capitalize', 'emulsion-addons' ),
		),
	),
	"emulsion_widget_meta_google_font_url"		 => array(
		'section'					 => 'emulsion_section_fonts_widget_meta',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_widget_meta_google_font_url", "" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Google fonts', 'emulsion-addons' ),
		'description'				 => sprintf( '<a href="%1$s" target="blank" rel="nofollow noopener noreferrer">%2$s</a>', 'https://fonts.google.com/', esc_html__( 'Google fonts', 'emulsion-addons' ) ) .
		' ' . esc_html__( '( new tab )', 'emulsion-addons' ),
		'validate'					 => 'emulsion_widget_meta_google_font_url_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'esc_url',
		'extend_customize_control'	 => '',
		'type'						 => 'url',
		'input_attrs'				 => array(
			/* translators: Here is an example of google font url. Please do not translate, please show original text */
			'placeholder' => __( 'https://fonts.googleapis.com/css?family=Roboto', 'emulsion-addons' ),
		),
	),
	"emulsion_widget_meta_title"				 => array(
		'section'					 => 'emulsion_section_fonts_widget_meta',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_widget_meta_title", false ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Widget Title', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Widget title uses this font setting', 'emulsion-addons' ),
		'validate'					 => 'emulsion_widget_meta_title_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'rest_sanitize_boolean',
		'extend_customize_control'	 => '',
		'type'						 => 'checkbox',
	),
	/**
	 * Layout
	 */
	"emulsion_header_layout"					 => array(
		'section'					 => 'emulsion_section_layout_header',
		'default'					 => emulsion_addons_default_values( "emulsion_header_layout", "custom" ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Header Layout', 'emulsion-addons' ),
		'description'				 => sprintf('<span>%1$s</span><span class="notice emulsion-notice emulsion-control-desc-notice">%2$s</span>',
													esc_html__( 'You can select two header types or write your own header html.', 'emulsion-addons' ),
													esc_html__( 'If you use header media, please select custom.', 'emulsion-addons' )),
		'validate'					 => 'emulsion_header_layout_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'custom' => esc_html__( 'Custom', 'emulsion-addons' ),
			'simple' => esc_html__( 'Simple', 'emulsion-addons' ),
			'self'	 => esc_html__( 'Do it myself', 'emulsion-addons' ),
		),
	),
	"emulsion_header_html"						 => array(
		'section'					 => 'emulsion_section_layout_header',
		'default'					 => emulsion_addons_default_values( "emulsion_header_html", "" ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Header HTML', 'emulsion-addons' ),
		'description'				 => sprintf( '%1$s<br />%2$s', esc_html__( 'Please enter header HTML.', 'emulsion-addons' ), esc_html__( 'If it is blank, the header is not displayed.', 'emulsion-addons' )
		),
		'validate'					 => 'emulsion_header_html_validate',
		'active_callback'			 => 'emulsion_header_html_active_callback',
		'sanitize_callback'			 => 'wp_kses_post',
		'extend_customize_control'	 => '',
		'type'						 => 'textarea',
		'input_attrs'				 => array(
			/* translators: Here is an example of google font url. Please do not translate, please show original text */
			'placeholder' => __( '<div class="header-text">Site title<p class="site-description">Site description</p></div>', 'emulsion-addons' ),
		),
	),
	"emulsion_title_in_header"					 => array(
		'section'					 => 'emulsion_section_layout_header',
		'default'					 => emulsion_addons_default_values( "emulsion_title_in_header", "yes" ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Display title in header', 'emulsion-addons' ),
		'description'				 => '<p>'.esc_html__( 'You can choose whether to display the title on the header.', 'emulsion-addons' ).'</p>'.
		'<p class="notice emulsion-info">'.esc_html__( 'This setting can not confirm the change in preview. Please open a blog and check it.', 'emulsion-addons' ).'</p>',
		'validate'					 => 'emulsion_title_in_header_validate',
		'active_callback'			 => 'emulsion_title_in_header_active_callback',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'yes'	 => esc_html__( 'Yes', 'emulsion-addons' ),
			'no'	 => esc_html__( 'No', 'emulsion-addons' ),
		),
	),
	"emulsion_header_media_max_height"	 => array(
		'section'					 => 'header_image',
		'default'					 => emulsion_addons_default_values( "emulsion_header_media_max_height", 75 ),
		'priority'					 => 4,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => 'vh',
		'label'						 => esc_html__( 'Header media max height. percent of the browser window height', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_header_media_max_height_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'absint',
		'extend_customize_control'	 => '',
		'type' => 'number',
		'input_attrs' => array(
			'min' => 50,
			'max' => 120,
			'step' => 1,
		),
	),
	"emulsion_sidebar_position"				 => array(
		'section'					 => 'emulsion_section_layout_sidebar',
		'default'					 => emulsion_addons_default_values( "emulsion_sidebar_position", "right" ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Position', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_sidebar_position_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'left'	 => esc_html__( 'Left', 'emulsion-addons' ),
			'right'	 => esc_html__( 'Right', 'emulsion-addons' ),
		),
	),
	"emulsion_sidebar_width"					 => array(
		'section'					 => 'emulsion_section_layout_sidebar',
		'default'					 => emulsion_addons_default_values( "emulsion_sidebar_width", 400 ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => 'px',
		'label'						 => esc_html__( 'Width', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_sidebar_width_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'absint',
		'extend_customize_control'	 => '',
		'type'						 => 'number',
		'input_attrs'				 => array(
			'min'	 => 120,
			'max'	 => 480,
			'step'	 => 1,
		),
	),
	"emulsion_condition_display_posts_sidebar"	 => array(
		'section'					 => 'emulsion_section_layout_sidebar',
		'default'					 => emulsion_addons_default_values( "emulsion_condition_display_posts_sidebar", 'allways' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Posts sidebar display condition', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_condition_display_posts_sidebar_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'allways'		 => esc_html__( 'Always', 'emulsion-addons' ),
			'logged_in_user' => esc_html__( 'Only Loggedin Users', 'emulsion-addons' ),
		),
	),
	"emulsion_condition_display_page_sidebar"	 => array(
		'section'					 => 'emulsion_section_layout_sidebar',
		'default'					 => emulsion_addons_default_values( "emulsion_condition_display_page_sidebar", 'allways' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Page sidebar display condition', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_condition_display_page_sidebar_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'allways'		 => esc_html__( 'Always', 'emulsion-addons' ),
			'logged_in_user' => esc_html__( 'Only Loggedin Users', 'emulsion-addons' ),
		),
	),
	"emulsion_main_width"						 => array(
		'section'					 => 'emulsion_section_layout_main',
		'default'					 => emulsion_addons_default_values( "emulsion_main_width", 1280 ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => 'px',
		'label'						 => esc_html__( 'Main width', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_main_width_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'absint',
		'extend_customize_control'	 => '',
		'type'						 => 'number',
		'input_attrs'				 => array(
			'min'	 => 480,
			'max'	 => 1920,
			'step'	 => 1,
		),
	),
	"emulsion_content_width"					 => array(
		'section'					 => 'emulsion_section_layout_main',
		'default'					 => emulsion_addons_default_values( "emulsion_content_width", $content_width ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => 'px',
		'label'						 => esc_html__( 'Content width', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_content_width_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'absint',
		'extend_customize_control'	 => '',
		'type'						 => 'number',
		'input_attrs'				 => array(
			'min'	 => 480,
			'max'	 => 960,
			'step'	 => 1,
		),
	),
	"emulsion_content_margin_top"				 => array(
		'section'					 => 'emulsion_section_layout_main',
		'default'					 => emulsion_addons_default_values( "emulsion_content_margin_top", 0 ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => 'px',
		'label'						 => esc_html__( 'Content margin top', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_content_margin_top_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'absint',
		'extend_customize_control'	 => '',
		'type'						 => 'number',
		'input_attrs'				 => array(
			'min'	 => 0,
			'max'	 => 96,
			'step'	 => 1,
		),
	),
	"emulsion_layout_homepage"					 => array(
		'section'					 => 'emulsion_section_layout_homepage',
		'default'					 => emulsion_addons_default_values( "emulsion_layout_homepage", 'excerpt' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Layout', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_layout_homepage_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'grid'		 => esc_html__( 'Grid', 'emulsion-addons' ),
			'stream'	 => esc_html__( 'Stream', 'emulsion-addons' ),
			'excerpt'	 => esc_html__( 'Excerpt', 'emulsion-addons' ),
			'full_text'	 => esc_html__( 'Full text', 'emulsion-addons' ),
		),
	),
	"emulsion_layout_homepage_post_image"					 => array(
		'section'					 => 'emulsion_section_layout_homepage',
		'default'					 => emulsion_addons_default_values( "emulsion_layout_homepage_post_image", 'show' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Featured Image', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Display control of featured image in the loop', 'emulsion-addons' ),
		'validate'					 => 'emulsion_layout_homepage_post_image_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'show'		 => esc_html__( 'Show', 'emulsion-addons' ),
			'hide'	 => esc_html__( 'Hide', 'emulsion-addons' ),
		),
	),
	"emulsion_layout_posts_page"				 => array(
		'section'					 => 'emulsion_section_layout_posts_page',
		'default'					 => emulsion_addons_default_values( "emulsion_layout_posts_page", 'excerpt' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Layout', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_layout_posts_page_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'grid'		 => esc_html__( 'Grid', 'emulsion-addons' ),
			'stream'	 => esc_html__( 'Stream', 'emulsion-addons' ),
			'excerpt'		 => esc_html__( 'excerpt', 'emulsion-addons' ),
			'full_text'	 => esc_html__( 'Full text', 'emulsion-addons' ),
		),
	),
	"emulsion_layout_posts_page_post_image"					 => array(
		'section'					 => 'emulsion_section_layout_posts_page',
		'default'					 => emulsion_addons_default_values( "emulsion_layout_posts_page_post_image", 'show' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Featured Image', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Display control of featured image in the loop', 'emulsion-addons' ),
		'validate'					 => 'emulsion_layout_posts_page_post_image_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'show'		 => esc_html__( 'Show', 'emulsion-addons' ),
			'hide'	 => esc_html__( 'Hide', 'emulsion-addons' ),
		),
	),
	"emulsion_layout_date_archives"			 => array(
		'section'					 => 'emulsion_section_layout_date_archives',
		'default'					 => emulsion_addons_default_values( "emulsion_layout_date_archives", 'grid' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Layout', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_layout_date_archives_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'grid'		 => esc_html__( 'Grid', 'emulsion-addons' ),
			'stream'	 => esc_html__( 'Stream', 'emulsion-addons' ),
			'excerpt'	 => esc_html__( 'Excerpt', 'emulsion-addons' ),
			'full_text'	 => esc_html__( 'Full text', 'emulsion-addons' ),
		),
	),
	"emulsion_layout_date_archives_post_image"					 => array(
		'section'					 => 'emulsion_section_layout_date_archives',
		'default'					 => emulsion_addons_default_values( "emulsion_layout_date_archives_post_image", 'show' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Featured Image', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Display control of featured image in the loop', 'emulsion-addons' ),
		'validate'					 => 'emulsion_layout_date_archives_post_image_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'show'		 => esc_html__( 'Show', 'emulsion-addons' ),
			'hide'	 => esc_html__( 'Hide', 'emulsion-addons' ),
		),
	),
	"emulsion_layout_category_archives"		 => array(
		'section'					 => 'emulsion_section_layout_category_archives',
		'default'					 => emulsion_addons_default_values( "emulsion_layout_category_archives",'stream' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Layout', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_layout_category_archives_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'grid'		 => esc_html__( 'Grid', 'emulsion-addons' ),
			'stream'	 => esc_html__( 'Stream', 'emulsion-addons' ),
			'excerpt'	 => esc_html__( 'Excerpt', 'emulsion-addons' ),
			'full_text'	 => esc_html__( 'Full text', 'emulsion-addons' ),
		),
	),
	"emulsion_layout_category_archives_post_image"					 => array(
		'section'					 => 'emulsion_section_layout_category_archives',
		'default'					 => emulsion_addons_default_values( "emulsion_layout_category_archives_post_image", 'show' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Featured Image', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Display control of featured image in the loop', 'emulsion-addons' ),
		'validate'					 => 'emulsion_layout_category_archives_post_image_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'show'		 => esc_html__( 'Show', 'emulsion-addons' ),
			'hide'	 => esc_html__( 'Hide', 'emulsion-addons' ),
		),
	),
	"emulsion_layout_tag_archives"				 => array(
		'section'					 => 'emulsion_section_layout_tag_archives',
		'default'					 => emulsion_addons_default_values( "emulsion_layout_tag_archives", 'stream' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Layout', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_layout_tag_archives_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'grid'		 => esc_html__( 'Grid', 'emulsion-addons' ),
			'stream'	 => esc_html__( 'Stream', 'emulsion-addons' ),
			'excerpt'	 => esc_html__( 'Excerpt', 'emulsion-addons' ),
			'full_text'	 => esc_html__( 'Full text', 'emulsion-addons' ),
		),
	),
	"emulsion_layout_tag_archives_post_image"					 => array(
		'section'					 => 'emulsion_section_layout_tag_archives',
		'default'					 => emulsion_addons_default_values( "emulsion_layout_tag_archives_post_image", 'show' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Featured Image', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Display control of featured image in the loop', 'emulsion-addons' ),
		'validate'					 => 'emulsion_layout_tag_archives_post_image_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'show'	 => esc_html__( 'Show', 'emulsion-addons' ),
			'hide'	 => esc_html__( 'Hide', 'emulsion-addons' ),
		),
	),
	"emulsion_layout_author_archives"			 => array(
		'section'					 => 'emulsion_section_layout_author_archives',
		'default'					 => emulsion_addons_default_values( "emulsion_layout_author_archives",'stream' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Layout', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_layout_author_archives_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'grid'		 => esc_html__( 'Grid', 'emulsion-addons' ),
			'stream'	 => esc_html__( 'Stream', 'emulsion-addons' ),
			'excerpt'	 => esc_html__( 'Excerpt', 'emulsion-addons' ),
			'full_text'	 => esc_html__( 'Full text', 'emulsion-addons' ),
		),
	),
	"emulsion_layout_author_archives_post_image"					 => array(
		'section'					 => 'emulsion_section_layout_author_archives',
		'default'					 => emulsion_addons_default_values( "emulsion_layout_author_archives_post_image",'show' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Featured Image', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Display control of featured image in the loop', 'emulsion-addons' ),
		'validate'					 => 'emulsion_layout_author_archives_post_image_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'show'	 => esc_html__( 'Show', 'emulsion-addons' ),
			'hide'	 => esc_html__( 'Hide', 'emulsion-addons' ),
		),
	),
	"emulsion_layout_search_results"			 => array(
		'section'					 => 'emulsion_section_layout_search_results',
		'default'					 => emulsion_addons_default_values( "emulsion_layout_search_results", 'highlight' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Layout Search Results', 'emulsion-addons' ),
		'description'				 => esc_html__( 'This setting does not support preview.Please open a blog and check it.', 'emulsion-addons' ),
		'validate'					 => 'emulsion_layout_search_results_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'highlight'	 => esc_html__( 'Keyword Highlight', 'emulsion-addons' ),
			'full_text'	 => esc_html__( 'Full text', 'emulsion-addons' ),
		),
	),
	"emulsion_layout_search_results_post_image"					 => array(
		'section'					 => 'emulsion_section_layout_search_results',
		'default'					 => emulsion_addons_default_values( "emulsion_layout_search_results_post_image", 'hide' ),
		'priority'					 => 10,
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Featured Image', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Display control of featured image in the loop', 'emulsion-addons' ),
		'validate'					 => 'emulsion_layout_search_results_post_image_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'show'	 => esc_html__( 'Show', 'emulsion-addons' ),
			'hide'	 => esc_html__( 'Hide', 'emulsion-addons' ),
		),
	),
	/**
	 * Footer
	 */
	"emulsion_footer_credit"					 => array(
		'section'					 => 'emulsion_section_layout_footer',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_footer_credit", "" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Footer Credit', 'emulsion-addons' ),
		'description'				 => /* translators: %current_year%: Four letter current year. */
		esc_html__( '%current_year% keyword replace 4digit year value', 'emulsion-addons' ),
		'validate'					 => 'emulsion_footer_credit_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_post_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'textarea',
	),
	"emulsion_footer_columns"					 => array(
		'section'					 => 'emulsion_section_layout_footer',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_footer_columns", 3 ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Footer columns', 'emulsion-addons' ),
		'description'				 => esc_html__( 'If the number of widgets set is less than the setting, the number of columns is displayed according to the number of widgets.', 'emulsion-addons' ),
		'validate'					 => 'emulsion_footer_columns_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'absint',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			1	 => esc_html__( '1 column', 'emulsion-addons' ),
			2	 => esc_html__( '2 columns', 'emulsion-addons' ),
			3	 => esc_html__( '3 columns', 'emulsion-addons' ),
			4	 => esc_html__( '4 columns', 'emulsion-addons' ),
		),
	),
	/**
	 * Advanced
	 */
	"emulsion_reset_theme_settings"			 => array(
		'section'					 => 'emulsion_section_advanced_reset',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_reset_theme_settings", "continue" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Reset theme settings', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Initialize theme customizer settings', 'emulsion-addons' ),
		'validate'					 => 'emulsion_reset_theme_settings_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'continue'	 => esc_html__( 'Maintain setting', 'emulsion-addons' ),
			'reset'		 => esc_html__( 'Reset', 'emulsion-addons' ),
		),
	),
	"emulsion_excerpt_length"					 => array(
		'section'					 => 'emulsion_section_advanced_excerpt',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_excerpt_length", 256 ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Excerpt length', 'emulsion-addons' ),
		'description'				 => esc_html__( 'It is specified by the number of characters, not the number of words', 'emulsion-addons' ),
		'validate'					 => 'emulsion_excerpt_length_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'absint',
		'extend_customize_control'	 => '',
		'type'						 => 'number',
		'input_attrs'				 => array(
			'min'	 => 0,
			'max'	 => 512,
			'step'	 => 1,
		),
	),
	"emulsion_excerpt_linebreak"				 => array(
		'section'					 => 'emulsion_section_advanced_excerpt',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_excerpt_linebreak", 'none' ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Excerpt Linebreak', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Remove linebreak from excerpt', 'emulsion-addons' ),
		'validate'					 => 'emulsion_excerpt_linebreak_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'block'	 => esc_html__( 'Add linebreak', 'emulsion-addons' ),
			'none'	 => esc_html__( 'Remove linebreak', 'emulsion-addons' ),
		),
	),
	"emulsion_excerpt_length_grid"				 => array(
		'section'					 => 'emulsion_section_advanced_excerpt',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_excerpt_length_grid", 4 ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Grid layout excerpt length', 'emulsion-addons' ),
		'description'				 => esc_html__( 'It is specified by the number of line.', 'emulsion-addons' ),
		'validate'					 => 'emulsion_excerpt_length_grid_validate. default:4',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'absint',
		'extend_customize_control'	 => '',
		'type'						 => 'number',
		'input_attrs'				 => array(
			'min'	 => 1,
			'max'	 => 8,
			'step'	 => 1,
		),
	),
	"emulsion_excerpt_length_stream"			 => array(
		'section'					 => 'emulsion_section_advanced_excerpt',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_excerpt_length_stream", 2 ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'stream layout excerpt length', 'emulsion-addons' ),
		'description'				 => esc_html__( 'It is specified by the number of line. default:2', 'emulsion-addons' ),
		'validate'					 => 'emulsion_excerpt_length_stream_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'absint',
		'extend_customize_control'	 => '',
		'type'						 => 'number',
		'input_attrs'				 => array(
			'min'	 => 1,
			'max'	 => 8,
			'step'	 => 1,
		),
	),
	"emulsion_table_of_contents"				 => array(
		'section'					 => 'emulsion_section_advanced_toc',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_table_of_contents", "enable" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Table of contents', 'emulsion-addons' ),
		'description'				 => esc_html__( 'You can stop table of contents', 'emulsion-addons' ),
		'validate'					 => 'emulsion_table_of_contents_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'enable'	 => esc_html__( 'Enable', 'emulsion-addons' ),
			'disable'	 => esc_html__( 'Disable', 'emulsion-addons' ),
		),
	),
	"emulsion_tooltip"							 => array(
		'section'					 => 'emulsion_section_advanced_tooltip',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_tooltip", "enable" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Tooltip', 'emulsion-addons' ),
		'description'				 => esc_html__( 'You can stop display the tooltip', 'emulsion-addons' ),
		'validate'					 => 'emulsion_tooltip_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'enable'	 => esc_html__( 'Enable', 'emulsion-addons' ),
			'disable'	 => esc_html__( 'Disable', 'emulsion-addons' ),
		),
	),
	"emulsion_sticky_sidebar"					 => array(
		'section'					 => 'emulsion_section_advanced_sticky_sidebar',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_sticky_sidebar", "enable" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Sticky Sidebar', 'emulsion-addons' ),
		'description'				 => esc_html__( 'You can stop display the tooltip', 'emulsion-addons' ),
		'validate'					 => 'emulsion_sticky_sidebar_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'enable'	 => esc_html__( 'Enable', 'emulsion-addons' ),
			'disable'	 => esc_html__( 'Disable', 'emulsion-addons' ),
		),
	),
	"emulsion_lazyload"						 => array(
		'section'					 => 'emulsion_section_advanced_lazyload',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_lazyload", "disable" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Lazyload', 'emulsion-addons' ),
		'description'				 => esc_html__( 'You can stop the lazyloading', 'emulsion-addons' ),
		'validate'					 => 'emulsion_lazyload_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'enable'	 => esc_html__( 'Enable', 'emulsion-addons' ),
			'disable'	 => esc_html__( 'Disable', 'emulsion-addons' ),
		),
	),
	"emulsion_instantclick"					 => array(
		'section'					 => 'emulsion_section_advanced_instantclick',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_instantclick", "enable" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'InstantClick', 'emulsion-addons' ),
		'description'				 => esc_html__( 'You can stop the instantclick', 'emulsion-addons' ),
		'validate'					 => 'emulsion_instantclick_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'enable'	 => esc_html__( 'Enable', 'emulsion-addons' ),
			'disable'	 => esc_html__( 'Disable', 'emulsion-addons' ),
		),
	),
	"emulsion_search_drawer"					 => array(
		'section'					 => 'emulsion_section_advanced_search_drawer',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_search_drawer", "enable" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Search Drawer', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Header search box', 'emulsion-addons' ),
		'validate'					 => 'emulsion_instantclick_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'enable'	 => esc_html__( 'Enable', 'emulsion-addons' ),
			'disable'	 => esc_html__( 'Disable', 'emulsion-addons' ),
		),
	),
	"emulsion_relate_posts"					 => array(
		'section'					 => 'emulsion_section_advanced_relate_posts',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_relate_posts", "enable" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Relate Posts', 'emulsion-addons' ),
		'description'				 => esc_html__( 'You can stop the relate posts', 'emulsion-addons' ),
		'validate'					 => 'emulsion_relate_posts_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'enable'	 => esc_html__( 'Enable', 'emulsion-addons' ),
			'disable'	 => esc_html__( 'Disable', 'emulsion-addons' ),
		),
	),
	"emulsion_customizer_preview_redirect"					 => array(
		'section'					 => 'emulsion_section_advanced_customizer',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_customizer_preview_redirect", "enable" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Customize Preview Auto Redirect', 'emulsion-addons' ),
		'description'				 => esc_html__( 'You can stop moving the preview page when you open the section.', 'emulsion-addons' ),
		'validate'					 => 'emulsion_customizer_preview_redirect_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'enable'	 => esc_html__( 'Enable', 'emulsion-addons' ),
			'disable'	 => esc_html__( 'Disable', 'emulsion-addons' ),
		),
	),
	"emulsion_single_post_navigation"					 => array(
		'section'					 => 'emulsion_section_single_post_navigation',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_single_post_navigation", "enable" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Single Post Navigation', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Set the visibility of prev next link at the bottom of the single post', 'emulsion-addons' ),
		'validate'					 => 'emulsion_single_post_navigation_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'enable'	 => esc_html__( 'Enable', 'emulsion-addons' ),
			'disable'	 => esc_html__( 'Disable', 'emulsion-addons' ),
		),
	),
	/**
	 * Block editor
	 */
	"emulsion_alignfull"						 => array(
		'section'					 => 'emulsion_section_block_editor_alignwide',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_alignfull", "enable" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Alignwide', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Display content in full page width.', 'emulsion-addons' ),
		'validate'					 => 'emulsion_alignfull_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'enable'	 => esc_html__( 'Enable', 'emulsion-addons' ),
			'disable'	 => esc_html__( 'Disable', 'emulsion-addons' ),
		),
	),
	"emulsion_box_gap"							 => array(
		'section'					 => 'emulsion_section_block_editor_box_gap',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_box_gap", 3 ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Box Gap', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_box_gap_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'absint',
		'extend_customize_control'	 => '',
		'type'						 => 'number',
		'input_attrs'				 => array(
			'min'	 => 0,
			'max'	 => 32,
			'step'	 => 1,
		),
	),

	"emulsion_colors_for_editor"				 => array(
		'section'					 => 'emulsion_section_colors_for_editor',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_colors_for_editor", "enable" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Colors for block editor', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Display the same color scheme as the front end in the block editor', 'emulsion-addons' ),
		'validate'					 => 'emulsion_colors_for_editor_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'enable'	 => esc_html__( 'Enable', 'emulsion-addons' ),
			'disable'	 => esc_html__( 'Disable', 'emulsion-addons' ),
		),
	),
	"emulsion_theme_color_palette"				 => array(
		'section'					 => 'emulsion_section_colors_for_editor',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_theme_color_palette", "disable" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Allow Theme Color Pallet', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Enable the theme color palette. If disabled, use the core color palette', 'emulsion-addons' ),
		'validate'					 => 'emulsion_theme_color_palette_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'enable'	 => esc_html__( 'Enable', 'emulsion-addons' ),
			'disable'	 => esc_html__( 'Disable', 'emulsion-addons' ),
		),
	),
	"emulsion_favorite_color_palette"			 => array(
		'section'					 => 'emulsion_section_colors_for_editor',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_favorite_color_palette", "#fafafa" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Color Palette', 'emulsion-addons' ),
		'description'				 => esc_html__( 'Add your favorite color to the editor color palette', 'emulsion-addons' ),
		'validate'					 => 'emulsion_favorite_color_palette_validate',
		'active_callback'			 => 'emulsion_favorite_color_palette_active_callback',
		'sanitize_callback'			 => 'sanitize_hex_color',
		'extend_customize_control'	 => 'WP_Customize_Color_Control',
	),
	/**
	 * Post
	 */
	"emulsion_post_display_date"				 => array(
		'section'					 => 'emulsion_section_post',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_post_display_date", "inherit" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Publish Date', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_post_display_date_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'none'		 => esc_html__( 'hide', 'emulsion-addons' ),
			'inherit'	 => esc_html__( 'show', 'emulsion-addons' ),
		),
	),
	"emulsion_post_display_date_format"		 => array(
		'section'					 => 'emulsion_section_post',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_post_display_date_format", "default" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Publish Date Format', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_post_display_date_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'ago'		 => emulsion_post_display_method_date_example_value( 'ago' ),
			'default'	 => emulsion_post_display_method_date_example_value(),
		),
	),
	"emulsion_post_display_author"				 => array(
		'section'					 => 'emulsion_section_post',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_post_display_author", "inherit" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Author', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_post_display_author_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'none'		 => esc_html__( 'hide', 'emulsion-addons' ),
			'inherit'	 => esc_html__( 'show', 'emulsion-addons' ),
		),
	),
	"emulsion_post_display_author_format"		 => array(
		'section'					 => 'emulsion_section_post',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_post_display_author_format", "text" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'refresh',
		'unit'						 => '',
		'label'						 => esc_html__( 'Author Format', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_post_display_author_format_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'text'	 => esc_html__( 'text', 'emulsion-addons' ),
			'inline' => esc_html__( 'inline avatar', 'emulsion-addons' ),
			'block'	 => esc_html__( 'block avatar', 'emulsion-addons' ),
		),
	),
	"emulsion_post_display_category"			 => array(
		'section'					 => 'emulsion_section_post',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_post_display_category", "inherit" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Category', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_post_display_category_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'none'		 => esc_html__( 'hide', 'emulsion-addons' ),
			'inherit'	 => esc_html__( 'show', 'emulsion-addons' ),
		),
	),
	"emulsion_post_display_tag"			 => array(
		'section'					 => 'emulsion_section_post',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_post_display_tag", "inherit" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Tag', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_post_display_tag_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'extend_customize_control'	 => '',
		'type'						 => 'radio',
		'choices'					 => array(
			'none'		 => esc_html__( 'hide', 'emulsion-addons' ),
			'inherit'	 => esc_html__( 'show', 'emulsion-addons' ),
		),
	),
	/**
	 * Borders
	 */
////////////////////////////////////////////
	"emulsion_border_global"				 => array(
		'section'					 => 'emulsion_section_border_global',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_border_global", '#bcbcbc' ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Border Color', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_border_global_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'sanitize_hex_color',
		'extend_customize_control'	 => 'WP_Customize_Color_Control',

	),
	"emulsion_border_global_style"				 => array(
		'section'					 => 'emulsion_section_border_global',
		'priority'					 => 11,
		'default'					 => emulsion_addons_default_values( "emulsion_border_global_style", "solid" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Border Style', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_border_global_style_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'type'						 => 'radio',
		'choices'					 => array(
			'none'		 => esc_html__( 'none', 'emulsion-addons' ),
			'solid'	 => esc_html__( 'solid', 'emulsion-addons' ),
			'dashed'	 => esc_html__( 'dashed', 'emulsion-addons' ),
			'dotted'	 => esc_html__( 'dotted', 'emulsion-addons' ),
		),

	),
	"emulsion_border_global_width"				 => array(
		'section'					 => 'emulsion_section_border_global',
		'priority'					 => 11,
		'default'					 => emulsion_addons_default_values( "emulsion_border_global_width", 1 ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => 'px',
		'label'						 => esc_html__( 'Border width', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_border_global_width_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'type'						 => 'number',
		'input_attrs'				 => array(
			'min'	 => 1,
			'max'	 => 16,
			'step'	 => 1,
		),

	),
////////////////////////////////////////////
	"emulsion_border_sidebar"				 => array(
		'section'					 => 'emulsion_section_border_sidebar',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_border_sidebar", '#bcbcbc' ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Border Color', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_border_sidebar_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'sanitize_hex_color',
		'extend_customize_control'	 => 'WP_Customize_Color_Control',

	),
	"emulsion_border_sidebar_style"				 => array(
		'section'					 => 'emulsion_section_border_sidebar',
		'priority'					 => 11,
		'default'					 => emulsion_addons_default_values( "emulsion_border_sidebar_style", "solid" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Border Style', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_border_sidebar_style_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'type'						 => 'radio',
		'choices'					 => array(
			'none'		 => esc_html__( 'none', 'emulsion-addons' ),
			'solid'	 => esc_html__( 'solid', 'emulsion-addons' ),
			'dashed'	 => esc_html__( 'dashed', 'emulsion-addons' ),
			'dotted'	 => esc_html__( 'dotted', 'emulsion-addons' ),
		),

	),
	"emulsion_border_sidebar_width"				 => array(
		'section'					 => 'emulsion_section_border_sidebar',
		'priority'					 => 11,
		'default'					 => emulsion_addons_default_values( "emulsion_border_sidebar_width", 1 ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => 'px',
		'label'						 => esc_html__( 'Border width', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_border_sidebar_width_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'type'						 => 'number',
		'input_attrs'				 => array(
			'min'	 => 1,
			'max'	 => 16,
			'step'	 => 1,
		),

	),
	"emulsion_border_grid"				 => array(
		'section'					 => 'emulsion_section_border_grid',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_border_grid", '#bcbcbc' ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Border Color', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_border_grid_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'sanitize_hex_color',
		'extend_customize_control'	 => 'WP_Customize_Color_Control',

	),
	"emulsion_border_grid_style"				 => array(
		'section'					 => 'emulsion_section_border_grid',
		'priority'					 => 11,
		'default'					 => emulsion_addons_default_values( "emulsion_border_grid_style", "solid" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Border Style', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_border_grid_style_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'type'						 => 'radio',
		'choices'					 => array(
			'none'		 => esc_html__( 'none', 'emulsion-addons' ),
			'solid'	 => esc_html__( 'solid', 'emulsion-addons' ),
			'dashed'	 => esc_html__( 'dashed', 'emulsion-addons' ),
			'dotted'	 => esc_html__( 'dotted', 'emulsion-addons' ),
		),

	),
	"emulsion_border_grid_width"				 => array(
		'section'					 => 'emulsion_section_border_grid',
		'priority'					 => 11,
		'default'					 => emulsion_addons_default_values( "emulsion_border_grid_width", 1 ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => 'px',
		'label'						 => esc_html__( 'Border width', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_border_grid_width_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'type'						 => 'number',
		'input_attrs'				 => array(
			'min'	 => 1,
			'max'	 => 16,
			'step'	 => 1,
		),

	),
	"emulsion_border_stream"				 => array(
		'section'					 => 'emulsion_section_border_stream',
		'priority'					 => 10,
		'default'					 => emulsion_addons_default_values( "emulsion_border_stream", '#bcbcbc' ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Border Color', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_border_stream_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'sanitize_hex_color',
		'extend_customize_control'	 => 'WP_Customize_Color_Control',

	),
	"emulsion_border_stream_style"				 => array(
		'section'					 => 'emulsion_section_border_stream',
		'priority'					 => 11,
		'default'					 => emulsion_addons_default_values( "emulsion_border_stream_style", "solid" ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Border Style', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_border_stream_style_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'type'						 => 'radio',
		'choices'					 => array(
			'none'		 => esc_html__( 'none', 'emulsion-addons' ),
			'solid'	 => esc_html__( 'sollid', 'emulsion-addons' ),
			'dashed'	 => esc_html__( 'dashed', 'emulsion-addons' ),
			'dotted'	 => esc_html__( 'dotted', 'emulsion-addons' ),
		),
	),
	"emulsion_border_stream_width"				 => array(
		'section'					 => 'emulsion_section_border_stream',
		'priority'					 => 11,
		'default'					 => emulsion_addons_default_values( "emulsion_border_stream_width", 1 ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => 'px',
		'label'						 => esc_html__( 'Border width', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_border_stream_width_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'type'						 => 'number',
		'input_attrs'				 => array(
			'min'	 => 1,
			'max'	 => 16,
			'step'	 => 1,
		),

	),

	/**
	 * Misc
	 */

	"emulsion_google_analytics_tracking_code"				 => array(
		'section'					 => 'title_tagline',
		'priority'					 => 11,
		'default'					 => emulsion_addons_default_values( "emulsion_google_analytics_tracking_code", '' ),
		'data_type'					 => $emulsion_setting_type,
		'capability'				 => $emulsion_customize_cap,
		'transport'					 => 'postMessage',
		'unit'						 => '',
		'label'						 => esc_html__( 'Google Analytics', 'emulsion-addons' ),
		'description'				 => '',
		'validate'					 => 'emulsion_google_analytics_tracking_code_validate',
		'active_callback'			 => '',
		'sanitize_callback'			 => 'wp_filter_nohtml_kses',
		'type'						 => 'text',
		'input_attrs'				 => array(
			/* translators: Here is an example of Google Analytics Tracking Code. Please do not translate, please show original text */
			'placeholder' => __( 'UA-XXXXXX-XX', 'emulsion-addons' ),
		),

	),
);


if( 'fse' == get_theme_mod('emulsion_editor_support') ) {

	emulsion_remove_supports( 'background' );
}
/**
 * Panel
 */
$emulsion_theme_customize_panels = array(
	'emulsion_theme_settings_border_panel'			 => array(
		'priority'		 => 41,
		'capability'	 => $emulsion_customize_cap,
		'theme_supports' => '',
		'title'			 => esc_html__( 'Borders', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_theme_settings_fonts_panel'			 => array(
		'priority'		 => 41,
		'capability'	 => $emulsion_customize_cap,
		'theme_supports' => '',
		'title'			 => esc_html__( 'Fonts', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_theme_settings_link_panel'			 => array(
		'priority'		 => 41,
		'capability'	 => $emulsion_customize_cap,
		'theme_supports' => '',
		'title'			 => esc_html__( 'Link', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_theme_settings_layout_panel'			 => array(
		'priority'		 => 42,
		'capability'	 => $emulsion_customize_cap,
		'theme_supports' => '',
		'title'			 => esc_html__( 'Layouts', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_theme_settings_advanced_panel'		 => array(
		'priority'		 => 250,
		'capability'	 => $emulsion_customize_cap,
		'theme_supports' => '',
		'title'			 => esc_html__( 'Theme Advanced Settings', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_theme_settings_block_editor_panel'	 => array(
		'priority'		 => 62,
		'capability'	 => $emulsion_customize_cap,
		'theme_supports' => '',
		'title'			 => esc_html__( 'Block editor', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_theme_settings_post_panel'			 => array(
		'priority'		 => 59,
		'capability'	 => $emulsion_customize_cap,
		'theme_supports' => '',
		'title'			 => esc_html__( 'Post and Block Editor', 'emulsion-addons' ),
		'description'	 => '',
	),

);

/**
 * Section
 */

$emulsion_theme_customize_sections = array(

	'emulsion_section_scheme'					 => array(
		'priority'		 => 25,
		'panel'			 => '',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Scheme', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_border_global'					 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_border_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Global', 'emulsion-addons' ),
		'description'	 => '',
	),

	'emulsion_section_border_sidebar'					 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_border_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Sidebar', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_border_block'					 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_border_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Block', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_border_grid'					 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_border_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Grid', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_border_stream'					 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_border_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Stream', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_fonts_general'					 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_fonts_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'General', 'emulsion-addons' ),
		'description'	 => '',
	),
	'blocktyp_section_link_style'						 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_link_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Link Style', 'emulsion-addons' ),
		'description'	 => esc_html__( 'Set link CSS', 'emulsion-addons' ),
	),
	'emulsion_section_fonts_heading'					 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_fonts_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Heading', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_fonts_widget_meta'				 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_fonts_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Widget, Meta data,', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_layout_header'					 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_layout_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Header', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_layout_sidebar'					 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_layout_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Sidebar', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_layout_main'						 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_layout_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Main content area', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_layout_footer'					 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_layout_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Footer', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_layout_homepage'					 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_layout_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Homepage', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_layout_posts_page'				 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_layout_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Posts page', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_layout_date_archives'			 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_layout_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Archives: Date', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_layout_category_archives'		 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_layout_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Archives: Category', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_layout_tag_archives'				 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_layout_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Archives: Tag', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_layout_author_archives'			 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_layout_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Archives: Author', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_layout_search_results'			 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_layout_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Search Results', 'emulsion-addons' ),
		'description'	 => '',
	),

	/**
	 * Advanced
	 */
	'emulsion_section_advanced_reset'					 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_advanced_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Reset theme settings', 'emulsion-addons' ),
		'description'	 => esc_html__( 'This change can not be undone. This process is performed when the blog is displayed', 'emulsion-addons' ),
	),
	'emulsion_section_advanced_excerpt'				 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_advanced_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Excerpt', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_advanced_toc'					 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_advanced_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Table of contents', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_advanced_tooltip'				 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_advanced_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Tooltip', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_advanced_sticky_sidebar'			 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_advanced_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Sticky sidebar', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_advanced_lazyload'				 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_advanced_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Lazyload', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_advanced_instantclick'			 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_advanced_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'InstantClick', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_advanced_search_drawer'			 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_advanced_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Search Drawer', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_advanced_relate_posts'			 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_advanced_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Relate Posts', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_advanced_customizer'			 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_advanced_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Customizer', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_single_post_navigation'			 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_advanced_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Single Post Navigation', 'emulsion-addons' ),
		'description'	 => '',
	),
	/**
	 * Post
	 */
	'emulsion_section_post'				 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_post_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Post Metadata', 'emulsion-addons' ),
		'description'	 => '',
	),
	/**
	 * emulsion
	 */
	'emulsion_section_block_editor_alignwide'			 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_post_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Alignwide', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_block_editor_box_gap'			 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_post_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Box gap', 'emulsion-addons' ),
		'description'	 => esc_html__( 'Adjust the spacing of blocks in which the border is displayed', 'emulsion-addons' ),
	),
	'emulsion_section_block_editor_block_gallery'		 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_post_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Block gallery', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_block_editor_block_columns'		 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_post_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Block columns', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_block_editor_block_media_text'	 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_post_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Block media text', 'emulsion-addons' ),
		'description'	 => '',
	),
	'emulsion_section_colors_for_editor'				 => array(
		'priority'		 => 25,
		'panel'			 => 'emulsion_theme_settings_post_panel',
		'theme_supports' => '',
		'title'			 => esc_html__( 'Color Pallet', 'emulsion-addons' ),
		'description'	 => esc_html__( 'Your favorite color to the post color palette.', 'emulsion-addons' ),
	),
);

/**
 * Active Callback
 * @param type $control
 * @return boolean
 */
function emulsion_header_html_active_callback( $control ) {

	return ( 'self' === $control->manager->get_setting( 'emulsion_header_layout' )->value() );
}

function emulsion_title_in_header_active_callback( $control ) {
	// @see customize.php: customizer value conditional change

	return ( 'custom' === $control->manager->get_setting( 'emulsion_header_layout' )->value() );
}

function emulsion_header_sub_background_color_active_callback( $control ) {

	return ( 'enable' === $control->manager->get_setting( 'emulsion_header_gradient' )->value() );
}
function emulsion_favorite_color_palette_active_callback( $control ) {

	return ( 'enable' === $control->manager->get_setting( 'emulsion_colors_for_editor' )->value() );
}
/**
 * Validate callback
 *
 */
function emulsion_main_width_limit_value( $validity, $value ) {
	$value = absint( $value );

	$limit_value = get_theme_mod( 'emulsion_content_width', emulsion_get_var( 'emulsion_content_width' ) );

	if ( $value < $limit_value ) {

		$validity->add( 'hello', $value . $limit_value . esc_html__( 'The Main width must be the same as or greater than the Content width', 'emulsion-addons' ) );
	}
	return $validity;
}

function emulsion_content_width_limit_value( $validity, $value ) {
	$value = absint( $value );

	$limit_value = get_theme_mod( 'emulsion_main_width', emulsion_get_var( 'emulsion_main_width' ) );

	if ( $value > $limit_value ) {

		$validity->add( 'required', esc_html__( 'Content width must be less than or equal to Main width.', 'emulsion-addons' ) );
	}
	return $validity;
}

function emulsion_post_display_method_date_example_value( $type = 'defaul' ) {

	/**
	 * Date format label date
	 * This date is used only to indicate the format of the date. Simply show the date three days before now
	 */
	$example_date	 = current_time( 'timestamp' ) - 259200;
	$date_format	 = sanitize_option( 'date_format', get_option( 'date_format' ) ) . ' ' . sanitize_option( 'time_format', get_option( 'time_format' ) );

	if ( $type == 'ago' ) {
		/* translators: %s  human_time_diff() */
		return sprintf( esc_html__( '%s ago', 'emulsion-addons' ), human_time_diff( $example_date, current_time( 'timestamp' ) ) );
	}

	return date_i18n( $date_format, $example_date );
}

//latest-post, gallery, columns, media-text, alignwide, comments-open tag-slug
function emulsion_get_customize_post_id( $type = '' ) {

	$count_posts = (object) wp_count_posts();

	$count_posts =  $count_posts->publish;

	if( is_int( $count_posts ) ) {
		$post_count = absint( $count_posts );
	} else {
		$post_count = -1;
	}

	/**
	 * mean of 2018/12/10
	 * WordPress 5.0 release date
	 *
	 * When acquiring post IDs, the selection range is reduced by filtering on IDs after the release date
	 * The Theme review team rules prohibit getting all posts.
	 *
	 */
	$posts_args	 = array(
		'posts_per_page' => $post_count,
		'date_query'	 => array(
			array(
				'after' => '2018/12/10'
			),
		),
	);
	$all_posts	 = get_posts( $posts_args );

	$result = 0;

	if ( 'latest-post' == $type && isset( $all_posts ) ) {

		$latest_post_id = $all_posts[0]->ID;

		if( isset( $latest_post_id ) && is_int( $latest_post_id ) ) {

			return $latest_post_id;
		}

		return $result;
	}

	if ( 'comments-open' == $type  && isset( $all_posts ) ) {

		foreach ( $all_posts as $post ) {

			$emulsion_post_id = absint( $post->ID );

			if( comments_open( $emulsion_post_id ) ) {

				$result = absint( $emulsion_post_id );
				break;
			}
		}
		wp_reset_postdata();

		if( isset( $result ) && is_int( $result ) ) {

			return $result;
		}

	}
	if ( 'gallery' == $type  && isset( $all_posts ) ) {

		foreach ( $all_posts as $post ) {
			//exclude alignleft alignright
			if ( preg_match( '#wp:gallery {(.+)?[^(left|right)]+}#', $post->post_content ) ) {

				$result = absint( $post->ID );
				break;
			}
		}
		wp_reset_postdata();

		if( isset( $result ) && is_int( $result ) ) {

			return $result;
		}
	}
	if ( 'columns' == $type  && isset( $all_posts ) ) {

		foreach ( $all_posts as $post ) {
			if ( strstr( $post->post_content, 'wp:columns' ) ) {
				$result = absint( $post->ID );
				break;
			}
		}
		wp_reset_postdata();

		if( isset( $result ) && is_int( $result ) ) {

			return $result;
		}
	}
	if ( 'media-text' == $type  && isset( $all_posts ) ) {

		foreach ( $all_posts as $post ) {
			if ( strstr( $post->post_content, 'wp:media-text' ) ) {
				$result = absint( $post->ID );
				break;
			}
		}

		wp_reset_postdata();

		return $result;
	}
	if ( 'alignwide' == $type  && isset( $all_posts ) ) {

		foreach ( $all_posts as $post ) {

			if ( preg_match( '#{(.+)?("align":"full"|"align":"wide")(.+)?}#', $post->post_content )  ) {

				$result = absint( $post->ID );
				break;
			}
		}
		wp_reset_postdata();

		if( isset( $result ) && is_int( $result ) ) {

			return $result;
		}
	}
	if ( 'tag-slug' == $type ) {
			// not post id. return most used tag slug
			$args				 = array( 'order' => 'desc', 'orderby' => 'count', 'number' => 1, 'hide_empty' => true );
			$tags				 = get_tags( $args );
			if( isset($tags[0]) && ! empty( $tags[0]->slug ) ) {

				$most_used_tag_slug	 = sanitize_title( $tags[0]->slug );

				return $most_used_tag_slug;

			} else {

				return 0;
			}
	}
}

function emulsion_control_description( $control ) {

	$customizer_url = 'javascript:var url = wp.customize.settings.url.home + \'?%1$s\'; wp.customize.previewer.previewUrl.set( url );';
	$preview_text = esc_html__('Move preview to ', 'emulsion-addons');

	switch ( $control ) {
		case 'emulsion_relate_posts_bg':

			$link_id	 = emulsion_get_customize_post_id( 'latest-post' );
			$url		 = sprintf( $customizer_url, 'p=' . $link_id );
			$link_text	 = esc_html__( 'latest post', 'emulsion-addons' );

				return sprintf( '%1$s<a href="%2$s">%3$s</a>', $preview_text, $url, $link_text );
			break;
		case 'emulsion_category_colors':

			$url		 = sprintf( $customizer_url, 'cat=1' );
			$link_text	 = esc_html__( 'category archive', 'emulsion-addons' );

				return sprintf( '%1$s<a href="%2$s">%3$s</a>', $preview_text, $url, $link_text );

			break;
		case 'emulsion_primary_menu_background':

			$header_layout = get_theme_mod( 'emulsion_header_layout', emulsion_get_var( 'emulsion_header_layout') );

			if( 'simple' == $header_layout || 'self' == $header_layout) {

				$notification_titile = esc_html__( 'This setting is not currently available. Header background color applied', 'emulsion-addons' );
				$notification_text = esc_html__( 'If you want to specify your own color, Requred header layout settings to custom ', 'emulsion-addons');
				$link_text	 = esc_html__( 'Header Layout', 'emulsion-addons' );
				$customizer_url = 'javascript:wp.customize.section( \'emulsion_section_layout_header\' ).focus()';

					return sprintf( '<p>%4$s</p>%1$s<a href="%2$s">%3$s</a>', $notification_text, $customizer_url, $link_text, $notification_titile );
			}
			break;
		case 'emulsion_comments_bg':
			$preview_text			 = esc_html__('Change preview ', 'emulsion-addons');
			$link_id				 = emulsion_get_customize_post_id( 'latest_post' );
			$url					 = sprintf( $customizer_url, 'p=' . $link_id );
			$link_text				 = esc_html__( 'latest post', 'emulsion-addons' );
			$allow_comments_post	 = emulsion_get_customize_post_id( 'comments-open' );
			$allow_comments_post_url = sprintf( $customizer_url, 'p=' . $allow_comments_post );

			$emulsion_post_id = absint( $link_id );

			if( isset( $emulsion_post_id) && is_int( $emulsion_post_id ) ) {

				if( 0 < $emulsion_post_id && comments_open( $link_id ) ) {

					return sprintf( '%1$s<a href="%2$s">%3$s</a>', $preview_text, $url, $link_text );
				} elseif( 0 !== $allow_comments_post ) {

					$link_text = esc_html__( 'comments allowed post', 'emulsion-addons' );
					return sprintf( '%1$s<a href="%2$s">%3$s</a>', $preview_text, $allow_comments_post_url, $link_text );
				} else {

					$link_text = esc_html__( 'Can not find comments allowed Post', 'emulsion-addons' );
					return sprintf( '%1$s %2$s', '', $link_text );
				}
			}

			break;
	}
}

function emulsion_addons_default_values( $name, $fallback ) {


	global $emulsion_theme_scheme, $content_width;

	$scheme = get_theme_mod( 'emulsion_scheme' );

	if ( ! defined( 'emulsion_theme_scheme' ) ) {
		include( get_template_directory() . '/scheme.php');
	}

	if ( defined( 'emulsion_theme_scheme' ) && isset( emulsion_theme_scheme[$scheme][$name] ) ) {

		$function_name			 = emulsion_theme_scheme[$scheme][$name];
		$function_name_validate	 = $name . '_validate';

		if ( function_exists( $function_name ) &&
				function_exists( $function_name_validate ) &&
				false !== strstr( emulsion_theme_scheme[$scheme][$name], 'emulsion-addons' ) ) {

			$result = $function_name();

			$result = $function_name_validate( $result );


			return $result;
		}
		$result = emulsion_theme_scheme[$scheme][$name];

		return $result;
	} else {

		return $fallback;
	}
}
