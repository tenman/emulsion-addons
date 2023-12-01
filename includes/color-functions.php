<?php


/**
 * The argument check has been added to the following functions.
 * If an invalid color value is added to the argument, red will return.
 *
 * emulsion_rgb2hex,
 * emulsion_the_hex2rgb,
 * emulsion_the_hex2rgba,
 * emulsion_the_hex2hsla,
 * emulsion_contrast_color,
 * @since ver1.1.6
 */
if ( ! function_exists( 'emulsion_rgb2hex' ) ) {

	function emulsion_rgb2hex( $rgb = array( 0, 0, 0 ) ) {

		$is_valid = emulsion_color_value_validate( $rgb, 'rgb' );

		if ( ! $is_valid ) {

			return '#ff0000';
		}

		return '#' . str_pad( dechex( $rgb[0] ), 2, '0', STR_PAD_LEFT ) .
				str_pad( dechex( $rgb[1] ), 2, '0', STR_PAD_LEFT ) .
				str_pad( dechex( $rgb[2] ), 2, '0', STR_PAD_LEFT );
	}

}

if ( ! function_exists( 'emulsion_the_hex2rgb' ) ) {

	/**
	 * Convert hex color to rgba color
	 * @param type $hex
	 * @param type $alpha
	 * @return type
	 */
	function emulsion_the_hex2rgb( $hex = '#000' ) {

		if ( list($r, $g, $b) = emulsion_get_hex2rgb_array( $hex ) ) {

			return sprintf( 'rgba( %1$d, %2$d, %3$d )', $r, $g, $b );
		}

		return $hex;
	}

}
if ( ! function_exists( 'emulsion_the_hex2rgba' ) ) {

	/**
	 * Convert hex color to rgba color
	 * @param type $hex
	 * @param type $alpha
	 * @return type
	 */
	function emulsion_the_hex2rgba( $hex = '#000', $alpha = 1 ) {

		$is_valid_alpha = emulsion_color_value_validate( $alpha, 'alpha' );

		if ( ! $is_valid_alpha ) {

			$alpha = 1;
		}

		if ( list($r, $g, $b) = emulsion_get_hex2rgb_array( $hex ) ) {

			return sprintf( 'rgba( %1$d, %2$d, %3$d, %4$.1F)', $r, $g, $b, $alpha );
		}

		return $hex;
	}

}
if ( ! function_exists( 'emulsion_the_hex2hsla' ) ) {

	/**
	 * Convert hex color to hsla color
	 * @param type $hex
	 * @param type $alpha
	 * @return type
	 */
	function emulsion_the_hex2hsla( $hex = '', $alpha = 1 ) {

		if ( empty( $hex ) ) {

			$hex = emulsion_the_background_color();
		}

		$is_valid_alpha = emulsion_color_value_validate( $alpha, 'alpha' );

		if ( ! $is_valid_alpha ) {
			$alpha = 1;
		}

		if ( list($r, $g, $b) = emulsion_get_hex2hsl_array( $hex ) ) {

			return sprintf( 'hsla( %1$d, %2$s, %3$s, %4$.1F)', $r, $g . '%', $b . '%', $alpha );
		}

		return $hex;
	}

}



if ( ! function_exists( 'emulsion_sub_background_color_darken' ) ) {

	/**
	 * Create hover color
	 *
	 * @param type $hex
	 * @param type $alpha
	 * @param type $hue
	 * @param type $saturation
	 * @param type $lightness
	 * @return type
	 */
	function emulsion_sub_background_color_darken() {

		$hex = emulsion_the_background_color();
		if ( '#ffffff' == $hex ) {
			$hex = '#efefef';
		}
		if ( '#000000' == $hex ) {
			$hex = '#111111';
		}
		$hue		 = emulsion_get_hex2hsl_array( $hex )[0];
		$saturation	 = emulsion_get_hex2hsl_array( $hex )[1];
		$lightness	 = emulsion_get_hex2hsl_array( $hex )[2];
		$alpha		 = 1;

		if ( 0 == $hue ) {
			$lightness = $lightness > 0 ? $lightness * 0.80 : 0;
			return emulsion_accent_color( $hex, $alpha, $hue, $saturation, $lightness );
		} else {
			//$saturation = $saturation > 0 ? $saturation * 0.9: 0;
			$lightness = $lightness > 0 ? $lightness * 0.85 : 0;
			return emulsion_accent_color( $hex, $alpha, $hue, $saturation, $lightness );
		}
	}

}
if ( ! function_exists( 'emulsion_sub_background_color_lighten' ) ) {

	function emulsion_sub_background_color_lighten() {

		$hex = emulsion_the_background_color();
		if ( '#ffffff' == $hex ) {
			$hex = '#efefef';
		}
		if ( '#000000' == $hex ) {
			$hex = '#111111';
		}
		$hue		 = intval( emulsion_get_hex2hsl_array( $hex )[0] );
		$saturation	 = intval( emulsion_get_hex2hsl_array( $hex )[1] );
		$lightness	 = intval( emulsion_get_hex2hsl_array( $hex )[2] );
		$alpha		 = 1;


		if ( 0 == $hue ) {
			$lightness = $lightness > 0 ? $lightness * 1.25 : 0;
			if ( $lightness > 100 ) {
				$lightness = 100;
			}

			return emulsion_accent_color( $hex, $alpha, $hue, $saturation, $lightness );
		} else {
			if ( $saturation > 100 ) {
				$saturation = 100;
			}
			$lightness = $lightness > 0 ? $lightness * 1.25 : 0;
			if ( $lightness > 100 ) {
				$lightness = 100;
			}
			return emulsion_accent_color( $hex, $alpha, $hue, $saturation, $lightness );
		}
	}

}

/**
 *  Create Accent color
 * @param type $hex
 * @param type $alpha
 * @param type $hue
 * @param type $saturation
 * @param type $lightness
 * @return type
 */
function emulsion_accent_color( $hex = '', $alpha = 1, $hue = '',
		$saturation = '', $lightness = '' ) {

	$emulsion_contrast_color = emulsion_contrast_color();

	if ( empty( $hex ) ) {

		$hex		 = emulsion_the_background_color();
		$hsl_array	 = emulsion_get_hex2hsl_array( $hex );
		$hue		 = (int) $hsl_array[0] + $hue;
	}
	if ( ! empty( $hex ) && empty( $hue ) ) {

		$hsl_array	 = emulsion_get_hex2hsl_array( $hex );
		$hue		 = (int) $hsl_array[0];
	}

	if ( '#ffffff' == $emulsion_contrast_color && empty( $saturation ) && empty( $lightness ) ) {

		$saturation	 = empty( $saturation ) ? 100 : $saturation;
		$lightness	 = empty( $lightness ) ? 30 : $lightness;
	}

	if ( '#333333' == $emulsion_contrast_color && empty( $saturation ) && empty( $lightness ) ) {

		$saturation	 = empty( $saturation ) ? 70 : $saturation;
		$lightness	 = empty( $lightness ) ? 30 : $lightness;
	}

	if ( $hue > 360 ) {
		$hue = $hue - 360;
	}
	if ( $saturation > 100 ) {
		$saturation = 100;
	}
	if ( $lightness > 100 ) {
		$lightness = 100;
	}


	$hue		 = absint( $hue ) . 'deg';
	$saturation	 = absint( $saturation ) . '%';
	$lightness	 = absint( $lightness ) . '%';
	$alpha		 = floatval( $alpha );
	return sprintf( 'hsla(%1$s,%2$s,%3$s,%4$s)', $hue, $saturation, $lightness, $alpha );
}

if ( ! function_exists( 'emulsion_get_hex2hsl_array' ) ) {

	/**
	 * eturn hsl array from hex color
	 * @param type $hex
	 * @return type
	 */
	function emulsion_get_hex2hsl_array( $hex ) {

		$is_valid			 = emulsion_color_value_validate( $hex, 'hex' );
		$is_valid_no_hash	 = emulsion_color_value_validate( $hex, 'hex_no_hash' );

		if ( ! $is_valid ) {

			if ( ! $is_valid_no_hash ) {

				return array( 0, 100, 50 );
			}
		}

		if ( list( $r, $g, $b ) = emulsion_get_hex2rgb_array( $hex ) ) {

			$r	 = max( min( intval( $r, 10 ) / 255, 1 ), 0 );
			$g	 = max( min( intval( $g, 10 ) / 255, 1 ), 0 );
			$b	 = max( min( intval( $b, 10 ) / 255, 1 ), 0 );
			$max = max( $r, $g, $b );
			$min = min( $r, $g, $b );
			$l	 = ($max + $min) / 2;

			if ( $max !== $min ) {

				$d	 = $max - $min;
				$s	 = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
				if ( $max === $r ) {
					$h = ($g - $b) / $d + ($g < $b ? 6 : 0);
				} else if ( $max === $g ) {
					$h = ($b - $r) / $d + 2;
				} else {
					$h = ($r - $g) / $d + 4;
				}
				$h = $h / 6;
			} else {

				$h	 = $s	 = 0;
			}
			return array( round( $h * 360 ), round( $s * 100 ), round( $l * 100 ) );
		}
	}

}

function emulsion_comment_brightness_class() {
	$comment_bg_color = get_theme_mod( 'emulsion_comments_bg', emulsion_get_var( 'emulsion_comments_bg' ) );

	$class = '#ffffff' == emulsion_contrast_color( $comment_bg_color ) ? 'comment-is-dark' : 'comment-is-light';

	echo esc_attr( $class );
}

if ( ! function_exists( 'emulsion_brightness_dark_class' ) ) {

	/**
	 * remove is-light class and add is-dark class from Classes array
	 * @param type $classes
	 * @return type
	 */
	function emulsion_brightness_dark_class( $classes ) {

		$classes[] = 'is-dark';

		$classes = array_diff( $classes, array( 'is-light' ) );
		$classes = array_values( $classes );

		return $classes;
	}

}

if ( ! function_exists( 'emulsion_brightness_light_class' ) ) {

	/**
	 * remove is-dark class and add is-lightclass from Classes array
	 * @param type $classes
	 * @return type
	 */
	function emulsion_brightness_light_class( $classes ) {

		$classes[] = 'is-light';

		$classes = array_diff( $classes, array( 'is-dark' ) );
		$classes = array_values( $classes );

		return $classes;
	}

}


if ( ! function_exists( 'emulsion_get_background_color' ) ) {

	/**
	 *
	 * @return type
	 */
	function emulsion_get_background_color() {

		$background_color = get_background_color();

		if ( empty( $background_color ) ) {

			$theme_default		 = get_theme_support( 'custom-background', 'default-color' );
			$background_color	 = $theme_default ? $theme_default : 'ffffff';
		}


		$background_color	 = sprintf( '#%1$s', $background_color );
		$background_color	 = sanitize_hex_color( $background_color );

		return apply_filters( 'emulsion_get_background_color', $background_color );
	}

}



if ( ! function_exists( 'emulsion_get_color_palette' ) ) {

	/**
	 * get color pallet value
	 * @return string
	 */
	function emulsion_get_color_palette() {

		$color_palette_vals			 = get_theme_support( 'editor-color-palette' );
		$disable_color_palette_vals	 = get_theme_support( 'disable-custom-colors' );
		$color_palettes				 = '';

		if ( isset( $color_palette_vals ) && is_array( $color_palette_vals ) && ! $disable_color_palette_vals ) {

			foreach ( $color_palette_vals[0] as $palet_val ) {
				$color_palettes .= sprintf( '%1$s %2$s,', $palet_val['slug'], $palet_val['color'] );
			}

			$color_palettes = trim( $color_palettes, "," );
		} else {
			// gutenberg default values
			$color_palettes = "pale-pink #f78da7,vivid-red #cf2e2e,luminous-vivid-orange #ff6900,luminous-vivid-amber #fcb900,light-green-cyan #7bdcb5,vivid-green-cyan #00d084,pale-cyan-blue #8ed1fc,vivid-cyan-blue #0693e3,very-light-gray #eee,cyan-bluish-gray #abb8c3,very-dark-gray #313131";
		}
		return $color_palettes;
	}

}

if ( ! function_exists( 'emulsion_upload_base_dir' ) ) {

	/**
	 * Theme Image Directory
	 * for scss variable
	 * Not support uploads_use_yearmonth_folders
	 */
	function emulsion_upload_base_dir() {

		$upload_base_dir = '';

		$holder = get_option( 'uploads_use_yearmonth_folders' );

		if ( ! empty( $holder ) ) {
			return $upload_base_dir;
		}

		$upload_dir		 = wp_upload_dir();
		$url			 = esc_url( $upload_dir['baseurl'] . '/' );
		$upload_base_dir = wp_make_link_relative( $url );

		return $upload_base_dir;
	}

}

if ( ! function_exists( 'emulsion_header_image_ratio' ) ) {

	/**
	 * header image ratio
	 * Todo: can not give out the ratio of all header images
	 * Currently, I want the size of the header image to be unified
	 */
	function emulsion_header_image_ratio() {

		$header_width		 = get_custom_header()->width;
		$header_height		 = get_custom_header()->height;
		$header_image_ratio	 = 0.5625;

		if ( is_singular() && has_post_thumbnail() ) {

			$post_id			 = get_the_ID();
			$post_thumbnail_id	 = get_post_thumbnail_id( $post_id );
			$attachment			 = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
			$header_width		 = $attachment[1];
			$header_height		 = $attachment[2];
			$header_image_ratio	 = floatval( $header_height / $header_width );
		}

		if ( ! empty( $header_width ) && ! empty( $header_height ) && ! is_singular() ) {

			$header_image_ratio = floatval( $header_height / $header_width );
		}

		if ( is_float( $header_image_ratio ) ) {

			return $header_image_ratio;
		} else {
			return 0.5625;
		}
	}

}

if ( ! function_exists( 'emulsion_sidebar_background' ) ) {

	/**
	 * Return sidebar color calculated from background color
	 * @return string
	 */
	function emulsion_sidebar_background() {

		$background_color	 = emulsion_get_background_color();
		$background_color	 = empty( $background_color ) ? '#ffffff' : $background_color;
		$background_default	 = get_theme_support( 'custom-background', 'default-color' );
		$background_default	 = empty( $background_color ) ? '#ffffff' : $background_default;

		$text_color = emulsion_contrast_color( $background_color );

		if ( '#ffffff' == $text_color ) {

			if ( $background_default !== $background_color ) {

				$sidebar_background = '#000000';
			} else {

				$sidebar_background = 'inherit';
			}
			$sidebar_background = apply_filters( 'emulsion_sidebar_background_dark', $sidebar_background );
		}
		if ( '#333333' == $text_color ) {

			if ( $background_default !== $background_color ) {


				$sidebar_background = '#ffffff';
			} else {

				$sidebar_background = 'inherit';
			}
			$sidebar_background = apply_filters( 'emulsion_sidebar_background_light', $sidebar_background );
		}

		return apply_filters( 'emulsion_sidebar_background', $sidebar_background );
	}

}

if ( ! function_exists( 'emulsion_hover_colors' ) ) {

	/**
	 * Returns the hover color calculated from the background color
	 * The hover color mainly applies to .entry-content links. Hover colors such as headers and sidebars are defined in CSS
	 * for customizer link hover setting
	 * @return type
	 */
	function emulsion_hover_colors( $hex_color = '', $location = '' ) {

		$text_color = emulsion_contrast_color( $hex_color );

		if ( '#ffffff' == $text_color ) {

			$hover_color = apply_filters( 'emulsion_hover_color_article_dark', $text_color );
		}
		if ( '#333333' == $text_color ) {

			$hover_color = apply_filters( 'emulsion_hover_color_article_light', $text_color );
		}
		if ( ! empty( $location ) ) {

			$hover_color = apply_filters( 'emulsion_link_color_' . $location, $hover_color );
		}
		return apply_filters( 'emulsion_hover_color', $hover_color );
	}

}


if ( ! function_exists( 'emulsion_link_colors' ) ) {

	/**
	 * Return link color calculated from background color
	 * CSS variables
	 * @return hex color
	 */
	function emulsion_link_colors( $hex_color = '', $location = '' ) {



		$text_color = emulsion_contrast_color( $hex_color );

		if ( 'gallery' == $location ) {

			return apply_filters( 'emulsion_link_color_gallery', '#cccccc' );
		}

		if ( '#ffffff' == $text_color ) {

			$link_color = apply_filters( 'emulsion_link_color_dark_' . $location, '#cccccc' );
		}
		if ( '#333333' == $text_color ) {

			$link_color = apply_filters( 'emulsion_link_color_light' . $location, '#666666' );
		}

		if ( ! empty( $location ) ) {

			$link_color = apply_filters( 'emulsion_link_color_' . $location, $link_color );
		}

		return apply_filters( 'emulsion_link_color', $link_color );
	}

}

function emulsion_sidebar_background_reset() {

	return emulsion_background_color_reset();
}

function emulsion_sidebar_text_color_reset() {

	$background = emulsion_sidebar_background_reset();

	return emulsion_contrast_color( $background );
}

function emulsion_sidebar_link_color_reset() {

	$background = emulsion_sidebar_background_reset();

	return emulsion_link_colors( $background );
}

function emulsion_header_background_color_reset() {

	return emulsion_get_var( 'emulsion_header_background_color', 'default' );
}

function emulsion_header_text_color_reset() {

	$background = emulsion_header_background_color_reset();

	return emulsion_contrast_color( $background );
}

function emulsion_header_link_color_reset() {

	$background = emulsion_sidebar_background_reset();

	return emulsion_link_colors( $background );
}

function emulsion_background_color_reset() {

	return sprintf( '#%1$s', get_theme_support( 'custom-background', 'default-color' ) );
}

function emulsion_general_text_color_reset() {

	$default_background = emulsion_background_color_reset();

	return emulsion_contrast_color( $default_background );
}

function emulsion_general_link_color_reset() {

	$default_background	 = emulsion_background_color_reset();
	$link_color			 = emulsion_link_colors( $default_background );

	return $link_color;
}

function emulsion_primary_menu_background_reset() {

	return emulsion_background_color_reset();
}

function emulsion_primary_menu_link_color_reset() {

	$background = emulsion_primary_menu_background_reset();

	return emulsion_link_colors( $background );
}

function emulsion_primary_menu_text_color_reset() {

	$background = emulsion_primary_menu_background_reset();

	return emulsion_contrast_color( $background );
}
/*
function emulsion_get_template_part_css_selectors( $name = null,
		$template_slug = 'template-parts/content.php' ) {

	$name = (string) $name;

	$template_path = get_theme_file_path( $template_slug );

	if ( ! file_exists( $template_path ) || empty( $name ) ) {
		return '';
	}

	$stream_conditionals = emulsion_get_supports( $name );
	$stream_classes		 = '';
	$custom_post_type	 = '';
	$custom_post_types	 = '';

	if ( ! empty( $stream_conditionals[0] ) ) {

		foreach ( $stream_conditionals[0] as $key => $class ) {

			if ( $key !== 0 && 'post_type' == $key ) {

				if ( is_array( $class ) ) {

					foreach ( $class as $custom_post_type ) {

						$custom_post_types .= '.post-type-archive-' . sanitize_html_class( $custom_post_type ) . ',';
					}
					$custom_post_type = $custom_post_types;
				} else {

					$custom_post_type .= '.post-type-archive-' . sanitize_html_class( $class ) . ',';
				}

				$stream_classes .= $custom_post_type;
			} elseif ( 'post_type' !== $key ) {

				if ( is_array( $class ) ) {

					$class = intval( $class );
				}
				$class			 = str_replace( 'post_tag', 'tag', $class );
				$class			 = sanitize_html_class( $class );
				$stream_classes	 .= sprintf( '%1$s,', $class );
			}
		}

		$stream_classes = trim( $stream_classes, ',' );

	}
	return $stream_classes;
}*/

/**
 * SCSS variables $image_sizes
 *
 * @global type $_wp_additional_image_sizes
 * @return Comma-separated string
 */
function emulsion_get_images_width_for_scss() {
	global $_wp_additional_image_sizes;

	$sizes		 = '';
	$image_sizes = get_intermediate_image_sizes();

	foreach ( $image_sizes as $_size ) {
		if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
			$sizes .= $_size . " " . get_option( "{$_size}_size_w" ) . "	" . get_option( "{$_size}_size_h" ) .',';
		} elseif ( isset( $_wp_additional_image_sizes[$_size] ) ) {
			$sizes .= $_size . " " . $_wp_additional_image_sizes[$_size]['width'] .  " " . $_wp_additional_image_sizes[$_size]['height'] .',';
		}
	}

	$sizes = rtrim( $sizes, ',' );
	return $sizes;
}

if ( ! function_exists( 'emulsion_contrast_color' ) ) {

	/**
	 * Calculate text color from background color
	 * @param type $hex
	 * @param type $alpha
	 * @return type
	 */
	function emulsion_contrast_color( $hex_color = '' ) {

		if ( empty( $hex_color ) ) {

			$hex_color = emulsion_the_background_color();
		}

		list( $r, $g, $b) = emulsion_get_hex2rgb_array( $hex_color );

		$brightness	 = round( $r * 299 + $g * 587 + $b * 114 ) / 1000;
		$light		 = round( 255 * 299 + 244 * 587 + 255 * 114 ) / 1000;

		if ( $brightness < $light / 2 ) {
			$color = '#ffffff';
		} else {
			$color = '#333333';
		}

		return $color;
	}

}
if ( ! function_exists( 'emulsion_the_background_color' ) ) {

	/**
	 * get background color
	 * @return type
	 */
	function emulsion_the_background_color() {

		$background_color	 = sprintf( '#%2s', get_background_color() );
		$background_color	 = sanitize_hex_color( $background_color );

		if ( empty( $background_color ) ) {

			$default_background = sprintf( '#%1$s', get_theme_support( 'custom-background', 'default-color' ) );
		}
		$background_color = apply_filters( 'emulsion_the_background_color', $background_color );

		return $background_color;
	}

}

if ( ! function_exists( 'emulsion_get_hex2rgb_array' ) ) {

	/**
	 * return rgb array from hex color
	 * @param type $hex
	 * @return boolean
	 */
	function emulsion_get_hex2rgb_array( $hex ) {

		$is_valid			 = emulsion_color_value_validate( $hex, 'hex' );
		$is_valid_no_hash	 = emulsion_color_value_validate( $hex, 'hex_no_hash' );

		if ( ! $is_valid ) {

			if ( ! $is_valid_no_hash ) {
				return array( 255, 0, 0 );
			}
		}

		$hex = str_replace( '#', '', $hex );
		$d	 = '[a-fA-F0-9]';

		if ( preg_match( "/^($d$d)($d$d)($d$d)\$/", $hex, $rgb ) ) {

			return array(
				hexdec( $rgb[1] ),
				hexdec( $rgb[2] ),
				hexdec( $rgb[3] )
			);
		}

		if ( preg_match( "/^($d)($d)($d)$/", $hex, $rgb ) ) {

			return array(
				hexdec( $rgb[1] . $rgb[1] ),
				hexdec( $rgb[2] . $rgb[2] ),
				hexdec( $rgb[3] . $rgb[3] )
			);
		}
		return false;
	}

}

