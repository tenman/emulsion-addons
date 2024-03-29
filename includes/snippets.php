<?php

/**
 * This file is the first place where features added experimentally with theme updates are created.
 * Scripts and styles are processed in a lump without being distributed to each CSS and PHP.
 *
 */
add_action( 'template_redirect', 'emulsion_snippet_functions');

/**
 * register snippet functions
 */
function emulsion_snippet_functions() {

	if ( 'custom' == get_theme_mod( 'emulsion_header_layout', 'custom' ) ) {

		/**
		 * Header CTA Button
		 */
		emulsion_append_header_layer_snippet( 'emulsion_append_header_layer', 'action' );
	}

	/**
	 * Plugin Breadcrumb NavXT
	 * https://ja.wordpress.org/plugins/breadcrumb-navxt/
	 */
	if ( ! is_front_page() && 'no_header' !== $has_theme_header = get_post_meta(get_the_ID(), 'emulsion_post_header', true ) ) {

		emulsion_article_after( 'emulsion_prepend_page_wrapper', 'action' );
	}

	/**
	 * background CSS patturen
	 * Experimental filters for future updates
	 */
	//emulsion_background_css_pattern( 'body_class', $type = 'filter' );
}

/**
 * Snippet Functions
 */
if ( ! function_exists( 'emulsion_append_header_layer_snippet' ) ) {

	/**
	 * Header CTA Button
	 */
	function emulsion_append_header_layer_snippet( $hook, $type = 'action',
			$css = '', $js = '', $html = '' ) {

		$defaults = array(
			'menu_class'		 => 'cta',
			'container'			 => 'div',
			'fallback_cb'		 => '',
			'container_class'	 => 'cta-layer',
			'link_before'		 => '',
			'link_after'		 => '',
			'echo'				 => false,
			'depth'				 => 1,
			'theme_location'	 => 'header',
			'items_wrap'		 => '%3$s',
			'walker'			 => new emulsion_Cta_Layer_Nav_Menu_Walker(),
			'item_spacing'		 => 'discard',
		);

		$html = wp_nav_menu( $defaults );

		$css = '';

		$js = '';

			emulsion_do_snippet( $hook, $type, $css, $js, $html );

	}

}
if ( ! function_exists( 'emulsion_article_after' ) ) {

	/**
	 * Plugin Breadcrumb NavXT
	 * https://ja.wordpress.org/plugins/breadcrumb-navxt/
	 */
	function emulsion_article_after( $hook, $type = 'action', $css = '', $js = '',
			$html = '' ) {

		if ( function_exists( 'bcn_display' ) ) {
			$html	 = '<div class="breadcrumbs fit" typeof="BreadcrumbList" vocab="https://schema.org/BreadcrumbList">';
			$html	 .= bcn_display( true );
			$html	 .= '</div>';
		}

		$css = '.is-presentation-theme div.breadcrumbs{font-size:var(--thm_meta_data_font_size);color:var(--thm_general_text_color); }';
		$js	 = '';

		emulsion_do_snippet( $hook, $type, $css, $js, $html );
	}

}

/**
 * Snippet helper function
 */
if ( ! class_exists( 'emulsion_Cta_Layer_Nav_Menu_Walker' ) ) {

	class emulsion_Cta_Layer_Nav_Menu_Walker extends Walker_Nav_Menu {

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $wp_query;

			$classes = emulsion_class_name_sanitize( implode(' ', $item->classes ) );

			$attributes	 = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
			$attributes	 .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
			$attributes	 .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
			$attributes	 .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
			$attributes	 .= ' class="skin-button '. $classes. '"';

			$item_output = $args->before;
			$item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		public function end_el( &$output, $item, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t	 = '';
				$n	 = '';
			} else {
				$t	 = "\t";
				$n	 = "\n";
			}
			$output .= "{$n}";
		}

	}

}
if ( ! function_exists( 'emulsion_background_css_pattern' ) ) {

	function emulsion_background_css_pattern( $hook, $type = 'action', $css = '', $js = '',
			$html = '' ) {

	//	if ( emulsion_get_supports( 'background_css_pattern' ) ) {

			$html							 = array();
			$background_css_pattern_class	 = get_theme_mod( 'emulsion_background_css_pattern', emulsion_get_var( 'emulsion_background_css_pattern' ) );

			if ( 'none' !== $background_css_pattern_class ) {
				$class_name	 = 'background-css-pattern-' . $background_css_pattern_class;
				$html[]		 = $class_name;
			}
	//	}


		$js = '';
		emulsion_do_snippet( $hook, $type, $css, $js, $html );
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