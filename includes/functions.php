<?php

function emulsion_plugin_info( $info, $echo = true ) {

	if ( ! function_exists( 'get_plugin_data' ) ) {

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	$emulsion_current_data = get_plugin_data( plugin_dir_path( __DIR__ ) . 'emulsion.php' );

	if ( strcasecmp( $info, 'PluginROOT' ) == 0 ) {

		$result = plugin_dir_path( __DIR__ );

		if ( 0 !== validate_file( $result ) ) {
			return false;
		}
	}

	if ( strcasecmp( $info, 'PluginURI' ) == 0 ) {

		$result	 = apply_filters( 'emulsion_plugin_url', $emulsion_current_data['PluginURI'] );
		$result	 = wp_http_validate_url( $result );
	}
	if ( strcasecmp( $info, 'AuthorURI' ) == 0 ) {

		$result	 = apply_filters( 'emulsion_plugin_author_url', $emulsion_current_data['AuthorURI'] );
		$result	 = wp_http_validate_url( $result );
	}
	if ( strcasecmp( $info, 'Version' ) == 0 ) {

		$result	 = $emulsion_current_data['Version'];
		$result	 = sanitize_text_field( $result );
	}
	if ( strcasecmp( $info, 'Name' ) == 0 ) {

		$result	 = $emulsion_current_data['Name'];
		$result	 = sanitize_text_field( $result );
	}
	if ( strcasecmp( $info, 'Slug' ) == 0 ) {

		$emulsion_current_plugin_name	 = $emulsion_current_data['Name'];
		$result							 = sanitize_title_with_dashes( $emulsion_current_plugin_name );
	}
	if ( strcasecmp( $info, 'TextDomain' ) == 0 ) {

		$result	 = $emulsion_current_data['TextDomain'];
		$result	 = sanitize_text_field( $result );
	}

	if ( $echo == true && ! empty( $result ) ) {

		echo $result;
	}
	if ( $echo !== true && ! empty( $result ) ) {

		return $result;
	}

	return false;
}

function emulsion_plugin_template_part( $slug, $name = null ) {
	/**
	 * Fires before the specified template part file is loaded.
	 *
	 * The dynamic portion of the hook name, `$slug`, refers to the slug name
	 * for the generic template part.
	 *
	 * @since 3.0.0
	 *
	 * @param string      $slug The slug name for the generic template.
	 * @param string|null $name The name of the specialized template.
	 */
	do_action( "emulsion_plugin_template_part_{$slug}", $slug, $name );

	$templates	 = array();
	$name		 = (string) $name;
	if ( '' !== $name ) {
		$templates[] = "{$slug}-{$name}.php";
	}

	$templates[] = "{$slug}.php";

	/**
	 * Fires before a template part is loaded.
	 *
	 * @since 5.2.0
	 *
	 * @param string   $slug      The slug name for the generic template.
	 * @param string   $name      The name of the specialized template.
	 * @param string[] $templates Array of template files to search for, in order.
	 */
	do_action( 'emulsion_plugin_template_part', $slug, $name, $templates );

	emulsion_locate_file( $templates, true, false );
}

function emulsion_locate_file( $template_names, $load = false,
		$require_once = true ) {
	$located = '';
	foreach ( (array) $template_names as $template_name ) {
		if ( ! $template_name ) {
			continue;
		}
		if ( file_exists( emulsion_plugin_info( 'PluginROOT', false ) . $template_name ) ) {
			$located = emulsion_plugin_info( 'PluginROOT', false ) . $template_name;
			break;
		}
	}

	if ( $load && '' != $located ) {
		load_template( $located, $require_once );
	}

	return $located;
}

/**
 * Debug function
 */
if ( ! function_exists( 'emulsion_get_current_settings' ) ) {

	function emulsion_get_current_settings() {

		global $emulsion_customize_args;

		foreach ( $emulsion_customize_args as $key => $val ) {

			$val	 = var_export( get_theme_mod( $key ), true );
			$val	 = false === $val ? esc_html__( 'Not Yet Customized', 'emulsion-addons' ) : trim( $val, "'" );
			$filter	 = has_filter( 'theme_mod_' . $key ) ? esc_html__( 'Detected', 'emulsion-addons' ) . ' theme_mod_' . $key : esc_html__( 'Not used', 'emulsion-addons' );
			$default = emulsion_get_var( $key, 'default' );

			printf( '<dl><dt class="mod-name">%1$s</dt><dd class="default-value">%5$s %2$s</dd><dd class="current-value">%6$s %3$s</dd><dd class="has-filter">%7$s %4$s</dd></dl>', wp_kses( $key, array() ), wp_kses( $default, array() ), wp_kses( $val, array() ), wp_kses( $filter, array() ), esc_html__( 'Default:', 'emulsion-addons' ), esc_html__( 'Current val:', 'emulsion-addons' ), esc_html__( 'Filter:', 'emulsion-addons' ) );
		}
	}

}

/**
 * Theme Body Class
 */
if ( ! function_exists( 'emulsion_addons_body_class' ) ) {

	/**
	 * Theme body class
	 * @global type $_wp_theme_features
	 * @param type $classes
	 * @return array;
	 */
	function emulsion_addons_body_class( $classes ) {
		global $_wp_theme_features;

		if ( 'fse' == emulsion_get_theme_operation_mode() ) {
			return $classes;
		}

		$metabox_flag = false;

		unset( $classes['emulsion'] );

		$classes[] = sanitize_html_class( emulsion_plugin_info( 'Slug', false ) );

		if ( is_singular() ) {

			$classes[]	 = 'is-singular';
		} else {

			switch ( false ) {
				case is_404():
					$classes[] = 'is-loop';
					break;
			}
		}

		/**
		 * full width image
		 */
		if ( true == emulsion_get_supports( 'alignfull' ) ) {

			$classes[] = 'enable-alignfull';
		} else {

			$classes[] = 'disable-alignfull';
		}

		/**
		 * Current Page layout type
		 */
		$layout_type = emulsion_current_layout_type();
		$classes[]	 = 'layout-' . sanitize_html_class( $layout_type );

		/**
		 * Content type
		 */
		$content_type	 = emulsion_content_type();
		$classes[]		 = sanitize_html_class( $content_type );



		return array_filter( $classes ); // remove empty class
	}

}

if ( ! function_exists( 'emulsion_reset_customizer_settings' ) ) {

	/**
	 * Reset customizer settings with Server Side
	 * @global type $emulsion_customize_args
	 */
	function emulsion_reset_customizer_settings() {
		global $emulsion_customize_args;

		$header_html	 = get_theme_mod( 'emulsion_header_html', emulsion_get_var( 'emulsion_header_html' ) );
		$footer_credit	 = get_theme_mod( 'emulsion_footer_credit', emulsion_get_var( 'emulsion_footer_credit' ) );
		set_theme_mod( 'emulsion_footer_credit', $footer_credit );
		set_theme_mod( 'emulsion_header_html', $header_html );

		$favorite_color_palette	 = '';
		$favorite_color_palette	 = get_theme_mod( 'emulsion_favorite_color_palette', emulsion_get_var( 'emulsion_favorite_color_palette' ) );

		if ( empty( $emulsion_theme_mod_args ) ) {

			/**
			 * Temporary setting
			 * Settings for older theme versions < theme version 2.5.2
			 */
			$emulsion_theme_mod_args = array(
				'emulsion_editor_support'							 => array(
					'section'			 => 'emulsion_editor',
					'default'			 => 'fse',
					'label'				 => esc_html__( 'Theme Operation Mode Setting', 'emulsion' ),
					'description'		 => esc_html__( 'This theme can be run as either the currently widely used theme ( php template ) or the latest Full site editiong theme ( html template ) by changing the settings.', 'emulsion' ) .
					sprintf( '<p><a href="%1$s" target="blank" style="text-decoration:underline">%2$s</a></p>', 'https://www.tenman.info/wp3/emulsion/en/2021/10/28/emulsion-theme-editor-type/', esc_html__( 'More Details', 'emulsion' ) ),
					'sanitize_callback'	 => 'emulsion_editor_support_validate',
					'type'				 => 'radio',
					'choices'			 => array(
						'fse'			 => esc_html__( 'Full Site Editing Theme', 'emulsion' ),
						'transitional'	 => esc_html__( 'FSE Transitional Theme', 'emulsion' ),
						'theme'			 => esc_html__( 'Classic Theme', 'emulsion' ),
					),
				),
				'emulsion_scheme'									 => array(
					'section'			 => 'emulsion_scheme',
					'default'			 => 'default',
					'label'				 => esc_html__( 'Radio Icon Control', 'emulsion' ),
					'description'		 => esc_html__( 'Plugins activate more detailed settings such as fonts and sidebar colors.', 'emulsion' ),
					'sanitize_callback'	 => 'emulsion_scheme_validate',
					'type'				 => 'emulsionImageRadio',
				),
				/* 'emulsion_header_template'							 => array(
				  'section'			 => 'emulsion_editor',
				  'default'			 => 'html',
				  'label'				 => esc_html__( 'Header Template', 'emulsion' ),
				  'description'		 => esc_html__( 'Select header template. If you select html, it will be displayed in the new html template in all editor settings.', 'emulsion' ),
				  'sanitize_callback'	 => 'emulsion_header_template_validate',
				  'type'				 => 'radio',
				  'choices'			 => array(
				  'html'		 => esc_html__( 'HTML Template', 'emulsion' ),
				  'default'	 => esc_html__( 'Depends on editor settings', 'emulsion' ),
				  ),
				  ),
				  'emulsion_footer_template'							 => array(
				  'section'			 => 'emulsion_editor',
				  'default'			 => 'html',
				  'label'				 => esc_html__( 'Footer Template', 'emulsion' ),
				  'description'		 => esc_html__( 'Select footer template. If you select html, it will be displayed in the new html template in all editor settings.', 'emulsion' ),
				  'sanitize_callback'	 => 'emulsion_footer_template_validate',
				  'type'				 => 'radio',
				  'choices'			 => array(
				  'html'		 => esc_html__( 'HTML Template', 'emulsion' ),
				  'default'	 => esc_html__( 'Depends on editor settings', 'emulsion' ),
				  ),
				  ), */
				'emulsion_should_load_separate_core_block_assets'	 => array(
					'section'			 => 'emulsion_editor',
					'default'			 => 'disable',
					'label'				 => esc_html__( 'Sparate Core Block CSS Load', 'emulsion' ),
					'description'		 => esc_html__( 'Check for the presence of the block and load the required style.', 'emulsion' ),
					'sanitize_callback'	 => 'emulsion_should_load_separate_core_block_assets_validate',
					'type'				 => 'radio',
					'choices'			 => array(
						'disable'	 => esc_html__( 'Disabled', 'emulsion' ),
						'enable'	 => esc_html__( 'Enabled', 'emulsion' ),
					),
				),
				'emulsion_gutenberg_render_layout_support_flag'		 => array(
					'section'			 => 'emulsion_editor',
					'default'			 => 'disable',
					'label'				 => esc_html__( 'Use the gutenberg layout feature with is-layout-flow is-layout-constrained', 'emulsion' ),
					'description'		 => esc_html__( 'The hard-coded inline styles affect the display of the theme.', 'emulsion' ),
					'sanitize_callback'	 => 'emulsion_gutenberg_render_layout_support_flag_validate',
					'type'				 => 'radio',
					'choices'			 => array(
						'disable'	 => esc_html__( 'Use Theme Features', 'emulsion' ),
						'enable'	 => esc_html__( 'Use Gutenberg features', 'emulsion' ),
					),
				),
				'emulsion_render_elements_support'					 => array(
					'section'			 => 'emulsion_editor',
					'default'			 => 'disable',
					'label'				 => esc_html__( 'Elements styles block support.', 'emulsion' ),
					'description'		 => esc_html__( 'link style gutenberg use Class wp-elements-XXXXXXXXXXXX, theme use Class has-[preset color name]-link-color', 'emulsion' ),
					'sanitize_callback'	 => 'emulsion_render_elements_support_validate',
					'type'				 => 'radio',
					'choices'			 => array(
						'disable'	 => esc_html__( 'Use Theme Features', 'emulsion' ),
						'enable'	 => esc_html__( 'Use Gutenberg features', 'emulsion' ),
					),
				),
				'emulsion_custom_css_support'						 => array(
					'section'			 => 'emulsion_editor',
					'default'			 => 'disable',
					'label'				 => esc_html__( 'Site Editor with Custom CSS.', 'emulsion' ),
					'description'		 => esc_html__( 'If enabled, include one of the body classes (is-presentation-fse, is-presentation-transitional, is-presentation-theme) in the CSS ruleset.', 'emulsion' ),
					'sanitize_callback'	 => 'emulsion_custom_css_support_validate',
					'type'				 => 'radio',
					'choices'			 => array(
						'disable'	 => esc_html__( 'Disabled', 'emulsion' ),
						'enable'	 => esc_html__( 'Enabled', 'emulsion' ),
					),
				),
				'emulsion_core_block_patterns_support'				 => array(
					'section'			 => 'emulsion_editor',
					'default'			 => 'disable',
					'label'				 => esc_html__( 'Core Block Patterns.', 'emulsion' ),
					'description'		 => esc_html__( 'If enabled,Show the core block pattern. However, the specified external pattern is no longer available in theme.json.', 'emulsion' ),
					'sanitize_callback'	 => 'emulsion_core_block_patterns_support_validate',
					'type'				 => 'radio',
					'choices'			 => array(
						'disable'	 => esc_html__( 'Disabled', 'emulsion' ),
						'enable'	 => esc_html__( 'Enabled', 'emulsion' ),
					),
				),
				'emulsion_dark_mode_support'						 => array(
					'section'			 => 'emulsion_editor',
					'default'			 => 'disable',
					'label'				 => esc_html__( 'Dark Mode.', 'emulsion' ),
					'description'		 => esc_html__( 'Reflect your PC dark mode settings', 'emulsion' ),
					'sanitize_callback'	 => 'emulsion_dark_mode_support_validate',
					'type'				 => 'radio',
					'choices'			 => array(
						'disable'	 => esc_html__( 'Disabled', 'emulsion' ),
						'enable'	 => esc_html__( 'Enabled', 'emulsion' ),
					),
				),
			);
		}


		/**
		 * Theme customize settings
		 */
		set_theme_mod( 'emulsion_scheme', 'default' );

		set_theme_mod( 'emulsion_dark_mode_support', emulsion_dark_mode_support_validate( $emulsion_theme_mod_args['emulsion_dark_mode_support']['default'] ) );
		set_theme_mod( 'emulsion_editor_support', emulsion_editor_support_validate( $emulsion_theme_mod_args['emulsion_editor_support']['default'] ) );
		//set_theme_mod( 'emulsion_header_template', emulsion_header_template_validate( $emulsion_theme_mod_args['emulsion_header_template']['default'] ) );
		//set_theme_mod( 'emulsion_footer_template', emulsion_footer_template_validate( $emulsion_theme_mod_args['emulsion_footer_template']['default'] ) );
		set_theme_mod( 'emulsion_should_load_separate_core_block_assets', emulsion_should_load_separate_core_block_assets_validate( $emulsion_theme_mod_args['emulsion_should_load_separate_core_block_assets']['default'] ) );
		set_theme_mod( 'emulsion_gutenberg_render_layout_support_flag', emulsion_gutenberg_render_layout_support_flag_validate( $emulsion_theme_mod_args['emulsion_gutenberg_render_layout_support_flag']['default'] ) );
		set_theme_mod( 'emulsion_render_elements_support', emulsion_render_elements_support_validate( $emulsion_theme_mod_args['emulsion_render_elements_support']['default'] ) );

		/**
		 * layout grid steam is dinamicaly set emulsion_add_supports()
		 * need to add the default settings separately.
		 */
		$emulsion_layout_homepage			 = emulsion_get_var( 'emulsion_layout_homepage', 'default' );
		$emulsion_layout_posts_page			 = emulsion_get_var( 'emulsion_layout_posts_page', 'default' );
		$emulsion_layout_date_archives		 = emulsion_get_var( 'emulsion_layout_date_archives', 'default' );
		$emulsion_layout_category_archives	 = emulsion_get_var( 'emulsion_layout_category_archives', 'default' );
		$emulsion_layout_tag_archives		 = emulsion_get_var( 'emulsion_layout_tag_archives', 'default' );
		$emulsion_layout_author_archives	 = emulsion_get_var( 'emulsion_layout_author_archives', 'default' );

		/**
		 * needs default setting
		 */
		set_theme_mod( 'emulsion_layout_homepage', $emulsion_layout_homepage );
		set_theme_mod( 'emulsion_layout_posts_page', $emulsion_layout_posts_page );
		set_theme_mod( 'emulsion_layout_date_archives', $emulsion_layout_date_archives );
		set_theme_mod( 'emulsion_layout_category_archives', $emulsion_layout_category_archives );
		set_theme_mod( 'emulsion_layout_tag_archives', $emulsion_layout_tag_archives );
		set_theme_mod( 'emulsion_layout_author_archives', $emulsion_layout_author_archives );

		$emulsion_default_background_color = get_theme_support( 'custom-background', 'default-color' );

		/**
		 * reset background color, background image
		 */
		set_theme_mod( 'background_color', $emulsion_default_background_color );
		set_theme_mod( 'emulsion_primary_menu_background', $emulsion_default_background_color );
		set_theme_mod( 'emulsion_sidebar_background', $emulsion_default_background_color );

		//$emulsion_default_header_textcolor_color = str_replace( '#', '', emulsion_header_text_color_reset() );
		set_theme_mod( 'header_textcolor', null );

		foreach ( $emulsion_customize_args as $name => $val ) {

			remove_theme_mod( $name );
		}
		if ( false !== get_theme_mod( 'emulsion__css_variables' ) ) {

			remove_theme_mod( 'emulsion__css_variables' );
		}
		$emulsion_custom_background_defaults_image = get_theme_support( 'custom-background', 'default-image' );

		if ( ! empty( $emulsion_custom_background_defaults_image ) ) {

			set_theme_mod( 'background_image', $emulsion_custom_background_defaults_image );
			set_theme_mod( 'background_image_thumb', $emulsion_custom_background_defaults_image );
		}

		/**
		 * keep user setting
		 */
		if ( ! empty( $favorite_color_palette ) ) {
			set_theme_mod( 'emulsion_favorite_color_palette', $favorite_color_palette );
		}

		set_theme_mod( 'emulsion_reset_theme_settings', 'continue' );
	}

}

if ( ! function_exists( 'emulsion_bg_img_display_hide_post_editor' ) ) {

	function emulsion_bg_img_display_hide_post_editor( $url ) {

		$post_id = get_the_ID();

		$post_meta_setting_post	 = get_post_meta( $post_id, 'emulsion_post_background_image', true );
		$post_meta_setting_page	 = get_post_meta( $post_id, 'emulsion_page_background_image', true );

		if ( 'no_background' == $post_meta_setting_post || 'no_background' == $post_meta_setting_page ) {

			add_filter( 'theme_mod_background_image', '__return_false' );
			add_filter( 'emulsion_custom_background_cb', '__return_false' );
			//add_filter( 'body_class', 'emulsion_remove_background_img_class' );
		}
		return $url;
	}

}



if ( ! function_exists( 'emulsion_link_color_filter' ) ) {

//	add_filter( 'emulsion_link_color', 'emulsion_link_color_filter' );

	/**
	 * Reflect when a color different from the default color is set in the customizer
	 * @param type $color
	 * @return type
	 */
	function emulsion_link_color_filter( $color ) {

		$current_value	 = get_theme_mod( 'emulsion_general_link_color', emulsion_get_var( 'emulsion_general_link_color' ) );
		$default_value	 = emulsion_get_var( 'emulsion_general_link_color', 'default' );

		if ( $current_value !== $default_value ) {

			return $current_value;
		}

		return $color;
	}

}
/*
if ( ! function_exists( 'emulsion_hover_color_filter' ) ) {

	function emulsion_hover_color_filter( $color ) {

		if ( ! is_customize_preview() ) {

			return $color;
		}

		$current_value	 = get_theme_mod( 'emulsion_general_link_hover_color', emulsion_get_var( 'emulsion_general_link_hover_color' ) );
		$default_value	 = emulsion_get_var( 'emulsion_general_link_hover_color', 'default' );

		if ( $current_value !== $default_value ) {

			return $current_value;
		}

		return $color;
	}

}
*/
if ( ! function_exists( 'emulsion_add_woocommerce_class_to_post' ) ) {

	/**
	 * If woocommerce content exists, add class to post_class ()
	 * @global type $post
	 * @param type $classes
	 * @return string
	 */
	function emulsion_add_woocommerce_class_to_post( $classes ) {
		global $post;

		$block_classes = array( 'wc-block', 'wp-block-woocommerce' );

		foreach ( $block_classes as $class ) {
			if ( preg_match( '/' . $class . '/', $post->post_content ) ) {
				$classes[]	 = 'has-wc-block';
				$classes[]	 = 'has-wc';
				return $classes;
			}
		}

		$shortcodes = array( 'product', 'products', 'product_attribute',
			'product_category', 'product_categories', 'recent_products',
			'featured_products', 'sale_products', 'best_selling_products',
			'top_rated_products' );

		foreach ( $shortcodes as $tag ) {
			if ( has_shortcode( $post->post_content, $tag ) ) {
				$classes[]	 = 'has-wc-shotcode';
				$classes[]	 = 'has-wc';
				break;
			}
		}
		return $classes;
	}

}
if ( ! function_exists( 'emulsion_customizer_is_changed' ) ) {

	/**
	 * if customizer saved emulsion_customizer_is_changed value change 'no' to 'yes'
	 * @see emulsion_get_css_variables_values()
	 */
	function emulsion_customizer_is_changed() {

		set_theme_mod( 'emulsion_customizer_is_changed', 'yes' );
	}

}

if ( ! function_exists( 'emulsion_php_version_notice' ) ) {

	/**
	 * PHP version notice when theme activate
	 */
	function emulsion_php_version_notice() {

		printf( '<div class="%1$s"><p>%2$s<br />%3$s</p></div>', 'notice notice-error is_dismissable', esc_html__( 'You need to update your PHP version to run this theme.', 'emulsion-addons' ), sprintf(
						/* translators: 1: PHP_VERSION 2: EMULSION_MIN_PHP_VERSION */
						esc_html__( 'Actual version is: %1$s, required version is: %2$s', 'emulsion-addons' ), esc_html( PHP_VERSION ), esc_html( EMULSION_MIN_PHP_VERSION )
				)
		);
	}

}


if ( ! function_exists( 'emulsion_get_footer_cols' ) ) {

	/**
	 * Get number of columns in footer widget area
	 * @return boolean
	 */
	function emulsion_get_footer_cols() {

		$footer_col = emulsion_get_supports( 'footer' );

		if ( is_array( $footer_col ) ) {

			foreach ( $footer_col[0] as $key => $value ) {
				if ( 'cols' == $key ) {
					return $value;
				}
			}
		}
		return false;
	}

}

if ( ! function_exists( 'emulsion_theme_info' ) ) {

	/**
	 * Get theme infomation.
	 */
	function emulsion_theme_info( $info, $echo = true ) {

		$emulsion_current_data = wp_get_theme();

		if ( strcasecmp( $info, 'ThemeURI' ) == 0 ) {

			$emulsion_current_data_theme_uri = apply_filters( 'emulsion_theme_url', $emulsion_current_data->get( 'ThemeURI' ) );

			if ( $echo == true ) {

				echo wp_http_validate_url( $emulsion_current_data_theme_uri );
			} else {

				return wp_http_validate_url( $emulsion_current_data_theme_uri );
			}
		}
		if ( strcasecmp( $info, 'AuthorURI' ) == 0 ) {

			$emulsion_current_data_author_uri = apply_filters( 'emulsion_author_url', $emulsion_current_data->get( 'AuthorURI' ) );

			if ( $echo == true ) {

				echo wp_http_validate_url( $emulsion_current_data_author_uri );
			} else {

				return wp_http_validate_url( $emulsion_current_data_author_uri );
			}
		}
		if ( strcasecmp( $info, 'Version' ) == 0 ) {

			$emulsion_current_data_version = $emulsion_current_data->get( 'Version' );

			if ( is_child_theme() ) {

				/**
				 * If you are using child theme, version queries may remain unchanged
				 * when parent themes are updated, sometimes cached
				 */
				$emulsion_this_parent_theme		 = wp_get_theme( get_template() );
				$emulsion_current_data_version	 = $emulsion_this_parent_theme->get( 'Version' ) .
						'-' . $emulsion_current_data_version;
			}

			if ( $echo == true ) {

				echo sanitize_text_field( $emulsion_current_data_version );
			} else {

				return sanitize_text_field( $emulsion_current_data_version );
			}
		}
		if ( strcasecmp( $info, 'Name' ) == 0 ) {

			$emulsion_current_theme_name = $emulsion_current_data->get( 'Name' );

			if ( $echo == true ) {

				echo sanitize_text_field( $emulsion_current_theme_name );
			} else {

				return sanitize_text_field( $emulsion_current_theme_name );
			}
		}
		if ( strcasecmp( $info, 'Slug' ) == 0 ) {

			$emulsion_current_theme_name = $emulsion_current_data->get( 'Name' );
			$emulsion_current_theme_slug = sanitize_title_with_dashes( $emulsion_current_theme_name );

			if ( $echo == true ) {

				echo $emulsion_current_theme_slug;
			} else {

				return $emulsion_current_theme_slug;
			}
		}
		if ( strcasecmp( $info, 'TextDomain' ) == 0 ) {

			$emulsion_text_domain	 = $emulsion_current_data->get( 'TextDomain' );
			$result					 = $emulsion_text_domain;

			if ( $echo == true ) {

				echo sanitize_text_field( $emulsion_text_domain );
			} else {

				return sanitize_text_field( $emulsion_text_domain );
			}
		}

		if ( is_child_theme() ) {

			$emulsion_parent_data = wp_get_theme( get_template() );

			if ( strcasecmp( $info, 'parentName' ) == 0 ) {

				$emulsion_parent_theme_name = $emulsion_parent_data->get( 'Name' );

				if ( $echo == true ) {

					echo sanitize_text_field( $emulsion_parent_theme_name );
				} else {

					return sanitize_text_field( $emulsion_parent_theme_name );
				}
			}
			if ( strcasecmp( $info, 'parentSlug' ) == 0 ) {

				$emulsion_parent_theme_name	 = $emulsion_parent_data->get( 'Name' );
				$result						 = sanitize_title_with_dashes( $emulsion_parent_theme_name );

				if ( $echo == true ) {
					echo sanitize_text_field( $emulsion_parent_theme_name );
				} else {
					return sanitize_text_field( $emulsion_parent_theme_name );
				}
			}
		}
		return false;
	}

}

if ( ! function_exists( 'emulsion_amp_css' ) ) {

	function emulsion_amp_css() {
		// removed function
		return '';
	}

}


/**
 * AMP plugin setting
 */

add_filter( 'emulsion_template_pre', 'emulsion_amp_setting' );

function emulsion_amp_enqueue_script() {

	$emulsion_current_data_version = null;

	if ( is_user_logged_in() ) {

		$emulsion_current_data_version = emulsion_version();
	}

	if ( emulsion_is_amp() ) {

		$post_id = get_the_ID();

		$amp_options = get_option( 'amp-options' );
		$amp_support = $amp_options['theme_support'];

		if ( 'standard' == $amp_support && 'theme' !== get_theme_mod( 'emulsion_editor_support' ) ) {
			if ( false == wp_style_is( 'emulsion-fse' ) && 'fse' == get_theme_mod( 'emulsion_editor_support' ) ) {

				wp_register_style( 'emulsion-fse', get_template_directory_uri() . '/css/fse.css', array(), $emulsion_current_data_version, 'all' );
				wp_enqueue_style( 'emulsion-fse' );
			}
			if ( false == wp_style_is( 'emulsion-fse-transitional' ) && 'transitional' == get_theme_mod( 'emulsion_editor_support' ) ) {

				wp_register_style( 'emulsion-fse-transitional', get_template_directory_uri() . '/css/fse-transitional.css', array(), $emulsion_current_data_version, 'all' );
				wp_enqueue_style( 'emulsion-fse-transitional' );

				if ( 'available' !== filter_input( INPUT_GET, 'noamp', FILTER_SANITIZE_SPECIAL_CHARS ) ) {

				}
			}
		} else {
			if ( ! is_singular() ||
					is_singular() && ! empty( $post_id ) && 'no_style' !== get_post_meta( $post_id, 'emulsion_post_theme_style_script', true )
			) {

				if ( false == wp_style_is( 'amp-reader' ) ) {
					wp_register_style( 'amp-reader', get_template_directory_uri() . '/css/amp.css', array(), $emulsion_current_data_version, 'all' );
					wp_enqueue_style( 'amp-reader' );
				}
			}
		}

		return;
	}
}

function emulsion_amp_setting() {

	if ( emulsion_is_amp() ) {

		if ( function_exists( 'emulsion_amp_exclude_supports' ) ) {

			$remove_supports = emulsion_amp_excludes();

			foreach ( $remove_supports as $remove ) {

				emulsion_remove_supports( $remove );
			}
		} else {

			emulsion_remove_supports( 'enqueue' );
			emulsion_remove_supports( 'search_drawer' );
			emulsion_remove_supports( 'primary_menu' );
			emulsion_remove_supports( 'sidebar' );
			emulsion_remove_supports( 'sidebar_page' );
			emulsion_remove_supports( 'title_in_page_header' );
			//add_filter('post_thumbnail_html','__return_empty_string');
			emulsion_remove_supports( 'instantclick' );
			emulsion_remove_supports( 'toc' );
			emulsion_remove_supports( 'tooltip' );
		}
	}
}

//add_action( 'wp_enqueue_scripts', 'emulsion_setup_styles' );

function emulsion_setup_styles() {
	/**
	 * Google fonts
	 */
	$emulsion_common_google_font_url = '';

	$emulsion_common_google_font_url = esc_url( get_theme_mod( 'emulsion_common_google_font_url', emulsion_get_var( 'emulsion_common_google_font_url' ) ) );

	if ( ! empty( $emulsion_common_google_font_url ) && false == wp_style_is( 'emulsion-common-google-font' ) ) {

		wp_register_style( 'emulsion-common-google-font', $emulsion_common_google_font_url, array( 'emulsion' ), null, 'all' );
		wp_enqueue_style( 'emulsion-common-google-font' );
	}

	$emulsion_heading_google_font_url = esc_url( get_theme_mod( 'emulsion_heading_google_font_url', emulsion_get_var( 'emulsion_heading_google_font_url' ) ) );

	if ( ! empty( $emulsion_heading_google_font_url ) && false == wp_style_is( 'emulsion-heading-google-font' ) ) {

		wp_register_style( 'emulsion-heading-google-font', $emulsion_heading_google_font_url, array( 'emulsion' ), null, 'all' );
		wp_enqueue_style( 'emulsion-heading-google-font' );
	}

	$emulsion_widget_meta_google_font_url = esc_url( get_theme_mod( 'emulsion_widget_meta_google_font_url', emulsion_get_var( 'emulsion_widget_meta_google_font_url' ) ) );

	if ( ! empty( $emulsion_widget_meta_google_font_url ) && false == wp_style_is( 'emulsion-widget-meta-google-font' ) ) {

		wp_register_style( 'emulsion-widget-meta-google-font', $emulsion_widget_meta_google_font_url, array( 'emulsion' ), null, 'all' );
		wp_enqueue_style( 'emulsion-widget-meta-google-font' );
	}
}
