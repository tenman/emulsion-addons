<?php
function emulsion_plugin_info( $info, $echo = true ) {
	
	if( ! function_exists('get_plugin_data') ){
		
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

	$templates = array();
	$name      = (string) $name;
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

function emulsion_locate_file( $template_names, $load = false, $require_once = true ) {
	$located = '';
	foreach ( (array) $template_names as $template_name ) {
		if ( ! $template_name ) {
			continue;
		}
		if ( file_exists( emulsion_plugin_info('PluginROOT',false) . $template_name ) ) {
			$located = emulsion_plugin_info('PluginROOT',false) . $template_name;
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
			$val	 = false === $val ? esc_html__( 'Not Yet Customized', 'emulsion' ) : trim( $val, "'" );
			$filter	 = has_filter( 'theme_mod_' . $key ) ? esc_html__( 'Detected', 'emulsion' ) . ' theme_mod_' . $key : esc_html__( 'Not used', 'emulsion' );
			$default = emulsion_get_var( $key, 'default' );


			printf( '<dl><dt class="mod-name">%1$s</dt><dd class="default-value">%5$s %2$s</dd><dd class="current-value">%6$s %3$s</dd><dd class="has-filter">%7$s %4$s</dd></dl>',
					wp_kses($key,array()),
					wp_kses($default,array()),
					wp_kses($val,array()),
					wp_kses($filter,array()),
					esc_html__('Default:', 'emulsion'),
					esc_html__('Current val:','emulsion'),
					esc_html__('Filter:','emulsion') );
		}
	}
}

/**
 * Theme Body Class
 */
if ( ! function_exists( 'emulsion_body_class' ) ) {

	/**
	 * Theme body class
	 * @global type $_wp_theme_features
	 * @param type $classes
	 * @return array;
	 */
	function emulsion_body_class( $classes ) {
		global $_wp_theme_features;

		$metabox_flag = false;

		if ( is_page()  && false == emulsion_metabox_display_control( 'page_style' ) ) {

			$classes[]		 = 'metabox-removed-emulsion-presentation';
			$metabox_flag	 = true;
			return $classes;
		}
		if ( is_single() && false == emulsion_metabox_display_control( 'style' ) ) {

			$classes[]		 = 'metabox-removed-emulsion-presentation';
			$metabox_flag	 = true;
			return $classes;
		}
		if ( ! emulsion_get_supports( 'enqueue' ) ) {

			$classes[]		 = 'removed-emulsion-presentation';
			$metabox_flag	 = true;
			return $classes;
		}

		$classes[] = 'noscript';
		
		unset( $classes['emulsion'] );
		
		$classes[] = sanitize_html_class( emulsion_plugin_info( 'Slug', false ) );

		if ( is_singular() ) {

			$post_id = get_the_ID();

			$classes[] = 'no_bg' === get_post_meta( $post_id, 'emulsion_page_theme_style_script', true ) ? 'metabox-reset-page-presentation': '';
			$classes[] = 'no_bg' === get_post_meta( $post_id, 'emulsion_post_theme_style_script', true ) ? 'metabox-reset-post-presentation':'';
			$classes[] = 'no_menu' === get_post_meta( $post_id, 'emulsion_post_primary_menu', true ) ? 'metabox-removed-post-menu': '';
			$classes[] = 'no_menu' === get_post_meta( $post_id, 'emulsion_page_primary_menu', true ) ? 'metabox-removed-page-menu': '';
			$classes[] = 'is-singular';

		} else {

			switch ( false ) {
				case is_404():
					$classes[] = 'is-loop';
					break;
			}
		}

		if ( is_page() ) {

			unset( $classes['emulsion-no-sidebar'] );
			unset( $classes['emulsion-has-sidebar'] );
			
			$sidebar_condition		 = get_theme_mod( 'emulsion_condition_display_page_sidebar', emulsion_get_var( 'emulsion_condition_display_page_sidebar' ) );
			$logged_in				 = 'logged_in_user' == $sidebar_condition && ! is_user_logged_in() ? false : true;						
			$metabox_page_control	 = emulsion_metabox_display_control( 'page_sidebar' );
			

			$classes[] = is_active_sidebar( 'sidebar-3' ) && 
						emulsion_get_supports( 'sidebar_page' ) &&
						$logged_in &&
						$metabox_page_control ? 'emulsion-has-sidebar': 'emulsion-no-sidebar';
		} else {

			unset( $classes['emulsion-no-sidebar'] );
			unset( $classes['emulsion-has-sidebar'] );
							
				$sidebar_condition		 = get_theme_mod( 'emulsion_condition_display_posts_sidebar', emulsion_get_var( 'emulsion_condition_display_posts_sidebar' ) );
			
			
			$logged_in				 = 'logged_in_user' == $sidebar_condition && ! is_user_logged_in() ? false : true;
			$metabox_post_control	 = emulsion_metabox_display_control( 'sidebar' );

			$classes[] = is_active_sidebar( 'sidebar-1' ) &&
					emulsion_get_supports( 'sidebar' ) &&
					$logged_in &&
					$metabox_post_control ? 'emulsion-has-sidebar' : 'emulsion-no-sidebar';
		}
		
		$title_in_header = get_theme_mod( "emulsion_title_in_header", emulsion_get_var( 'emulsion_title_in_header' ) );

		if ( 'yes' == $title_in_header ) {

			$classes[] = 'emulsion-header-has-title';
		}
		if ( 'no' == $title_in_header ) {

			$classes[] = 'emulsion-layout-has-title';
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
		 * Custom background image
		 */
		$page_bg_image_url = get_background_image();
		$supports_background = emulsion_get_supports( 'background' );
		
		$has_background_img_relate_color = get_theme_mod( 'emulsion_bg_image_text' );
		if ( ! empty( $page_bg_image_url ) && $supports_background ) {

			$classes[]	 = 'emulsion-has-custom-background-image';
			$classes[]	 = 'white' === $has_background_img_relate_color ? 'has-background-img-text-white' : '';
		}

		/**
		 * Current Page layout type
		 */
		if ( is_customize_preview() ) {

			$layout_type = emulsion_customizer_have_posts_class_helper();
			$classes[]	 = 'layout-' . sanitize_html_class( $layout_type );
		} else {

			$layout_type = emulsion_current_layout_type();
			$classes[]	 = 'layout-' . sanitize_html_class( $layout_type );
		}

		/**
		 * Content type
		 */
		$content_type		 = emulsion_content_type();
		$classes[]			 = sanitize_html_class( $content_type );

		/**
		 * Font family class
		 */
		
			$heading_font_family = get_theme_mod( 'emulsion_heading_font_family', emulsion_get_var( 'emulsion_heading_font_family' ) );
			$classes[]			 = sanitize_html_class( 'font-heading-' . $heading_font_family );

			$common_font_family	 = emulsion_get_css_variables_values( 'common_font_family' );
			$classes[]			 = sanitize_html_class( 'font-common-' . $common_font_family );

		/**
		 * Category Colors
		 */
		
		if (  'enable' == get_theme_mod( 'emulsion_category_colors', emulsion_get_var( 'emulsion_category_colors' ) ) ) {

			$classes[] = 'has-category-colors';
		} else {

			$classes[] = 'disable-category-colors';
		}
		if ( emulsion_get_supports( 'background_css_pattern' ) ) {

			$background_css_pattern_class	 = get_theme_mod( 'emulsion_background_css_pattern', emulsion_get_var( 'emulsion_background_css_pattern' ) );
			$class_name						 = sanitize_html_class( 'background-css-pattern-' . $background_css_pattern_class );
			$classes[]						 = 'none' !== $background_css_pattern_class ? $class_name : '';
		}

		return array_filter( $classes );// remove empty class
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

		$favorite_color_palette = '';
		$favorite_color_palette = get_theme_mod( 'emulsion_favorite_color_palette', emulsion_get_var( 'emulsion_favorite_color_palette' ) );

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

		$emulsion_default_header_textcolor_color = str_replace( '#', '', emulsion_header_text_color_reset() );
		set_theme_mod( 'header_textcolor', $emulsion_default_header_textcolor_color );

		foreach ( $emulsion_customize_args as $name => $val ) {

			remove_theme_mod( $name );
		}

		$emulsion_custom_background_defaults_image = emulsion_get_supports( 'background' )[0]['default']['default-image'];
		set_theme_mod( 'background_image', $emulsion_custom_background_defaults_image );
		set_theme_mod( 'background_image_thumb', $emulsion_custom_background_defaults_image );


		/**
		 * keep user setting
		 */
		if ( ! empty( $favorite_color_palette ) ) {
			set_theme_mod( 'emulsion_favorite_color_palette', $favorite_color_palette );
		}


		set_theme_mod( 'emulsion_reset_theme_settings', 'continue' );
	}

}

add_filter('emulsion_customizer_have_posts_class_helper', 'emulsion_addons_customizer_have_posts_class_helper');

if ( ! function_exists( 'emulsion_addons_customizer_have_posts_class_helper' ) ) {

	/**
	 * If the displayed page is grid layout or stream layout, grid or stream are return
	 * @return type
	 */

	function emulsion_addons_customizer_have_posts_class_helper() {
		
		if ( emulsion_is_posts_page() ) {

			return get_theme_mod( 'emulsion_layout_posts_page', emulsion_get_var( 'emulsion_layout_posts_page' ) );
		} elseif ( is_home() ) {

			return get_theme_mod( 'emulsion_layout_homepage', emulsion_get_var( 'emulsion_layout_homepage' ) );
		}
		if ( is_date() ) {

			return get_theme_mod( 'emulsion_layout_date_archives', emulsion_get_var( 'emulsion_layout_date_archives' ) );
		}
		if ( is_category() ) {

			return get_theme_mod( 'emulsion_layout_category_archives', emulsion_get_var( 'emulsion_layout_category_archives' ) );
		}
		if ( is_tag() ) {

			return get_theme_mod( 'emulsion_layout_tag_archives', emulsion_get_var( 'emulsion_layout_tag_archives' ) );
		}
		if ( is_author() ) {

			return get_theme_mod( 'emulsion_layout_author_archives', emulsion_get_var( 'emulsion_layout_author_archives' ) );
		}

		return false;
	}

}
if ( ! function_exists( 'emulsion_sectionized_class' ) ) {

	/**
	 * wp-block-gallery, wp-block-columns, wp-block-media-text
	 * Customizer You can set the background color from the post settings.
	 * Add a class that determines the tendency of this background color
	 */
	function emulsion_sectionized_class( $block = '' ) {

		if ( 'columns' == $block ) {

			$background			 = get_theme_mod( 'emulsion_block_columns_section_bg', false );
			$background_default	 = emulsion_theme_default_val( 'emulsion_block_columns_section_bg' );

			if ( $background_default == $background ) {
				
				return 'is-default';
			}
			
			if ( ! empty( $background ) ) {

				$text_color = emulsion_contrast_color( $background );

				if ( '#ffffff' == $text_color ) {

					$emulsion_brightnes = 'is-dark';
				}
				if ( '#333333' == $text_color ) {

					$emulsion_brightnes = 'is-light';
				}

				return $emulsion_brightnes;
			}
		}
		
		if ( 'media_text' == $block ) {
			
			$background			 = get_theme_mod( 'emulsion_block_media_text_section_bg', false );
			$background_default	 = emulsion_theme_default_val( 'emulsion_block_media_text_section_bg' );

			if ( $background_default == $background ) {
				
				return 'is-default';
			}
			if ( ! empty( $background ) ) {

				$text_color = emulsion_contrast_color( $background );

				if ( '#ffffff' == $text_color ) {

					$emulsion_brightnes = 'is-dark';
				}
				if ( '#333333' == $text_color ) {

					$emulsion_brightnes = 'is-light';
				}

				return $emulsion_brightnes;
			}
		}
		if ( 'gallery' == $block ) {
			
			$background			 = get_theme_mod( 'emulsion_block_gallery_section_bg', false );
			$background_default	 = emulsion_theme_default_val( 'emulsion_block_gallery_section_bg' );

			if ( $background_default == $background ) {
				return 'is-default';
			}
			
			if ( ! empty( $background ) ) {

				$text_color = emulsion_contrast_color( $background );

				if ( '#ffffff' == $text_color ) {

					$emulsion_brightnes = 'is-dark';
				}
				if ( '#333333' == $text_color ) {

					$emulsion_brightnes = 'is-light';
				}

				return $emulsion_brightnes;
			}
		}
		return false;
	}

}
if ( ! function_exists( 'emulsion_custom_background_cb' ) ) {

	/**
	 * Differences from the core function
	 * Change background image to multiple background
	 * filter add emulsion_custom_background_cb
	 */
	function emulsion_custom_background_cb() {

		if ( ! is_user_logged_in() && false !== ( $result = get_transient( 'emulsion_custom_background_cb' ) ) ) {

			echo wp_kses( $result, array( 'style' => array( 'id' => true, 'class' => true, 'type' => true ) ) );
		}

		// $background is the saved custom image, or the default image.
		$background = set_url_scheme( get_background_image() );
		
		// $color is the saved custom color.
		// A default has to be specified in style.css. It will not be printed here.
		$color = get_background_color();

		if ( $color === get_theme_support( 'custom-background', 'default-color' ) ) {
			$color = false;
		}

		$type_attr = current_theme_supports( 'html5', 'style' ) ? '' : ' type="text/css"';

		if ( empty( $background ) && empty( $color ) ) {

			if ( is_customize_preview() ) {
				printf( '<style%s id="custom-background-css"></style>', wp_kses( $type_attr, array() ) );
			}
			return;
		}

		$style = $color ? "background-color: #$color;" : '';

		if ( $background || ! empty( $style ) ) {

			$image = ' background-image:linear-gradient(var(--thm_background_image_dim), var(--thm_background_image_dim)), url("' . esc_url_raw( $background ) . '");';

			// Background Position.
			$position_x	 = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
			$position_y	 = get_theme_mod( 'background_position_y', get_theme_support( 'custom-background', 'default-position-y' ) );

			if ( ! in_array( $position_x, array( 'left', 'center', 'right' ), true ) ) {
				$position_x = 'left';
			}

			if ( ! in_array( $position_y, array( 'top', 'center', 'bottom' ), true ) ) {
				$position_y = 'top';
			}

			$position = " background-position: $position_x $position_y;";

			// Background Size.
			$size = get_theme_mod( 'background_size', get_theme_support( 'custom-background', 'default-size' ) );

			if ( ! in_array( $size, array( 'auto', 'contain', 'cover' ), true ) ) {
				$size = 'auto';
			}

			$size = " background-size: $size ! important;";

			// Background Repeat.
			$repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );

			if ( ! in_array( $repeat, array( 'repeat-x', 'repeat-y', 'repeat', 'no-repeat' ), true ) ) {
				$repeat = 'repeat';
			}

			$repeat = " background-repeat: $repeat;";

			// Background Scroll.
			$attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );

			if ( 'fixed' !== $attachment ) {
				$attachment = 'scroll';
			}

			$attachment = " background-attachment: $attachment;";

			$style		 .= $image . $position . $size . $repeat . $attachment;
			/**
			 * The CSS specificity is related to the custom background pattern. ( Customizer setting color )
			 */
			$rule_set	 = sprintf( ' html body.single-post.custom-background.emulsion-has-custom-background-image, html body.page.custom-background.emulsion-has-custom-background-image  { %1$s }', $style );

			$rule_set = apply_filters( 'emulsion_custom_background_cb', $rule_set, $image, $position, $size, $repeat, $attachment );

			if ( ! empty( $rule_set ) && ! empty( $background ) ) {
				$result = sprintf( '<style%1$s id="custom-background-css" class="emulsion-callback-css">%2$s</style>', wp_kses( $type_attr, array() ), emulsion_remove_spaces_from_css( $rule_set ) );

				set_transient( 'emulsion_custom_background_cb', $result, 24 * HOUR_IN_SECONDS );

				echo wp_kses( $result, array( 'style' => array( 'id' => true, 'class' => true, 'type' => true ) ) );
			}
		}
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
			add_filter( 'body_class', 'emulsion_remove_background_img_class' );
		}
		return $url;
	}

}

if ( ! function_exists( 'emulsion_remove_custom_background_class' ) ) {

	/**
	 * If you reset the theme color in the Editor menu, the state will not come out of a custom-background
	 */
	function emulsion_remove_custom_background_class( $classes ) {

		$post_id = get_the_ID();

		if ( is_singular() && 'no_bg' == get_post_meta( $post_id, 'emulsion_post_theme_style_script', true ) ) {

			foreach ( $classes as $key => $value ) {
				if ( $value == 'custom-background' )
					unset( $classes[$key] );
			}
			return $classes;
		}

		return $classes;
	}

}
if ( ! function_exists( 'emulsion_remove_background_img_class' ) ) {

	/**
	 * background image relate function
	 * Delete class related to background image when filter theme_mod_background_image return empty
	 * @param type $classes
	 * @return type
	 */
	function emulsion_remove_background_img_class( $classes ) {

		foreach ( $classes as $key => $value ) {
			if ( $value == 'emulsion-has-custom-background-image' )
				unset( $classes[$key] );
		}
		return $classes;
	}

}
if ( ! function_exists( 'emulsion_link_color_filter' ) ) {

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
if ( ! function_exists( 'emulsion_hover_color_filter' ) ) {

	function emulsion_hover_color_filter( $color ) {
		/**
		 * apply customizer setting value
		 * Reflect when a color different from the default color is set in the customizer
		 */
		$current_value	 = get_theme_mod( 'emulsion_general_link_hover_color', emulsion_get_var( 'emulsion_general_link_hover_color' ) );
		$default_value	 = emulsion_get_var( 'emulsion_general_link_hover_color', 'default' );

		if ( $current_value !== $default_value ) {

			return $current_value;
		}

		return $color;
	}

}
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
if ( ! function_exists( 'emulsion_content_type' ) ) {

	/**
	 * return page is full text or excerpt
	 * grid, stream return false
	 */
	function emulsion_content_type() {
		global $post;

		if ( is_singular() || ! function_exists('emulsion_get_var') ) {

			return 'full_text';
		} else {
					

			switch ( true ) {
				case emulsion_is_posts_page():

					$setting_value = get_theme_mod( 'emulsion_layout_posts_page', emulsion_get_var( 'emulsion_layout_posts_page' ) );

					if ( 'full_text' == $setting_value || 'excerpt' == $setting_value ) {

						return $setting_value;
					}
					break;
				case is_home():

					$setting_value = get_theme_mod( 'emulsion_layout_homepage', emulsion_get_var( 'emulsion_layout_homepage' ) );

					if ( 'full_text' == $setting_value || 'excerpt' == $setting_value ) {

						return $setting_value;
					}
					break;
				case is_date():

					$setting_value = get_theme_mod( 'emulsion_layout_date_archives', emulsion_get_var( 'emulsion_layout_date_archives' ) );

					if ( 'full_text' == $setting_value || 'excerpt' == $setting_value ) {

						return $setting_value;
					}
					break;
				case is_category():

					$setting_value = get_theme_mod( 'emulsion_layout_category_archives', emulsion_get_var( 'emulsion_layout_category_archives' ) );

					if ( 'full_text' == $setting_value || 'excerpt' == $setting_value ) {

						return $setting_value;
					}
					break;
				case is_tag():

					$setting_value = get_theme_mod( 'emulsion_layout_tag_archives', emulsion_get_var( 'emulsion_layout_tag_archives' ) );

					if ( 'full_text' == $setting_value || 'excerpt' == $setting_value ) {

						return $setting_value;
					}
					break;
				case is_author():

					$setting_value = get_theme_mod( 'emulsion_layout_author_archives', emulsion_get_var( 'emulsion_layout_author_archives' ) );

					if ( 'full_text' == $setting_value || 'excerpt' == $setting_value ) {

						return $setting_value;
					}
					break;
				case is_search():

					$setting_value = get_theme_mod( 'emulsion_layout_search_results', emulsion_get_var( 'emulsion_layout_search_results' ) );

					$setting_value = str_replace( 'highlight', 'excerpt', $setting_value );
					return $setting_value;
					break;
			}

			return false;
		}
	}

}
if ( ! function_exists( 'emulsion_php_version_notice' ) ) {

	/**
	 * PHP version notice when theme activate
	 */
	function emulsion_php_version_notice() {

		printf( '<div class="%1$s"><p>%2$s<br />%3$s</p></div>', 'notice notice-error is_dismissable', esc_html__( 'You need to update your PHP version to run this theme.', 'emulsion' ), sprintf(
						/* translators: 1: PHP_VERSION 2: EMULSION_MIN_PHP_VERSION */
						esc_html__( 'Actual version is: %1$s, required version is: %2$s', 'emulsion' ), esc_html( PHP_VERSION ), esc_html( EMULSION_MIN_PHP_VERSION )
				)
		);
	}

}
if ( ! function_exists( 'emulsion_get_google_font_family_from_url' ) ) {

	/**
	 * Parsing the google fonts URL and getting the font name
	 * @param type $url
	 * @param type $fallback
	 * @return type
	 */
	function emulsion_get_google_font_family_from_url( $url = '',
			$fallback = 'sans-serif' ) {

		$query = parse_url( $url, PHP_URL_QUERY );

		if ( is_null( $query ) ) {
			return;
		}

		$query	 = htmlspecialchars_decode( $query );
		$result	 = '';

		parse_str( $query, $param );

		if ( false !== strstr( $param['family'], '|' ) ) {

			$fonts = explode( '|', $param['family'] );

			foreach ( $fonts as $font ) {

				if ( false !== $position = strpos( $font, ':' ) ) {

					$result .= ' "' . substr( $font, 0, $position ) . '",';
				} else {
					$result .= ' "' . $font . '",';
				}
			}
		} else {

			if ( false !== $position = strpos( $param['family'], ':' ) ) {

				$result .= ' "' . substr( $param['family'], 0, $position ) . '",';
			} else {
				$result .= ' "' . $param['family'] . '",';
			}
		}
		$result	 = str_replace( '+', ' ', $result );
		$result	 = addslashes( $result . $fallback );

		return trim( $result, ',' );
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
if ( ! function_exists( 'emulsion_remove_url_from_text' ) ) {

	/**
	 * Remove the URL string from the text
	 * @param type $plain_text
	 * @return type
	 */
	function emulsion_remove_url_from_text( $plain_text = '' ) {

		return preg_replace( "/(https?:\/\/)([-_.!*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/iu", '', $plain_text );
	}

}
if( ! function_exists('emulsion_amp_css') ) {
	
	function emulsion_amp_css(){
		// removed function
		return '';
	}
}

if ( function_exists( 'amp_init' ) ) {
	
	/**
	 * AMP
	 * for reader template
	 * https://wordpress.org/plugins/amp/
	 */
	add_action( 'amp_post_template_css', 'emulsion_addons_amp_css' );

	if ( ! function_exists( 'emulsion_addons_amp_css' ) ) {

		function emulsion_addons_amp_css() {
			
			$supports = false;
			$supports = emulsion_the_theme_supports( 'amp' );

			if ( ! $supports ) {
				return;
			}
			$css_variables	 = emulsion__css_variables();
			/**
			 * @see emulsion_sanitize_css() in functions.php
			 * For sanitization, you can add any processing you need
			 */
			echo emulsion_sanitize_css( $css_variables );
		}

	}

}

/**
 * AMP plugin setting
 */

$post_id = get_the_ID();

if ( ! is_singular() || 
		is_singular() &&  ! empty( $post_id ) && 'no-style' !== get_post_meta( $post_id, 'emulsion_post_theme_style_script', true ) ||
		is_singular() &&  ! empty( $post_id ) && 'no-style' !== get_post_meta( $post_id, 'emulsion_page_theme_style_script', true )
		) {

	add_action( 'wp_enqueue_scripts', 'emulsion_amp_enqueue_script' );
	add_filter( 'emulsion_template_pre', 'emulsion_amp_setting' );
}

function emulsion_amp_enqueue_script() {
	
	$emulsion_current_data_version = null;

	if ( is_user_logged_in() ) {

		$emulsion_current_data_version = emulsion_version();
	}

	if ( ! emulsion_is_amp() ) {

		wp_register_style( 'emulsion-completion', get_template_directory_uri() . '/css/common.css', array(), $emulsion_current_data_version, 'all' );
		wp_enqueue_style( 'emulsion-completion' );
		return;
	}
	wp_register_style( 'amp-reader', get_template_directory_uri() . '/css/amp.css', array(), $emulsion_current_data_version, 'all' );
	wp_enqueue_style( 'amp-reader' );

	$css_variables = emulsion__css_variables();
	wp_add_inline_style( 'amp-reader', $css_variables );
}

function emulsion_amp_setting() {
		
	if ( emulsion_is_amp() ) {
		emulsion_remove_supports( 'enqueue' );
		emulsion_remove_supports( 'search_drawer' );
		emulsion_remove_supports( 'primary_menu' );
		emulsion_remove_supports( 'sidebar' );
		emulsion_remove_supports( 'sidebar_page' );
		emulsion_remove_supports( 'title_in_page_header' );
		add_filter('post_thumbnail_html','_return_empty_string');		
		emulsion_remove_supports( 'instantclick' );
		emulsion_remove_supports( 'toc' );
		emulsion_remove_supports( 'tooltip' );

	} 

}
