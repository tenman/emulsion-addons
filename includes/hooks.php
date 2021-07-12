<?php

add_action( 'after_setup_theme', 'emulsion_addons_hooks_setup' );

function emulsion_addons_hooks_setup() {

 ! class_exists( 'WP_List_Table' ) ? require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ) : '';


	if ( function_exists( 'emulsion_is_plugin_active' ) && emulsion_is_plugin_active( 'wp-scss/wp-scss.php' ) && 'active' !== get_theme_mod( 'emulsion_wp_scss_status', false ) ) {

		//When you switch themes, cooperation with wp-scss may be canceled, and if the plugin is active, cooperate.
		//Do nothing if wp-scss is active before installing the theme.
		set_theme_mod( 'emulsion_wp_scss_status', 'active' );
		emulsion_set_wp_scss_options();
	}

	if ( function_exists( 'emulsion_is_plugin_active' ) && ! emulsion_is_plugin_active( 'wp-scss/wp-scss.php' ) ) {

		set_theme_mod( 'emulsion_wp_scss_status', 'deactive' );
	}

	$wp_scss_status = get_theme_mod( 'emulsion_wp_scss_status' );

	if ( 'active' !== $wp_scss_status ) {
		add_action( 'wp_ajax_emulsion_tiny_mce_css_variables', 'emulsion_tiny_mce_css_variables_callback' );
	}


	add_filter( 'emulsion_inline_style', 'emulsion_plugins_style_change_inline' );
	add_action( 'edit_post_link', 'emulsion_custom_gutenberg_edit_link', 10, 3 );
	function_exists( 'emulsion_customizer_add_supports_excerpt' ) ? add_action( 'emulsion_template_pre_index', 'emulsion_customizer_add_supports_excerpt' ) : '';
	add_action( 'init', 'emulsion_plugins' );
	add_action( 'customize_save_after', 'emulsion_customizer_is_changed' );
	add_filter( 'wp_resource_hints', 'emulsion_resource_hints', 10, 2 );
	add_filter( 'emulsion_inline_style', 'emulsion_styles' );
	add_filter( 'wp_list_categories', 'emulsion_category_link_format', 10, 2 );
	function_exists( 'emulsion_keyword_with_mark_elements_title' ) && ! is_admin() ? add_filter( 'the_title', 'emulsion_keyword_with_mark_elements_title', 99999 ) : '';
	function_exists( 'emulsion_keyword_with_mark_elements' ) && ! is_admin() ? add_filter( 'the_content', 'emulsion_keyword_with_mark_elements', 99999 ) : '';
	add_filter( 'get_the_excerpt', 'emulsion_get_the_excerpt_filter', 10, 2 );
	add_filter( 'embed_oembed_html', 'emulsion_oembed_filter', 99, 4 );
	add_filter( 'get_archives_link', 'emulsion_archive_link_format', 10, 6 );
	add_filter( 'the_content_more_link', 'emulsion_read_more_link' );
	add_filter( 'emulsion_footer_text', 'capital_P_dangit', 11 );
	add_filter( 'emulsion_footer_text', 'wptexturize' );
	add_filter( 'emulsion_footer_text', 'convert_smilies', 20 );
	add_filter( 'emulsion_footer_text', 'wpautop' );
	add_filter( 'do_shortcode_tag', 'emulsion_shortcode_wrapper', 10, 4 );

	add_filter( 'the_excerpt_embed', 'emulsion_the_excerpt_embed', 99 );
	add_filter( 'excerpt_length', 'emulsion_excerpt_length', 99 );
	add_filter( 'admin_body_class', 'emulsion_admin_body_class' );
	add_filter( 'body_class', 'emulsion_brightness_class', 15 );

	add_filter( 'body_class', 'emulsion_addons_body_class' );

	add_filter( 'dynamic_sidebar_params', 'emulsion_footer_widget_params' );
	add_filter( 'post_class', 'emulsion_add_woocommerce_class_to_post' );
	add_filter( 'emulsion_hover_color', 'emulsion_hover_color_filter' );

	'experimental' === get_theme_mod( 'emulsion_editor_support' ) ? add_action( 'admin_bar_menu', 'emulsion_admin_bar_menu' ): '';


	add_filter( 'theme_mod_background_image', 'emulsion_bg_img_display_hide_post_editor' );
	add_filter( 'wp_trim_words', 'emulsion_cjk_excerpt' );

	add_filter( 'emulsion_the_header_layer_class', 'emulsion_addons_the_header_layer_class' );
	add_filter( 'emulsion_get_month_link', 'emulsion_addons_get_month_link' );
	add_filter( 'emulsion_get_post_meta_on', 'emulsion_addons_get_post_meta_on', 11 );
	add_filter( 'emulsion_the_post_meta_in', 'emulsion_addons_the_post_meta_in' );
	add_filter( 'emulsion_the_post_title', 'emulsion_addons_the_post_title' );
	add_filter( 'emulsion_site_text_markup_self', 'emulsion_addons_site_text_markup' );
	add_filter( 'emulsion_site_text_markup', 'emulsion_addons_site_text_markup' );
	add_filter( 'emulsion_the_site_title', 'emulsion_addons_the_site_title' );
	add_filter( 'the_excerpt', 'emulsion_addons_excerpt' );
	add_filter( 'the_password_form', 'emulsion_password_form' );
	add_filter( 'emulsion_current_layout_type', 'emulsion_addons_current_layout_type' );
	add_filter( 'theme_mod_emulsion_header_layout', 'emulsion_header_layout_validate' );
	add_filter( 'emulsion_is_display_featured_image_in_the_loop', 'emulsion_addons_is_display_featured_image_in_the_loop' );
	add_filter( 'emulsion_inline_script', 'emulsion_description' );
	add_filter( 'theme_mod_emulsion_header_html', 'apply_shortcodes' );
	add_action( 'wp_footer', 'emulsion_addons_google_tracking_code', 99 );
}

if ( ! function_exists( 'emulsion_test_for_min_php' ) ) {

	function emulsion_test_for_min_php() {

		if ( version_compare( PHP_VERSION, EMULSION_MIN_PHP_VERSION, '<' ) ) {

			add_action( 'admin_notices', 'emulsion_php_version_notice' );
			switch_theme( get_option( 'theme_switched' ) );
			return false;
		};
	}

}

if ( ! function_exists( 'emulsion_plugins_style_change_inline' ) ) {

	function emulsion_plugins_style_change_inline( $css ) {
		global $wp_style;

		$add_css = '';

		if ( is_page() && false == emulsion_metabox_display_control( 'page_style' ) ) {

			return;
		}
		if ( is_single() && false == emulsion_metabox_display_control( 'style' ) ) {

			return;
		}
		if ( ! emulsion_the_theme_supports( 'enqueue' ) ) {

			return;
		}
		if ( is_user_logged_in() || is_admin() ) {

			return $css;
		}
		if ( ! is_user_logged_in() && emulsion_theme_addons_exists() ) {

			$get_css = file( get_theme_file_path( 'css/common.css' ) );
			$add_css .= implode( '', $get_css );
			return $css . $add_css;
		}
		return $css;
	}

}
if ( ! function_exists( 'emulsion_resource_hints' ) ) {

	function emulsion_resource_hints( $urls, $relation_type ) {

		if ( ( wp_style_is( 'common-google-font', 'queue' ) ||
				wp_style_is( 'heading-google-font', 'queue' ) ||
				wp_style_is( 'widget-meta-google-font', 'queue' ) ) && 'preconnect' === $relation_type ) {

			$urls[] = array(
				'href' => 'https://fonts.googleapis.com/',
				'crossorigin',
			);
		}

		return $urls;
	}

}
if ( ! function_exists( 'emulsion_tiny_mce_css_variables_callback' ) ) {

	function emulsion_tiny_mce_css_variables_callback() {
		global $post;

		if ( isset( $post ) && function_exists( 'use_block_editor_for_post' ) && use_block_editor_for_post( $post ) ) {
			return;
		}

		$wp_scss_status = get_theme_mod( 'emulsion_wp_scss_status' );

		if ( 'active' !== $wp_scss_status ) {

			// css variables dinamic ( not active wp_scss plugin ) and classic editor
			header( "Content-type: text/css" );
			echo esc_html( emulsion__css_variables() );
			die();
		}
	}

}

if ( ! function_exists( 'emulsion_category_link_format' ) ) {

	/**
	 * wrap the number of categories in span elements.
	 *
	 * @param type $output
	 * @param type $args
	 * @return type
	 */
	function emulsion_category_link_format( $output, $args ) {
		if ( is_page() && function_exists( 'emulsion_metabox_display_control' ) && false == emulsion_metabox_display_control( 'page_style' ) ) {

			return $output;
		}
		if ( is_single() && function_exists( 'emulsion_metabox_display_control' ) && false == emulsion_metabox_display_control( 'style' ) ) {

			return $output;
		}

		if ( function_exists( 'emulsion_get_supports' ) && ! emulsion_get_supports( 'enqueue' ) ) {

			return $output;
		}

		if ( isset( $args['show_count'] ) && ! empty( $args['show_count'] ) ) {

			return preg_replace( '!\(([0-9]+)\)!', "<span class=\"emulsion-cat-count counter badge circle\">$1</span>", $output );
		}

		return $output;
	}

}




if ( ! function_exists( 'emulsion_archive_link_format' ) ) {

	/**
	 * wrap the number of tags in span elements.
	 *
	 * @param string $link_html
	 * @param type $url
	 * @param type $text
	 * @param type $format
	 * @param type $before
	 * @param type $after
	 * @return type
	 */
	function emulsion_archive_link_format( $link_html, $url, $text, $format,
			$before, $after ) {
		if ( is_page() && function_exists( 'emulsion_metabox_display_control' ) && false == emulsion_metabox_display_control( 'page_style' ) ) {

			return $link_html;
		}
		if ( is_single() && function_exists( 'emulsion_metabox_display_control' ) && false == emulsion_metabox_display_control( 'style' ) ) {

			return $link_html;
		}
		if ( function_exists( 'emulsion_get_supports' ) && ! emulsion_get_supports( 'enqueue' ) ) {

			return $link_html;
		}

		if ( $format == 'html' ) {

			$after = str_replace( array( '(', ')', '&nbsp;' ), '', $after );

			$link_html = '<li><a href="%1$s" class="emulsion-archive-link"><span class="emulsion-archive-date">%2$s</span></a>
<span class="emulsion-archive-count counter badge circle">%3$s</span></li>';

			return sprintf( $link_html, $url, $text, $after );
		}

		return $link_html;
	}

}
if ( ! function_exists( 'emulsion_read_more_link' ) ) {

	/**
	 * layout type list
	 * @return type
	 */
	function emulsion_read_more_link() {

		$post_id	 = get_the_ID();
		$title_text	 = the_title_attribute(
				array( 'before' => esc_html__( 'link to ', 'emulsion-addons' ),
					'echo'	 => false, )
		);

		if ( is_int( $post_id ) ) {

			return sprintf(
					'<p class="read-more"><a class="skin-button" href="%1$s" aria-label="%3$s">%2$s<span class="screen-reader-text read-more-context">%3$s</span></a></p>', get_permalink(), esc_html__( 'Read more', 'emulsion-addons' ), $title_text
			);
		}
	}

}
if ( ! function_exists( 'emulsion_custom_gutenberg_edit_link' ) ) {

	/**
	 * Identify posts edited in the classic editor and posts edited in the block editor.
	 *
	 * Classic editor Plug-in dependent function
	 *
	 * @param type $link
	 * @param type $post_id
	 * @param type $text
	 * @return type
	 */
	function emulsion_custom_gutenberg_edit_link( $link, $post_id, $text ) {

		if( is_multisite() ) {

			return $link;
		}

		$which				 = get_post_meta( $post_id, 'classic-editor-remember', true );
		$allow_users_option	 = get_option( 'classic-editor-allow-users' );

		$emulsion_disallow_old_post_open_classic_editor = apply_filters( 'emulsion_disallow_old_post_open_classic_editor', false );

		if ( 'allow' == $allow_users_option ) {

			if ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) && 'classic-editor' == $which ) {

				$gutenberg_action = sprintf(
						'<a href="%1$s" class="skin-button">%2$s</a>', esc_url( add_query_arg(
										array( 'post' => $post_id, 'action' => 'edit', 'classic-editor' => '', 'classic-editor__forget' => '' ), admin_url( 'post.php' )
						) ), esc_html__( 'Classic Editor', 'emulsion-addons' ) );

				return $gutenberg_action;
			}
		}
		if ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) && ! metadata_exists( 'post', $post_id, 'classic-editor-remember' ) && ! $emulsion_disallow_old_post_open_classic_editor ) {

			$gutenberg_action = sprintf(
					'<a href="%1$s" class="skin-button">%2$s</a>', esc_url( add_query_arg(
									array( 'post' => $post_id, 'action' => 'edit', 'classic-editor' => '', 'classic-editor__forget' => '' ), admin_url( 'post.php' )
					) ), esc_html__( 'Classic Editor', 'emulsion-addons' ) );

			return $gutenberg_action;
		}

		return $link;
	}

}

if ( ! function_exists( 'emulsion_shortcode_wrapper' ) ) {

	/**
	 * Wrap short code with html element
	 * The purpose is to apply CSS style using classes included in short code.
	 * @param type $output
	 * @param type $tag
	 * @param type $attr
	 * @param type $m
	 * @return type
	 */
	function emulsion_shortcode_wrapper( $output, $tag, $attr, $m ) {

		$tag_class = sanitize_html_class( $tag );

		$output = sprintf( '<div class="shortcode-wrapper wrap-%2$s">%1$s</div>', $output, $tag_class );

		return $output;
	}

}



if ( ! function_exists( 'emulsion_the_excerpt_embed' ) ) {

	/**
	 * The summary sentence is displayed in five lines.
	 * @param type $excerpt_text
	 * @since 1.09 line nuber changed from 2 to 5
	 */
	function emulsion_the_excerpt_embed( $excerpt_text ) {


		$excerpt_text = strip_tags( $excerpt_text );

		printf( '<p style="font-size:13px;max-height:calc(1em * 1.5 * 5);overflow:hidden;">%1$s</p>', wp_kses_post( $excerpt_text ) );
	}

}

if ( ! function_exists( 'emulsion_excerpt_length' ) ) {

	/**
	 * get excerpt length
	 * @param type $length
	 * @return type
	 */
	function emulsion_excerpt_length( $length ) {

		$length = get_theme_mod( 'emulsion_excerpt_length', 256 );

		return absint( $length );
	}

}
/**
 * Theme body class
 */
if ( ! function_exists( 'emulsion_admin_body_class' ) ) {

	function emulsion_admin_body_class( $classes ) {
		global $post, $wp_version;


		if ( ! isset( $post ) || ! function_exists( 'emulsion_get_var' ) ) {
			return $classes;
		}

		if ( isset( $post ) && use_block_editor_for_post( $post ) ) {

			if ( function_exists( 'emulsion_contrast_color' ) ) {

				$text_color = emulsion_contrast_color();
			} else {

				$text_color = '#333333';
			}

			$emulsion_post_theme_style_script	 = get_post_meta( absint( $post->ID ), 'emulsion_post_theme_style_script', true );
			$emulsion_page_theme_style_script	 = get_post_meta( absint( $post->ID ), 'emulsion_page_theme_style_script', true );

			if ( 'no_bg' !== $emulsion_post_theme_style_script && 'no_bg' !== $emulsion_page_theme_style_script ) {

				if ( '#ffffff' == $text_color ) {

					$emulsion_brightnes = ' is-dark is-dark-theme';
				}
				if ( '#333333' == $text_color ) {

					$emulsion_brightnes = ' is-light';
				}
			}
			if ( 'no_bg' == $emulsion_post_theme_style_script || 'no_bg' == $emulsion_page_theme_style_script ) {

				$default_background	 = sprintf( '#%1$s', get_theme_support( 'custom-background', 'default-color' ) );
				$text_color			 = emulsion_contrast_color( $default_background );

				if ( '#ffffff' == $text_color ) {

					$emulsion_brightnes = ' is-dark is-dark-theme';
				}
				if ( '#333333' == $text_color ) {

					$emulsion_brightnes = ' is-light';
				}
			}
			if ( function_exists( 'emulsion_get_var' ) ) {
				$colors_for_editor = get_theme_mod( 'emulsion_colors_for_editor', emulsion_get_var( 'emulsion_colors_for_editor' ) );
			} else {
				$colors_for_editor = 'disable';
			}

			if ( 'enable' == $colors_for_editor ) {

				$color_for_editor_class = ' emulsion-color-enable';
			} else {
				$color_for_editor_class = ' emulsion-color-disable';
			}
			/**
			 * gutengerg7.2 html structure changed
			 * The editor style implemented in 5.0-core cannot control block styles after GB7.2.
			 * Need to add style for new editor structure and keep style for old structure
			 * Add a new body class to allow the theme to control the editor style
			 */
			if ( has_action( 'admin_enqueue_scripts', 'gutenberg_edit_site_init' ) ) {

				$block_editor_class_name = ' emulsion-gb-phase-site';
			} else {

				$block_editor_class_name = ' emulsion-gb-phase-block';
			}

			if ( version_compare( $wp_version, '5.5', '>=' ) ) {

				$block_editor_class_name = ' emulsion-gb-phase-site';
			}

			$theme_classes	 = implode( ' ', emulsion_addons_body_class( array() ) );
			$theme_classes	 = str_replace( array( 'noscript' ), '', $theme_classes );

			return $classes . ' '. $theme_classes . $emulsion_brightnes . $color_for_editor_class . $block_editor_class_name;
		}

		return $classes;
	}

}
if ( ! function_exists( 'emulsion_brightness_class' ) ) {

	function emulsion_brightness_class( $classes ) {
		global $post;

		if ( ! isset( $post ) || ! function_exists( 'emulsion_contrast_color' ) ) {
			return $classes;
		}

		if ( ! is_singular() ) {

			$text_color = emulsion_contrast_color();

			if ( '#ffffff' == $text_color ) {
				$classes[]	 = 'is-dark';
				$classes	 = array_diff( $classes, array( 'is-light' ) );
				$classes	 = array_values( $classes );

				return $classes;
			}
			if ( '#333333' == $text_color ) {
				$classes[]	 = 'is-light';
				$classes	 = array_diff( $classes, array( 'is-dark' ) );
				$classes	 = array_values( $classes );

				return $classes;
			}
		} else {

			$text_color							 = emulsion_contrast_color();
			$emulsion_post_theme_style_script	 = get_post_meta( absint( $post->ID ), 'emulsion_post_theme_style_script', true );
			$emulsion_page_theme_style_script	 = get_post_meta( absint( $post->ID ), 'emulsion_page_theme_style_script', true );

			if ( 'no_bg' !== $emulsion_post_theme_style_script && 'no_bg' !== $emulsion_page_theme_style_script ) {

				if ( '#ffffff' == $text_color ) {

					$classes[] = 'is-dark';

					$classes = array_diff( $classes, array( 'is-light' ) );
					$classes = array_values( $classes );
					return $classes;
				}
				if ( '#333333' == $text_color ) {

					$classes[]	 = 'is-light';
					$classes	 = array_diff( $classes, array( 'is-dark' ) );
					$classes	 = array_values( $classes );

					return $classes;
				}
			}
			if ( 'no_bg' == $emulsion_post_theme_style_script || 'no_bg' == $emulsion_page_theme_style_script ) {

				$default_background	 = sprintf( '#%1$s', get_theme_support( 'custom-background', 'default-color' ) );
				$text_color			 = emulsion_contrast_color( $default_background );

				if ( '#ffffff' == $text_color ) {

					$classes[] = 'is-dark';

					$classes = array_diff( $classes, array( 'is-light' ) );
					$classes = array_values( $classes );
					return $classes;
				}
				if ( '#333333' == $text_color ) {

					$classes[]	 = 'is-light';
					$classes	 = array_diff( $classes, array( 'is-dark' ) );
					$classes	 = array_values( $classes );

					return $classes;
				}
			}
		}
	}

}
if ( ! function_exists( 'emulsion_get_the_excerpt_filter' ) ) {

	function emulsion_get_the_excerpt_filter( $excerpt, $post ) {

		$locale	 = sanitize_text_field( get_locale() );
		$count	 = 200;
		$more	 = '...';

		if ( 'ja' == $locale ) {

			$excerpt = apply_filters( 'the_excerpt', $post->post_excerpt );

			if ( empty( $excerpt ) ) {
				$excerpt = $post->post_content;
				$excerpt = apply_filters( 'the_content', $excerpt );
			}

			$excerpt = strip_shortcodes( $excerpt );

			return wp_html_excerpt( $excerpt, $count, $more );
		}

		return $excerpt;
	}

}
if ( ! function_exists( 'emulsion_styles' ) ) {

	function emulsion_styles( $css ) {

		$style = $css;

		//$style	 .= emulsion_inline_style_filter( '' );

		$style	 .= emulsion_term_duplicate_link_hide( '' );
		$style	 .= emulsion_smart_category_highlight( '' );
		$style	 .= emulsion_adminbar_css( '' );
		//$style	 .= emulsion_add_common_font_css( '' );
		//$style	 .= emulsion_heading_font_css( '' );
		$style	 .= emulsion_widget_meta_font_css( '' );
		$style	 .= emulsion_block_latest_posts_excerpt( '' );

		if( is_user_logged_in() ) {

			$style .= emulsion_dinamic_css( '' );
		} else {

		}

		$style = emulsion_sanitize_css( $style );
		return $style;
	}

}

if ( ! function_exists( 'emulsion_term_duplicate_link_hide' ) ) {

	function emulsion_term_duplicate_link_hide( $css ) {

		$css = emulsion_sanitize_css( $css );

		$term_link = esc_url( get_category_link( 1 ) );

		if ( is_category() || is_tag() ) {
			/**
			 * Hide same term link each post
			 */
			$term_id = get_queried_object_id();

			if ( is_category() ) {
				$term_link	 = esc_url( get_category_link( $term_id ) );
				$css		 .= '.post-categories a[href="' . $term_link . '"]{display:none;} ';
			}
			if ( is_tag() ) {
				$term_link	 = esc_url( get_term_link( $term_id ) );
				$css		 .= '.post-tag a[href="' . $term_link . '"]{display:none;} ';
			}
		}
		/* remove uncategorized */
		if ( isset( get_category_by_slug( 'uncategorized' )->term_id ) && absint( get_category_by_slug( 'uncategorized' )->term_id ) == absint( get_option( 'default_category' ) ) ) {
			$css .= '#document .cat-item-1{display:none;}';
		}

		return $css;
	}

}
if ( ! function_exists( 'emulsion_smart_category_highlight' ) ) {

	/**
	 *
	 * @param type $css
	 * @return type
	 */
	function emulsion_smart_category_highlight( $css ) {

		$css = emulsion_sanitize_css( $css );

		$saturation_base = 50;
		$lightness_base	 = 45;
		$start_angle	 = 0;
		$result			 = '';

		/*
		 * Do not display if the number of posts belonging to the category is
		 * less than or equal to the specified number
		 */
		$count_sep	 = 0;
		$alpha		 = 1;
		$taxonomies	 = array( 'category' );

		$args = array(
			'orderby'		 => 'count',
			'order'			 => 'DESC',
			'hierarchical'	 => false,
		);

		$terms = get_terms( $taxonomies, $args );

		$transient_name = md5( serialize( $terms ) );

		if ( empty( $terms ) ) {
			return $css;
		}
		if ( get_theme_mod( 'emulsion_delete_transient' ) || is_customize_preview() ) {

			delete_transient( $transient_name );
		}

		$transient_val = get_transient( $transient_name );

		if ( false !== ( $transient_val ) ) {

			return $css . apply_filters( 'emulsion_smart_category_highlight', $transient_val );
		}

		$count_terms = count( $terms );
		$radian		 = 270 / $count_terms;
		$body_id	 = '#' . esc_attr( emulsion_theme_info( 'Slug', false ) );

		foreach ( $terms as $key => $term ) {

			$v			 = $key + 1;
			$hue		 = absint( $start_angle + ( $radian * $v ) );
			$saturation	 = absint( $saturation_base ) . '%';
			$lightness	 = absint( $lightness_base ) . '%';

			if ( $lightness_base <= 50 ) {
				$color = '#fff';
			} else {
				$color = '#000';
			}
			/* category header style */
			if ( function_exists( 'emulsion_get_var' ) && 'enable' == get_theme_mod( 'emulsion_category_colors', emulsion_get_var( 'emulsion_category_colors' ) ) ) {
				if ( $term->count > $count_sep ) {

					if ( 'enable' == get_theme_mod( 'emulsion_header_gradient', emulsion_get_var( 'emulsion_header_gradient' ) ) ) {

						$gradient_hue		 = $hue + 30;
						$background_value	 = 'linear-gradient(90deg,  hsl(' . $hue . ',' . $saturation . ',' . $lightness . '),
											hsl(' . $gradient_hue . ',' . $saturation . ',' . $lightness . ') )';
						$css				 = '.on-scroll.has-category-colors.category-%1$s .header-layer-site-title-navigation,
								.on-scroll.has-category-colors.category.archive.category-%1$s .header-layer,
								.has-category-colors.category.archive.category-%1$s .header-layer{
									color:%2$s;
									background: %3$s
								}';

						$result .= sprintf( $css, absint( $term->term_id ), $color, $background_value );
					} else {

						$background_value = 'hsla(' . $hue . ',' . $saturation . ',' . $lightness . ',' . $alpha . ')';

						$css = '.on-scroll.has-category-colors.category-%1$s .header-layer-site-title-navigation,
								.on-scroll.has-category-colors.category.archive.category-%1$s .header-layer,
								.has-category-colors.category.archive.category-%1$s .header-layer{
									color:%2$s;
									background: %3$s
								}';

						$result .= sprintf( $css, absint( $term->term_id ), $color, $background_value );
					}

					/* cta link button */
					$background_value = 'hsla(' . intval( $hue ) . ',' . $saturation . ',' . $lightness . ',' . $alpha . ')';

					$css = '.category.has-category-colors.archive.category-%1$s .header-layer .cta-layer a{
								color: %2$s;
								background: %3$s;
						   }';

					$result .= sprintf( $css, absint( $term->term_id ), $color, $background_value );

					/* category icon */
					$hover_hue				 = intval( $hue + 180 );
					$link_lightness			 = '90%';
					$description_lightness	 = '100%';

					$background_value	 = 'hsla(' . intval( $hover_hue ) . ',' . $saturation . ',' . $lightness . ',' . $alpha . ')';
					$css				 = '.has-category-colors.category.archive.category-%1$s .header-layer .drawer-wrapper .icon:hover{
								fill:%2$s;
								stroke:%2$s;
							}';

					$result .= sprintf( $css, absint( $term->term_id ), $background_value );

					$color_value = 'hsla(' . intval( $hover_hue ) . ',' . $saturation . ',' . $link_lightness . ',' . $alpha . ')';

					$css = '.has-category-colors.category.archive.category-%1$s .header-layer .taxonomy-description,
							.has-category-colors.category.archive.category-%1$s .header-layer a:hover,
							.has-category-colors.category.archive.category-%1$s .header-layer a{
								color: %2$s;
							}';

					$result .= sprintf( $css, absint( $term->term_id ), $color_value );

					/* header simple wp_nav_menu() sub-menu, children */
					$background_value = 'hsla(' . intval( $hue ) . ',' . $saturation . ',' . $lightness . ',' . $alpha . ')';

					$css	 = '.has-category-colors.category.archive.category-%1$s .template-part-header .wp-nav-menu .children,
								.has-category-colors.category.archive.category-%1$s .template-part-header .wp-nav-menu .sub-menu{
									background: %2$s;
								}';
					$result	 .= sprintf( $css, absint( $term->term_id ), $background_value );

					/* category header style end */
					$background_value = 'hsla(' . intval( $hue ) . ',' . $saturation . ',' . $lightness . ',' . $alpha . ')';

					$css = '%1$s .entry-meta .cat-item-%2$s {
									background:%3$s;
									transition:all .5s ease-in-out;
								}';

					$result .= sprintf( $css, $body_id, absint( $term->term_id ), $background_value );

					$css	 = '%1$s .cat-item-%2$s.current-cat,
								%1$s .cat-item-%2$s.current-cat a,
								%1$s .entry-meta .cat-item-%2$s .cat-item-%2$s:hover a
								%1$s .entry-meta .cat-item-%2$s .cat-item-%2$s a{
									color:#fff;
								}';
					$result	 .= sprintf( $css, $body_id, absint( $term->term_id ) );

					$css	 = '%1$s .entry-meta .cat-item-%2$s:hover a,
								%1$s .entry-meta .cat-item-%2$s:hover,
								%1$s .entry-meta .cat-item-%2$s a{
									color:#eee;
								}';
					$result	 .= sprintf( $css, $body_id, absint( $term->term_id ) );

					$background_value = 'hsla(' . intval( $hue ) . ',' . $saturation . ',' . $lightness . ',' . $alpha . ')';


					$css	 = '%1$s .cat-item-%2$s.current-cat,
								%1$s .cat-item-%2$s:hover{
									background:%3$s;
								}';
					$result	 .= sprintf( $css, $body_id, absint( $term->term_id ), $background_value );

					/* relate style effect.scss */
					$background_value = 'hsla(' . intval( $hue ) . ',' . $saturation . ',' . $lightness . ',' . $alpha . ')';

					$css	 = '%1$s.hilight-cat-item-%2$s .cat-item-%2$s {
									background:%3$s;
									color:#fff;
								}';
					$result	 .= sprintf( $css, $body_id, absint( $term->term_id ), $background_value );

					$css	 = '%1$s.hilight-cat-item-%2$s .cat-item-%2$s li{
									color:#fff;
								}';
					$result	 .= sprintf( $css, $body_id, absint( $term->term_id ) );

					$css	 = '%1$s.hilight-cat-item-%2$s .cat-item-%2$s a{
									color:#fff ! important;
								}';
					$result	 .= sprintf( $css, $body_id, absint( $term->term_id ) );

					/* link before icon style */
					/* $result	 .= $body_id . ' .cat-item-' . absint($term->term_id) . ':before {content:\'\'; display:inline-block; width:1rem; height:1rem; vertical-align:middle;}';
					  $result	 .= $body_id . ' .cat-item-' . absint($term->term_id) . ':before {background:hsla(' . $hue . ',' . $saturation . ',' . $lightness . ',' . $alpha . ');} ';
					  $result	 .= $body_id . ' .cat-item-' . absint($term->term_id) . '{transition:all .5s ease-in-out;} ';
					  $result	 .= $body_id . ' .cat-item-' . absint($term->term_id) . ':before, .cat-item-' . absint($term->term_id) . ':before a{color:#fff;} '; */
				} else {
					$result	 .= $body_id . ' .cat-item.cat-item-' . absint( $term->term_id ) . " {\n display:none;\n} \n";
					$result	 .= $body_id . '.category-archives .cat-item.cat-item-' . absint( $term->term_id ) . " {\n display:none; \n } \n";
				}
			}
		}

		$result	 = emulsion_sanitize_css( $result );
		$result	 = emulsion_remove_spaces_from_css( $result );

		set_transient( $transient_name, $result, 60 * 60 * 24 );
		return $css . $result;
	}

}
if( ! function_exists('emulsion_adminbar_css') ) {

	function emulsion_adminbar_css( $css ){

		$css .=<<< CSS
				#wp-admin-bar-fse_switch_off{

					border-left:1rem solid #ff0033;
				}
				#wp-admin-bar-fse_switch_on a{

					border-left:1rem solid #90ee90;
				}
				#wp-admin-bar-fse_switch_transitional a{

					border-left:1rem solid #3498db;
				}

CSS;
		return $css;

	}
}


if ( ! function_exists( 'emulsion_block_latest_posts_excerpt' ) ) {

	function emulsion_block_latest_posts_excerpt( $css ) {

		$excerpt_lines	 = get_theme_mod( 'emulsion_excerpt_length_grid', emulsion_get_var( 'emulsion_excerpt_length_grid' ) );
		$style			 = '';

		if ( function_exists( 'emulsion_lang_cjk' ) && emulsion_lang_cjk() ) {

			$style = <<<CSS

body .wp-block-latest-posts > li .wp-block-latest-posts__post-excerpt{
	height:calc( var(--thm_meta_data_font_size) * var(--thm_content_line_height) * absint($excerpt_lines) );
	overflow:hidden;
}

CSS;
			return $css . $style;
		}

		return $css;
	}

}
if ( ! function_exists( 'emulsion_widget_meta_font_css' ) ) {

	function emulsion_widget_meta_font_css( $css ) {

		$pre_filter = apply_filters ( 'emulsion_widget_meta_font_css_pre', false );

		if( false !== $pre_filter  ) {

			return $css. $pre_filter;
		}

		$transient_name = __FUNCTION__;

		if ( is_customize_preview() ) {

			delete_transient( $transient_name );
		}

		$transient_val = get_transient( $transient_name );

		if ( false !== ( $transient_val ) && ! is_user_logged_in() ) {

			return $css . $transient_val;
		}

		$inline_style = emulsion_sanitize_css( $css );
		if ( function_exists( 'emulsion_get_var' ) ) {
			$font_google_family_url	 = get_theme_mod( 'emulsion_widget_meta_google_font_url', emulsion_get_var( 'emulsion_widget_meta_google_font_url' ) );
			$fallback_font_family	 = get_theme_mod( 'emulsion_widget_meta_font_family', emulsion_get_var( 'emulsion_widget_meta_font_family' ) );
			$font_size				 = get_theme_mod( 'emulsion_widget_meta_font_size', emulsion_get_var( 'emulsion_widget_meta_font_size' ) );
			$text_transform			 = get_theme_mod( 'emulsion_widget_meta_font_transform', emulsion_get_var( 'emulsion_widget_meta_font_transform' ) );
			$widget_title_font		 = get_theme_mod( 'emulsion_widget_meta_title', emulsion_get_var( 'emulsion_widget_meta_title' ) );
			$common_font_size		 = get_theme_mod( 'emulsion_common_font_size', emulsion_get_var( 'emulsion_common_font_size' ) );
		} else {

			$font_google_family_url	 = emulsion_theme_default_val( 'emulsion_widget_meta_google_font_url' );
			$fallback_font_family	 = emulsion_theme_default_val( 'emulsion_widget_meta_font_family' );
			$font_size				 = emulsion_theme_default_val( 'emulsion_widget_meta_font_size' );
			$text_transform			 = emulsion_theme_default_val( 'emulsion_widget_meta_font_transform');
			$widget_title_font		 = emulsion_theme_default_val( 'emulsion_widget_meta_title' );
			$common_font_size		 = emulsion_theme_default_val( 'emulsion_common_font_size' );
		}


		if ( ! empty( $font_google_family_url ) ) {

			$font_family = emulsion_get_google_font_family_from_url( $font_google_family_url, $fallback_font_family );
		} else {

			$font_family = $fallback_font_family;
		}

		if ( $widget_title_font ) {

			$widget_title_font_family = 'font-family:' . $font_family . ';';
		} else {

			$widget_title_font_family = '';
		}


		$inline_style .= <<<CSS


		body .primary-menu-wrapper a {
		  font-size: {$font_size}px;
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body .menu-placeholder {
		  font-size: {$common_font_size}px
		}
		body.emulsion-has-sidebar .template-part-widget-sidebar .sidebar-widget-area-lists {
		  font-size: {$font_size}px;
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body.emulsion-has-sidebar .template-part-widget-sidebar .sidebar-widget-area-lists li {
		  line-height: calc({$common_font_size}px * var( --thm_content-line-height, 1.5 ));
		  font-size: {$font_size}px;
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body.emulsion-has-sidebar .template-part-widget-sidebar .sidebar-widget-area-lists li #wp-calendar caption,
		body.emulsion-has-sidebar .template-part-widget-sidebar .sidebar-widget-area-lists li .widgettitle {
		  font-size: 20px;
		  $widget_title_font_family
		}
		body.emulsion-has-sidebar .template-part-widget-sidebar .sidebar-widget-area-lists li a,
		body.emulsion-has-sidebar .template-part-widget-sidebar a {
		  font-size: {$font_size}px;
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body .footer-widget-area.template-part-widget-footer .footer-widget-area-lists {
		  font-size: {$font_size}px;
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body .footer-widget-area.template-part-widget-footer .footer-widget-area-lists li {
		  line-height: calc({$common_font_size}px * var( --thm_content-line-height, 1.5 ));
		  font-size: {$font_size}px;
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body .footer-widget-area.template-part-widget-footer .footer-widget-area-lists li #wp-calendar caption,
		body .footer-widget-area.template-part-widget-footer .footer-widget-area-lists li .widgettitle {
		  font-size: 20px;
		  $widget_title_font_family
		}
		body .footer-widget-area.template-part-widget-footer .footer-widget-area-lists li a,
		body .footer-widget-area.template-part-widget-footer a {
		  font-size: {$font_size}px;
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body .relate-content-wrapper {
		  font-size: {$common_font_size}px;
		  font-family: {$font_family};
		}
		body .relate-content-wrapper .relate-posts-title {
		  font-size: calc({$font_size}px * 1.4);
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body article footer {
		  font-size: 16px;
		}
		body article footer .skin-button{
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body .post-navigation a {
		  font-size: {$font_size}px;
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body footer.banner {
		  font-size: {$font_size}px;
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body .navigation.pagination .page-numbers{
		 font-size: {$font_size}px;
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body footer.banner a {
		  font-size: 13px;
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body .entry-meta a {
		  font-size: {$font_size}px;
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body .posted-on a {
		  font-size: {$font_size}px;
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body .footer-widget-area .footer-widget-area-lists a {
		  font-size: {$font_size}px;
		  font-family: {$font_family};
		  text-transform: {$text_transform};
		}
		body.layout-grid .entry-title {
		  font-size: 22px;
		}
		body.layout-stream .entry-title {
		  font-size: 22px;
		}
		body .relate-posts-title {
		  font-size: 22px;
		}
CSS;

		$inline_style	 = emulsion_sanitize_css( $inline_style );
		$inline_style	 = emulsion_remove_spaces_from_css( $inline_style );
		set_transient( $transient_name, $inline_style, 60 * 60 * 24 );
		return $css . $inline_style;
	}

}

if ( ! function_exists( 'emulsion_do_snippet' ) ) {

	function emulsion_do_snippet( $hook = '', $type = 'action', $css = '',
			$js = '', $html = '' ) {

		if ( empty( $hook ) ) {
			return;
		}

		empty( $css ) ? '' : add_filter( 'emulsion_inline_style', function( $current_css ) use( $css ) {
							$css = emulsion_sanitize_css( $css );
							return $current_css . ' ' . $css;
						} );

		empty( $js ) ? '' : add_filter( 'emulsion_inline_script', function( $current_js ) use( $js ) {

							return $current_js . ' ' . $js;
						} );

		$type == 'filter' ? add_filter( $hook, function($current_html) use( $html ) {

							if ( is_array( $current_html ) && is_array( $html ) ) {

								$current_html = array_merge( $current_html, $html );

								return $current_html;
							}
							if ( is_string( $current_html ) && is_string( $html ) ) {

								return $current_html . $html;
							}
						} ) : '';
		$type == 'action' ? add_action( $hook, function() use( $html ) {
							/* $html output action hook results */
							echo $html;
						} ) : '';
	}

}
if ( ! function_exists( 'emulsion_footer_widget_params' ) ) {

	function emulsion_footer_widget_params( $params ) {

		if ( isset( $params[0]['id'] ) ) {

			$sidebar_id = $params[0]['id'];

			if ( $sidebar_id == 'sidebar-2' ) {
				static $count = 1;

				$params[0]['before_widget'] = str_replace( 'class="', 'class="col-' . absint( $count ) . ' ', $params[0]['before_widget'] );
				$count ++;
			}
			if ( $sidebar_id == 'sidebar-4' ) {
				static $count_page = 1;

				$params[0]['before_widget'] = str_replace( 'class="', 'class="col-' . absint( $count_page ) . ' ', $params[0]['before_widget'] );
				$count_page ++;
			}
			return $params;
		}

		return $params;
	}

}
if ( ! function_exists( 'emulsion_plugins' ) ) {

	function emulsion_plugins() {

		if ( function_exists( 'amp_init' ) ) {

			add_action( 'amp_post_template_footer', 'emulsion_svg' );
			add_filter( 'amp_post_template_data', 'emulsion_amp_post_template_data' );
		}
	}

}
if ( ! function_exists( 'emulsion_amp_post_template_data' ) ) {

	function emulsion_amp_post_template_data( $data ) {

		$spacer				 = empty( $data['body_class'] ) ? '' : ' ';
		$data['body_class']	 .= $spacer . 'emulsion';

		return $data;
	}

}
if ( ! function_exists( 'emulsion_svg' ) ) {

	function emulsion_svg() {

		if ( emulsion_get_supports( 'footer-svg' ) ) {

			get_template_part( 'images/svg' );
		}
	}

}
if ( ! function_exists( 'emulsion_cjk_excerpt' ) ) {

	function emulsion_cjk_excerpt( $text ) {

		/**
		 * Languages that do not separate words with spaces
		 * block latest post excerpt. not support
		 */
		$length = apply_filters( 'emulsion_cjk_excerpt_length', 256 ); //todo check 110 to 256 changed

		if ( function_exists( 'emulsion_lang_cjk' ) && emulsion_lang_cjk() ) {

			return wp_html_excerpt( $text, $length, '...' );
		}
		return $text;
	}

}



if ( ! function_exists( 'emulsion_addons_the_header_layer_class' ) ) {

	/**
	 * Header Classes
	 * The CSS class is added by judging whether the image or video is set in the Site header.
	 * @param type $class
	 */
	function emulsion_addons_the_header_layer_class( $class = '' ) {

		$header_background_color		 = get_theme_mod( 'emulsion_header_background_color', emulsion_get_var( 'emulsion_header_background_color' ) );
		$default_header_background_color = emulsion_get_var( 'emulsion_header_background_color', 'default' );
		$has_saved_background_color		 = get_theme_mod( 'emulsion_header_background_color' );

		$add_class = '';
		if ( $default_header_background_color == $header_background_color && $has_saved_background_color == $header_background_color ) {

			$add_class .= ' header-is-default-color';
		} else {

			$text_color = emulsion_contrast_color( $header_background_color );

			if ( '#333333' == $text_color ) {

				$add_class .= ' header-is-light';
			}
			if ( '#ffffff' == $text_color ) {

				$add_class .= ' header-is-dark';
			}
		}

			echo esc_html( emulsion_class_name_sanitize( $add_class . $class ) );

	}

}



if ( ! function_exists( 'emulsion_addons_get_month_link' ) ) {

	/**
	 * Posted on date link
	 * datelink text date format value. link href url to month archive
	 * Todo: Paged link not support yet, a fragment identifier not work when paged..
	 * @return type
	 */
	function emulsion_addons_get_month_link() {

		$type			 = get_theme_mod( 'emulsion_post_display_date_format', emulsion_get_var( 'emulsion_post_display_date_format' ) );
		$entry_date_html = '<a href="%1$s" rel="%2$s"><%4$s class="entry-date %6$s" %5$s>%3$s</%4$s></a>';

		$emulsion_post_id	 = get_the_ID();
		$published_class	 = 'updated';
		$archive_year		 = get_the_time( 'Y' );
		$archive_month		 = get_the_time( 'm' );
		$month_link			 = esc_url( get_month_link( $archive_year, $archive_month ) . '#post-' . absint( $emulsion_post_id ) );

		if ( 'ago' == $type ) {

			$publish_date	 = get_the_time( 'U' );
			/* translators: %s  human_time_diff() */
			$date_text		 = sprintf( esc_html__( '%s ago', 'emulsion-addons' ), human_time_diff( $publish_date, current_time( 'timestamp' ) ) );
		}
		if ( 'default' == $type ) {

			$date_format = emulsion_date_format();
			$date_text	 = get_the_date( $date_format );
		}

		$entry_date_html = sprintf( $entry_date_html, $month_link, 'date', $date_text, 'time', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', $published_class );

		return $entry_date_html;
	}

}



if ( ! function_exists( 'emulsion_addons_get_post_meta_on' ) ) {

	/**
	 * get posted in block
	 * @return typePost Date and Author in Article
	 */
	function emulsion_addons_get_post_meta_on() {

		global $authordata, $post;

		if ( post_password_required() ) {
			return;
		}


		$html = '<div class="%6$s">
		<span class="meta-prep meta-prep-author">
			<span class="posted-on-string screen-reader-text">%1$s</span>
		</span>
		%2$s
		<span class="meta-sep">
			<span class="posted-by-string screen-reader-text">%3$s</span>
		</span>
		<span class="author vcard">%4$s</span>
		%5$s
	</div>';

		$class	 = 'posted-on';
		$class	 .= 'inline' == get_theme_mod( 'emulsion_post_display_date', emulsion_get_var( 'emulsion_post_display_date' ) ) ? ' has-date' : '';
		$class	 .= 'inline' == get_theme_mod( 'emulsion_post_display_author', emulsion_get_var( 'emulsion_post_display_author' ) ) ? ' has-author' : '';

		$text_posted_on	 = esc_html__( 'Posted on', 'emulsion-addons' );
		$text_by		 = esc_html__( 'by', 'emulsion-addons' );
		$author_url		 = get_author_posts_url( $post->post_author );
		$author_name	 = get_the_author_meta( 'display_name', $post->post_author );
		$format_type	 = get_theme_mod( 'emulsion_post_display_author_format', emulsion_get_var( 'emulsion_post_display_author_format' ) );

		if ( 'text' == $format_type ) {

			if ( is_author() ) {
				$author = get_the_author();
			} else {
				// filter: the_author_posts_link
				$author = get_the_author_posts_link();
			}
			if ( empty( $author ) ) {
				//single
				$author = sprintf( '<a href="%1$s" rel="author" class="url fn nickname">%2$s</a>', esc_url( $author_url ), esc_html( $author_name ) );
			}
		}
		if ( 'inline' == $format_type ) {

			$author_id	 = get_the_author_meta( 'ID' );
			$font_size	 = get_theme_mod( 'emulsion_widget_meta_font_size', emulsion_get_var( 'emulsion_widget_meta_font_size' ) );
			$avator_size = (int) $font_size * 1.5;
			$author		 = get_avatar( $author_id, $avator_size );
			$author		 = sprintf( '<a href="%1$s" rel="author" class="url fn nickname">%2$s<span class="screen-reader-text">%3$s</span></a>', esc_url( $author_url ), $author, $author_name );
			$class		 .= ' avatar-inline';
		}
		if ( 'block' == $format_type ) {

			$author_id	 = get_the_author_meta( 'ID' );
			$author		 = get_avatar( $author_id );
			$author		 = sprintf( '<a href="%1$s" rel="author" class="url fn nickname">%2$s<span class="screen-reader-text">%3$s</span></a>', esc_url( $author_url ), $author, $author_name );
			$class		 .= ' avatar-block';
		}


		$emulsion_post_id	 = get_the_ID();
		$comment_link		 = '';

		if ( false !== $emulsion_post_id && comments_open( $emulsion_post_id ) ) {

			$comment_link = wp_kses( emulsion_comment_link(), EMULSION_POST_META_DATA_ALLOWED_ELEMENTS );
		}

		$entry_month_html = wp_kses( emulsion_get_month_link(), EMULSION_POST_META_DATA_ALLOWED_ELEMENTS );

		$result = sprintf( $html, $text_posted_on, $entry_month_html, $text_by, $author, $comment_link, $class );

		return $result;
	}

}



if ( ! function_exists( 'emulsion_addons_the_post_meta_in' ) ) {

	/**
	 * Santize Posted in block and filter
	 * @return type
	 */
	function emulsion_addons_the_post_meta_in( $html ) {

		return wp_kses( $html, EMULSION_POST_META_DATA_ALLOWED_ELEMENTS );
	}

}



if ( ! function_exists( 'emulsion_addons_the_post_title' ) ) {

	/**
	 * Print post title
	 * @see emulsion_get_post_title()
	 * filter: emulsion_the_post_title
	 */
	function emulsion_addons_the_post_title( $title ) {

		echo wp_kses_post( $title );
	}

}


if ( ! function_exists( 'emulsion_addons_site_text_markup' ) ) {

	function emulsion_addons_site_text_markup( $html ) {

		return wp_kses_post( $html );
	}

}


if ( ! function_exists( 'emulsion_addons_the_site_title' ) ) {

	/**
	 * Print site title
	 * @see emulsion_get_site_title()
	 * filter: emulsion_the_site_title
	 */
	function emulsion_addons_the_site_title( $html ) {

		return wp_kses_post( $html );
	}

}


if ( ! function_exists( 'emulsion_addons_excerpt' ) ) {

	function emulsion_addons_excerpt( $html ) {

		return wp_kses( $html, EMULSION_EXCERPT_ALLOWED_ELEMENTS );
	}

}


if ( ! function_exists( 'emulsion_password_form' ) ) {

	function emulsion_password_form( $html ) {

		return wp_kses( $html, EMULSION_FORM_ALLOWED_ELEMENTS );
	}

}




if ( ! function_exists( 'emulsion_addons_current_layout_type' ) ) {

	/**
	 * Determine whether the current page is a grid layout or a stream layout
	 * @return string
	 */
	function emulsion_addons_current_layout_type( $type ) {

		$supports_stream = emulsion_get_supports( 'stream' );
		$supports_grid	 = emulsion_get_supports( 'grid' );
		$stream			 = emulsion_has_archive_format( $supports_stream );
		$grid			 = emulsion_has_archive_format( $supports_grid );

		if ( ! empty( $grid ) && empty( $stream ) ) {
			return 'grid';
		}
		if ( ! empty( $stream ) && empty( $grid ) ) {
			return 'stream';
		}
		if ( empty( $stream ) && empty( $grid ) ) {
			return 'list';
		}
	}

}



if ( ! function_exists( 'emulsion_addons_is_display_featured_image_in_the_loop' ) ) {

	/**
	 * Show post image in each loop pages ( archive ...)
	 * @return boolean
	 */
	function emulsion_addons_is_display_featured_image_in_the_loop( $bool ) {

		if ( is_home() ) {
			return get_theme_mod( 'emulsion_layout_homepage_post_image', emulsion_get_var( 'emulsion_layout_homepage_post_image' ) ) == 'show';
		}
		if ( emulsion_is_posts_page() ) {
			return get_theme_mod( 'emulsion_layout_posts_page_post_image', emulsion_get_var( 'emulsion_layout_posts_page_post_image' ) ) == 'show';
		}
		if ( is_date() ) {
			return get_theme_mod( 'emulsion_layout_date_archives_post_image', emulsion_get_var( 'emulsion_layout_date_archives_post_image' ) ) == 'show';
		}
		if ( is_category() ) {
			return get_theme_mod( 'emulsion_layout_category_archives_post_image', emulsion_get_var( 'emulsion_layout_category_archives_post_image' ) ) == 'show';
		}
		if ( is_tag() ) {
			return get_theme_mod( 'emulsion_layout_tag_archives_post_image', emulsion_get_var( 'emulsion_layout_tag_archives_post_image' ) ) == 'show';
		}
		if ( is_author() ) {
			return get_theme_mod( 'emulsion_layout_author_archives_post_image', emulsion_get_var( 'emulsion_layout_author_archives_post_image' ) ) == 'show';
		}
		if ( is_search() ) {
			return get_theme_mod( 'emulsion_layout_search_results_post_image', emulsion_get_var( 'emulsion_layout_search_results_post_image' ) ) == 'show';
		}
		return true;
	}

}

add_filter( 'emulsion_metabox_display_control', 'emulsion_addons_metabox_display_control', 11, 5 );

function emulsion_addons_metabox_display_control( $bool, $location, $post_id,
		$is_single, $is_page ) {

	global $post, $emulsion_supports;

	if ( false === emulsion_get_supports( 'metabox' ) ) {

		return true;
	}

	if ( 'style' == $location && metadata_exists( 'post', $post_id, 'emulsion_post_theme_style_script' ) ) {

		$setting = get_post_meta( $post_id, 'emulsion_post_theme_style_script', true );

		if ( 'no_bg' == $setting && $is_single ) {

			add_filter( 'emulsion_inline_style', 'emulsion_reset_no_bg' );
		}
		if ( 'no_style' == $setting && $is_single ) {

			return false;
		}
	}

	if ( 'sidebar' == $location && metadata_exists( 'post', $post_id, 'emulsion_post_sidebar' ) ) {

		$setting = get_post_meta( $post_id, 'emulsion_post_sidebar', true );


		if ( 'no_sidebar' == $setting && is_single() ) {

			return false;
		}
	}


	if ( 'header' == $location && metadata_exists( 'post', $post_id, 'emulsion_post_header' ) ) {

		$setting = get_post_meta( $post_id, 'emulsion_post_header', true );

		if ( 'no_bg' == $setting && $is_single ) {

			add_filter( 'theme_mod_emulsion_header_background_color', 'emulsion_header_background_color_reset', 11 );
		}
		if ( 'no_header' == $setting && $is_single ) {

			return false;
		}
	}
	if ( 'menu' == $location && metadata_exists( 'post', $post_id, 'emulsion_post_primary_menu' ) ) {

		$setting = get_post_meta( $post_id, 'emulsion_post_primary_menu', true );

		if ( 'no_menu' == $setting && $is_single ) {

			return false;
		}
	}
	if ( 'Background Image' == $location && metadata_exists( 'post', $post_id, 'emulsion_post_background_image' ) ) {

		$setting = get_post_meta( $post_id, 'emulsion_post_background_image', true );

		if ( 'no_background' == $setting && $is_single ) {

			return false;
		}
	}


	if ( 'page_header' == $location && metadata_exists( 'post', $post_id, 'emulsion_page_header' ) ) {

		$setting = get_post_meta( $post_id, 'emulsion_page_header', true );

		if ( 'no_bg' == $setting && $is_page ) {

			add_filter( 'theme_mod_emulsion_header_background_color', 'emulsion_header_background_color_reset' );
		}

		if ( 'no_header' == $setting && $is_page ) {

			return false;
		}
	}

	if ( 'page_sidebar' == $location && metadata_exists( 'post', $post_id, 'emulsion_page_sidebar' ) ) {

		$setting = get_post_meta( $post_id, 'emulsion_page_sidebar', true );

		if ( 'no_sidebar' == $setting && $is_page ) {

			return false;
		}
	}

	if ( 'page_style' == $location && metadata_exists( 'post', $post_id, 'emulsion_page_theme_style_script' ) ) {

		$setting = get_post_meta( $post_id, 'emulsion_page_theme_style_script', true );

		if ( 'no_bg' == $setting && $is_page ) {
			add_filter( 'emulsion_inline_style', 'emulsion_reset_no_bg' );
		}

		if ( 'no_style' == $setting && $is_page ) {

			return false;
		}
	}
	if ( 'page_menu' == $location && metadata_exists( 'post', $post_id, 'emulsion_page_primary_menu' ) ) {

		$setting = get_post_meta( $post_id, 'emulsion_page_primary_menu', true );

		if ( 'no_menu' == $setting && $is_page ) {

			return false;
		}
	}
	if ( 'Background Image' == $location && metadata_exists( 'post', $post_id, 'emulsion_page_background_image' ) ) {

		$setting = get_post_meta( $post_id, 'emulsion_page_background_image', true );

		if ( 'no_background' == $setting && $is_single ) {

			return false;
		}
	}

	return true;
}

function emulsion_description( $script ) {

	$script .= <<<SCRIPT
	jQuery(document).ready(function ($) {

    /**
     * when not exists meta description tag, add meta description tag
     *
     */
    function emulsion_get_meta(metaName) {
        const metas = document.getElementsByTagName('meta');
        for (let i = 0; i < metas.length; i++) {
            if (metas[i].getAttribute('name') === metaName) {
                return metas[i].getAttribute('content');
            }
        }
        return '';
    }
    if ('' == emulsion_get_meta('description') && 'none' !== emulsion_script_vars.meta_description) {
        $("head").append('<meta name="description" content="' + emulsion_script_vars.meta_description + '" />');
    }
});
SCRIPT;

	return $script;
}

function emulsion_addons_google_tracking_code() {

	$tag			 = sanitize_text_field( get_theme_mod( 'emulsion_google_analytics_tracking_code' ) );
	$flag			 = get_theme_mod( 'emulsion_instantclick', emulsion_get_var( 'emulsion_instantclick' ) ) ? 'enable' : 'disable';
	$theme_mod_name	 = 'emulsion_google_analytics_' . $tag . $flag;

	if ( $result = get_theme_mod( $theme_mod_name, false ) && $tag ) {

		//echo $result;
		//return;
	}

	if ( ! empty( $tag ) ) {

		$tracking_code = <<<CODE

<script async src="https://www.googletagmanager.com/gtag/js?id={$tag}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};

	gtag('js', new Date());

	gtag('config', '{$tag}');

</script>

CODE;

		set_theme_mod( $theme_mod_name, $tracking_code );
		echo $tracking_code;
	}
}

function emulsion_admin_bar_menu() {

	global $menu;

	if( ! function_exists( 'gutenberg_is_fse_theme' ) ) {

		return;
	}

	if ( ! gutenberg_is_fse_theme() || ! emulsion_get_supports( 'full_site_editor' ) ) {
		return;
	}

	if ( current_user_can( 'manage_options' ) ) {
		global $wp_admin_bar;

		if( 'off' == filter_input( INPUT_GET, 'fse' ) ) {
			$menu_title = esc_html__( 'FSE OFF', 'emulsion-addons' );
			$color = '<strong style="color:#fff;background:#ff0033;display:block;padding-left:8px;padding-right:8px;">';
		} elseif( 'transitional' == filter_input( INPUT_GET, 'fse' )  ) {
			$menu_title = esc_html__( 'FSE Transitional', 'emulsion-addons' );
			$color = '<strong style="color:#fff;background:#3498db;display:block;padding-left:8px;padding-right:8px;">';
		} else {
			$menu_title = esc_html__( 'FSE', 'emulsion-addons' );
			$color = '<strong style="color:#000;background:#90ee90;display:block;padding-left:8px;padding-right:8px;">';
		}

		if ( is_admin() ) {

			//$color = '<strong style="display:block;padding-left:8px;padding-right:8px;">';
		}

		$wp_admin_bar->add_menu( array(
			'parent' => 'top-secondary',
			'id'	 => 'fse_switch',
			'title'	 => $color . $menu_title . '</strong>',
			'href'	 => esc_url( remove_query_arg( 'fse' ) ),
		) );


		if ( ! filter_input( INPUT_GET, 'fse' ) ) {

			$wp_admin_bar->add_menu( array(
				'parent' => 'fse_switch',
				'id'	 => 'fse_switch_off',
				'title'	 => esc_html__( 'fse-off', 'emulsion-addons' ),
				'href'	 => esc_url( add_query_arg( array( 'fse' => 'off' ) ) ),
			) );
			$wp_admin_bar->add_menu( array(
				'parent' => 'fse_switch',
				'id'	 => 'fse_switch_transitional',
				'title'	 => esc_html__( 'fse-transitional', 'emulsion-addons' ),
				'href'	 => esc_url( add_query_arg( array( 'fse' => 'transitional' ) ) ),
			) );

			$wp_admin_bar->add_menu( array(
				'parent' => 'fse_switch',
				'id'	 => 'emulsion_fse_template',
				'title'	 => esc_html__( 'wp template', 'emulsion-addons' ),
				'href'	 => esc_url( get_admin_url( NULL, 'edit.php?post_type=wp_template' ) ),
			) );

			$wp_admin_bar->add_menu( array(
				'parent' => 'fse_switch',
				'id'	 => 'emulsion_fse_template_part',
				'title'	 => esc_html__( 'wp template part', 'emulsion-addons' ),
				'href'	 => esc_url( get_admin_url( NULL, 'edit.php?post_type=wp_template_part' ) ),
			) );
		} else {
			$wp_admin_bar->add_menu( array(
				'parent' => 'fse_switch',
				'id'	 => 'fse_switch_off',
				'title'	 => esc_html__( 'fse-off', 'emulsion-addons' ),
				'href'	 => esc_url( add_query_arg( array( 'fse' => 'off' ) ) ),
			) );
			$wp_admin_bar->add_menu( array(
				'parent' => 'fse_switch',
				'id'	 => 'fse_switch_on',
				'title'	 => esc_html__( 'fse-on', 'emulsion-addons' ),
				'href'	 => esc_url( remove_query_arg( 'fse' ) ),
			) );
			$wp_admin_bar->add_menu( array(
				'parent' => 'fse_switch',
				'id'	 => 'fse_switch_transitional',
				'title'	 => esc_html__( 'fse-transitional', 'emulsion-addons' ),
				'href'	 => esc_url( add_query_arg( array( 'fse' => 'transitional' ) ) ),
			) );

		}

		if ( ! is_admin() ) {

			$view_currrent = emulsion_do_fse()
					? esc_html__( 'Being displayed in FSE Template', 'emulsion-addons' )
					: esc_html__( 'being displayed in Theme Template', 'emulsion-addons' );

			$wp_admin_bar->add_menu( array(
				'parent' => 'fse_switch',
				'id'	 => 'fse_current_view',
				'title'	 => $view_currrent,
				'href'	 => '',

			) );
		}
	}
}
