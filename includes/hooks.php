<?php

add_action( 'after_setup_theme', 'emulsion_addons_hooks_setup' );

function emulsion_addons_hooks_setup() {

 ! class_exists( 'WP_List_Table' ) ? require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ) : '';

/*
	if ( function_exists( 'emulsion_is_plugin_active' ) && function_exists('emulsion_set_wp_scss_options') && emulsion_is_plugin_active( 'wp-scss/wp-scss.php' ) && 'active' !== get_theme_mod( 'emulsion_wp_scss_status', false ) ) {

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
 *
 */

	add_filter( 'emulsion_inline_style', 'emulsion_styles' );
	add_filter( 'wp_list_categories', 'emulsion_category_link_format', 10, 2 );
	function_exists( 'emulsion_keyword_with_mark_elements_title' ) && ! is_admin() ? add_filter( 'the_title', 'emulsion_keyword_with_mark_elements_title', 99999 ) : '';
	function_exists( 'emulsion_keyword_with_mark_elements' ) && ! is_admin() ? add_filter( 'the_content', 'emulsion_keyword_with_mark_elements', 99999 ) : '';

	add_filter( 'get_archives_link', 'emulsion_archive_link_format', 10, 6 );
	add_filter( 'the_content_more_link', 'emulsion_read_more_link' );
	add_filter( 'emulsion_footer_text', 'capital_P_dangit', 11 );
	add_filter( 'emulsion_footer_text', 'wptexturize' );
	add_filter( 'emulsion_footer_text', 'convert_smilies', 20 );
	add_filter( 'emulsion_footer_text', 'wpautop' );
	add_filter( 'do_shortcode_tag', 'emulsion_shortcode_wrapper', 10, 4 );
	add_filter( 'admin_body_class', 'emulsion_admin_body_class' );
	//add_filter( 'body_class', 'emulsion_brightness_class', 15 );
	add_filter( 'body_class', 'emulsion_addons_body_class' );
	add_filter( 'dynamic_sidebar_params', 'emulsion_footer_widget_params' );
	add_filter( 'post_class', 'emulsion_add_woocommerce_class_to_post' );

	! empty(get_theme_mod('emulsion_header_html') ) ? add_filter( 'theme_mod_emulsion_header_html', 'apply_shortcodes' ): '';
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

		$tag_class		 = sanitize_html_class( $tag );
		$element		 = 'span';
		$element_types	 = array( '<div', '<dl', '<ul', '<ol', '<p', '<table', '<aside', '<nav', '<address', '<blockquote', '<!-- wp:' );



		foreach ( $element_types as $block ) {

			if ( false !== strstr( $output, $block ) ) {

				$element = 'div';
				break;
			}
		}



		$element = apply_filters( 'emulsion_shortcode_wrapper_'. $tag, $element );

		$output = sprintf( '<%3$s class="shortcode-wrapper wrap-%2$s">%1$s</%3$s>', $output, $tag_class, $element );

		return $output;
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



		$style = '';

		$style	 .= emulsion_term_duplicate_link_hide( '' );
		$style	 .= emulsion_smart_category_highlight( '' );
		$style	 .= emulsion_adminbar_css( '' );

		//$style	 .= emulsion_widget_meta_font_css( '' );
		$style	 .= emulsion_block_latest_posts_excerpt( '' );

		if( is_user_logged_in() && function_exists('emulsion__css_variables')) {

			//$style .= emulsion_dinamic_css( '' );
			$style .= emulsion__css_variables( '' );

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

		$excerpt_lines	 = absint( get_theme_mod( 'emulsion_excerpt_length_grid', emulsion_get_var( 'emulsion_excerpt_length_grid' ) ) );
		$style			 = '';

		if ( function_exists( 'emulsion_lang_cjk' ) && emulsion_lang_cjk() ) {

			$style = <<<CSS

body .wp-block-latest-posts > li .wp-block-latest-posts__post-excerpt{
	height:calc( var(--thm_meta_data_font_size) * var(--thm_content_line_height) * $excerpt_lines );
	overflow:hidden;
}

CSS;
			return $css . $style;
		}

		return $css;
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


function emulsion_addons_google_tracking_code() {

	$tag			 = sanitize_text_field( get_theme_mod( 'emulsion_google_analytics_tracking_code' ) );
	$theme_mod_name	 = 'emulsion_google_analytics_' . $tag;

	if ( ! empty( $tag ) ) {

		$tracking_code = <<<CODE

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id={$tag}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{$tag}');
</script>
CODE;

		set_theme_mod( $theme_mod_name, $tracking_code );
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
			$theme_classes	 = str_replace( array( 'noscript','is-loop', 'is-light', 'layout-list' ), '', $theme_classes );

			return $classes . ' '. $theme_classes . $emulsion_brightnes . $color_for_editor_class . $block_editor_class_name;
		}

		return $classes;
	}

}
/**
 * Posts Table column template
 */

//if ( current_user_can( 'edit_theme_options' ) ) {

	add_filter( 'manage_posts_columns', 'emulsion_posts_table_add_column' );
	add_filter( 'manage_pages_columns', 'emulsion_posts_table_add_column' );
	add_action( 'manage_posts_custom_column', 'emulsion_posts_table_template_data', 10, 2 );
	add_action( 'manage_pages_custom_column', 'emulsion_posts_table_template_data', 10, 2 );
	add_action( 'restrict_manage_posts', 'emulsion_posts_table_template_dropdown' );
	add_filter( 'query_vars', 'emulsion_posts_table_query_var_template' );
	add_filter( 'posts_where', 'emulsion_posts_table_post_where' );
//}

function emulsion_posts_table_add_column( $columns ) {

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return $columns;
	}

	$new_columns = array();

	foreach ( $columns as $key => $value ) {
		if ( $key === 'author' ) {

			$new_columns['template'] = esc_html__( 'Template', 'emulsion' );
		}
		$new_columns[$key] = $value;
	}

	return $new_columns;
}
//https://www.tenman.info/wp-37/wp-admin/themes.php?page=gutenberg-edit-site&postType=wp_template&postId=emulsion%2F%2Fsingle-with-toc


function emulsion_posts_table_template_data( $column, $post_id ) {

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	switch ( $column ) {

		case 'template':
			$post_id = get_the_ID();
			$templates			 = get_page_templates();
			$current_template	 = sanitize_text_field( get_post( $post_id )->page_template );
			$result				 = ! empty( get_query_var( 'template' ) ) ? sanitize_text_field( get_query_var( 'template' ) ) : esc_html__( 'Default', 'emulsion' );
			$template_id		 = 'emulsion//' . $current_template;

			$link_flag			 = true;

			if ( 'php' == pathinfo( $current_template, PATHINFO_EXTENSION ) ) {

				$link_url = esc_url( admin_url( 'index.php' ) );
				$link_flag = false;

			} else {

				$link_url =  add_query_arg( array( 'postType' => 'wp_template', 'postId' => $template_id ), admin_url( 'site-editor.php' ) ) ;
				$post_edit_url = add_query_arg( array( 'postType' => 'post', 'postId' => $post_id ,'canvas' => 'edit'), admin_url( 'site-editor.php' ) ) ;
			}
			if ( true === $link_flag ) {
				$link_url = esc_url( wp_nonce_url( $link_url, 'emulsion-link-to-template', 'emulsion_template_nonce' ) );
				$post_edit_url = esc_url( wp_nonce_url( $post_edit_url, 'emulsion-post-edit-site-editor', 'emulsion_template_nonce' ) );
			}

			foreach ( $templates as $template_name => $file_name ) {

				if ( $file_name === $current_template ) {

					if ( true === $link_flag ) {
						$result = sprintf( '<a href="%1$s">%2$s</a>', $link_url, $current_template );
						$result .= sprintf( '<br /><a href="%1$s">%2$s</a>', $post_edit_url, esc_html__('Edit (editor)') );
					} else {
						$result = $current_template;
					}
				}
			}

			echo $result;
			break;
	}
}

function emulsion_posts_table_template_dropdown() {

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$post_type	 = get_post_type();
	$args		 = array(
		'posts_per_page' => -1,
		'post_type'		 => $post_type,
	);
	$posts		 = get_posts( $args );

	for ( $i = 0; $i < count( $posts ); $i ++ ) {
		$value					 = sanitize_text_field( get_post_meta( $posts[$i]->ID, '_wp_page_template', true ) );
		$current_template[$i]	 = $value;
	}

	$current_template	 = array_unique( $current_template );
	$current_template	 = array_values( $current_template );
	$template_query		 = filter_input( INPUT_GET, 'template' );
	$template			 = get_page_templates();

	echo '<select name="template">';

	printf( '<option value="">All Templates</option>', esc_html__( 'All Templates' ), 'emulsion' );
	if ( ! empty( $template_query ) && $template_query === 'default' ) {

		printf( '<option selected value="%2$s">%1$s</option>', esc_html__( 'Default Template', 'emulsion' ), 'default' );
	} else {

		printf( '<option value="%2$s">%1$s</option>', esc_html__( 'Default Template', 'emulsion' ), 'default' );
	}

	foreach ( $template as $template_name => $file_name ) {

		for ( $i = 0; $i < count( $current_template ); $i ++ ) {

			if ( $current_template[$i] === $file_name && ! empty( $template_query ) && $template_query === $file_name ) {

				printf( '<option selected value="%1$s">%2$s</option>', $file_name, $template_name );
			} elseif ( $current_template[$i] === $file_name ) {

				printf( '<option value="%1$s">%2$s</option>', $file_name, $template_name );
			}
		}
	}
	echo '</select>';
}

function emulsion_posts_table_query_var_template( $vars ) {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return $vars;
	}
	$vars[] = 'template';
	return $vars;
}

function emulsion_posts_table_post_where( $where ) {

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return $where;
	}

	global $wpdb;

	$template = get_query_var( 'template' );

	if ( ! empty( $template ) ) {

		$where .= $wpdb->prepare( "AND EXISTS (SELECT * FROM {$wpdb->postmeta} as m WHERE m.post_id = {$wpdb->posts}.ID AND m.meta_key='_wp_page_template' AND m.meta_value = %s)", $template );
	}

	return $where;
}
