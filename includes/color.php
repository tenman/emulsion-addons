<?php

/**
 * Apply Color Settings for Theme
 * @param type $css
 * @return type
 */
function emulsion__css_variables( $css = '' ) {

	$transient_name = __FUNCTION__;

	if ( is_customize_preview() ) {

		//delete_transient( $transient_name );
		remove_theme_mod( 'emulsion__css_variables' );
	}
	if ( is_singular() ) {

		$post_id = get_the_ID();

		if ( 'no_bg' == get_post_meta( $post_id, 'emulsion_post_theme_style_script', true ) ) {

			return $css;
		}
	}
	//$transient_val = get_transient( $transient_name );

	$transient_val = get_theme_mod( 'emulsion__css_variables' );

	if ( ! is_user_logged_in() ) {

		return $css . $transient_val;
	}

	/**
	 * CSS variables
	 */
	$background_image_dim				 = emulsion_get_css_variables_values( 'background_image_dim' );
	$heading_font_scale					 = emulsion_get_css_variables_values( 'heading_font_scale' );
	$heading_font_base					 = emulsion_get_css_variables_values( 'heading_font_base' );
	$header_media_max_height			 = emulsion_get_css_variables_values( 'header_media_max_height' );
	$post_display_date					 = emulsion_get_css_variables_values( 'post_display_date' );
	$post_display_author				 = emulsion_get_css_variables_values( 'post_display_author' );
	$post_display_category				 = emulsion_get_css_variables_values( 'post_display_category' );
	$post_display_tag					 = emulsion_get_css_variables_values( 'post_display_tag' );
	$sub_background_color_lighten		 = emulsion_get_css_variables_values( 'sub_background_color_lighten' );
	$sub_background_color_darken		 = emulsion_get_css_variables_values( 'sub_background_color_darken' );
	$favorite_color_palette				 = emulsion_get_css_variables_values( 'favorite_color_palette' );
	$header_category					 = emulsion_get_css_variables_values( 'header_category' ); // Not CSS variables
	$header_gradient					 = emulsion_get_css_variables_values( 'header_gradient' ); // Not CSS variables
	$content_margin_top					 = emulsion_get_css_variables_values( 'content_margin_top' );
	$general_text_color					 = emulsion_get_css_variables_values( 'general_text_color' );
	$general_link_hover_color			 = emulsion_get_css_variables_values( 'general_link_hover_color' );
	$general_link_color					 = emulsion_get_css_variables_values( 'general_link_color' );
	$excerpt_linebreak					 = emulsion_get_css_variables_values( 'excerpt_linebreak' );
	$stream_condition					 = emulsion_get_css_variables_values( 'stream' );
	$stream_condition					 = empty( $stream_condition ) ? 'body' : $stream_condition;
	$grid_condition						 = emulsion_get_css_variables_values( 'grid' );
	$grid_condition						 = empty( $grid_conditio ) ? 'body' : $grid_condition;
	$sidebar_link_color					 = emulsion_get_css_variables_values( 'sidebar_link_color' );
	$sidebar_hover_color				 = emulsion_get_css_variables_values( 'sidebar_hover_color' );
	$sidebar_color						 = emulsion_get_css_variables_values( 'sidebar_color' );
	$sidebar_background					 = emulsion_get_css_variables_values( 'sidebar_background' );
	$primary_menu_link_color			 = emulsion_get_css_variables_values( 'primary_menu_link_color' );
	$primary_menu_color					 = emulsion_get_css_variables_values( 'primary_menu_color' );
	$primary_menu_background			 = emulsion_get_css_variables_values( 'primary_menu_background' );
	$comments_link_color				 = emulsion_get_css_variables_values( 'comments_link_color' );
	$comments_color						 = emulsion_get_css_variables_values( 'comments_color' );
	$comments_bg						 = emulsion_get_css_variables_values( 'comments_bg' );
	$relate_posts_link_color			 = emulsion_get_css_variables_values( 'relate_posts_link_color' );
	$relate_posts_color					 = emulsion_get_css_variables_values( 'relate_posts_color' );
	$relate_posts_bg					 = emulsion_get_css_variables_values( 'relate_posts_bg' );
	$image_sizes						 = emulsion_get_images_width_for_scss(); // Old gallery caliculate wrapper width
	$header_text_color					 = emulsion_get_css_variables_values( 'header_text_color' );
	$header_link_color					 = emulsion_get_css_variables_values( 'header_link_color' );
	$header_hover_color					 = emulsion_get_css_variables_values( 'header_hover_color' );
	$header_bg_color					 = emulsion_get_css_variables_values( 'header_background_color' );
	$header_background_gradient_color	 = emulsion_get_css_variables_values( 'header_background_gradient_color' );
	//$theme_image_dir					 = emulsion_get_css_variables_values( 'theme_image_dir' );
	//$upload_base_dir					 = emulsion_get_css_variables_values( 'upload_base_dir' );
	$header_image_ratio					 = emulsion_get_css_variables_values( 'header_image_ratio' );
	$background_color					 = emulsion_get_css_variables_values( 'background_color' );
	$language							 = esc_attr( get_locale() );
	$hover_color						 = emulsion_get_css_variables_values( 'hover_color' );
	$sidebar_width						 = emulsion_get_css_variables_values( 'sidebar_width' );
	$sidebar_position					 = emulsion_get_css_variables_values( 'sidebar_position' );
	$i18n_no_title						 = esc_html__( 'No Title', 'emulsion-addons' );
	$editor_font_sizes					 = emulsion_get_css_variables_values( 'font_sizes' );
	$editor_color_palettes				 = emulsion_get_css_variables_values( 'color_palette' );
	$body_id							 = '#' . emulsion_theme_info( 'Slug', false );
	$footer_widget_width				 = emulsion_get_css_variables_values( 'footer_widget_width' );
	$common_font_size					 = emulsion_get_css_variables_values( 'common_font_size' );
	$common_font_family					 = emulsion_get_css_variables_values( 'common_font_family' );
	$heading_font_family				 = emulsion_get_css_variables_values( 'heading_font_family' );
	$heading_font_weight				 = emulsion_get_css_variables_values( 'heading_font_weight' );
	$heading_font_transform				 = emulsion_get_css_variables_values( 'heading_font_transform' );
	$meta_data_font_size				 = emulsion_get_css_variables_values( 'widget_meta_font_size' );
	$meta_data_font_family				 = emulsion_get_css_variables_values( 'widget_meta_font_family' );
	$meta_data_font_transform			 = emulsion_get_css_variables_values( 'widget_meta_font_transform' );
	$layout_homepage					 = emulsion_get_css_variables_values( 'layout_homepage' );
	$layout_date_archives				 = emulsion_get_css_variables_values( 'layout_date_archives' );
	$layout_category_archives			 = emulsion_get_css_variables_values( 'layout_category_archives' );
	$layout_tag_archives				 = emulsion_get_css_variables_values( 'layout_tag_archives' );
	$layout_author_archives				 = emulsion_get_css_variables_values( 'layout_author_archives' );
	$layout_posts_page					 = emulsion_get_css_variables_values( 'layout_posts_page' );
	$content_width						 = emulsion_get_css_variables_values( 'content_width' );
	$box_gap							 = emulsion_get_css_variables_values( 'box_gap' );
	$main_width							 = emulsion_get_css_variables_values( 'main_width' );
	$align_offset						 = emulsion_get_css_variables_values( 'align_offset' );
	$content_gap						 = emulsion_get_css_variables_values( 'content_gap' );
	$content_line_height				 = emulsion_get_css_variables_values( 'content_line_height' );
	$common_line_height					 = emulsion_get_css_variables_values( 'common_line_height' );
	$caption_height						 = emulsion_get_css_variables_values( 'caption_height' );
	$default_header_height				 = emulsion_get_css_variables_values( 'default_header_height' );
	$full_width_negative_margin			 = emulsion_get_css_variables_values( 'full_width_nagative_margin' );
	$border_global						 = emulsion_get_css_variables_values( 'border_global' );
	$border_sidebar						 = emulsion_get_css_variables_values( 'border_sidebar' );
	$border_grid						 = emulsion_get_css_variables_values( 'border_grid' );
	$border_stream						 = emulsion_get_css_variables_values( 'border_stream' );
	$border_global_style				 = emulsion_get_css_variables_values( 'border_global_style' );
	$border_sidebar_style				 = emulsion_get_css_variables_values( 'border_sidebar_style' );
	$border_grid_style					 = emulsion_get_css_variables_values( 'border_grid_style' );
	$border_stream_style				 = emulsion_get_css_variables_values( 'border_stream_style' );
	$border_global_width				 = emulsion_get_css_variables_values( 'border_global_width' );
	$border_sidebar_width				 = emulsion_get_css_variables_values( 'border_sidebar_width' );
	$border_grid_width					 = emulsion_get_css_variables_values( 'border_grid_width' );
	$border_stream_width				 = emulsion_get_css_variables_values( 'border_grid_width' );
	$boxed_conditions					 = $stream_condition . ',' . $grid_condition;



	$style = <<<CSS
:root{
	/* dinamic */
	--thm_background_image_dim:$background_image_dim;
	--thm_border_global:$border_global;
	--thm_border_global_style:$border_global_style;
	--thm_border_global_width:$border_global_width;
	--thm_border_grid:$border_grid;
	--thm_border_grid_style:$border_grid_style;
	--thm_border_grid_width:$border_grid_width;
	--thm_border_sidebar:$border_sidebar;
	--thm_border_sidebar_style:$border_sidebar_style;
	--thm_border_sidebar_width:$border_sidebar_width;
	--thm_border_stream:$border_stream;
	--thm_border_stream_style:$border_stream_style;
	--thm_border_stream_width:$border_stream_width;

	--thm_comments_bg:$comments_bg;
	--thm_comments_color:$comments_color;
	--thm_comments_link_color:$comments_link_color;
	--thm_content_margin_top:$content_margin_top;
	--thm_excerpt_linebreak:$excerpt_linebreak;
	--thm_favorite_color_palette:$favorite_color_palette;

	--thm_general_link_color:$general_link_color;
	--thm_general_link_hover_color:$general_link_hover_color;
	--thm_general_text_color:$general_text_color;
	--thm_header_background_gradient_color:$header_background_gradient_color;
	--thm_header_hover_color: $header_hover_color;
	--thm_header_image_dim:rgba(0,0,0,.5);
	--thm_header_link_color: $header_link_color;
	--thm_header_media_max_height:$header_media_max_height;
	--thm_heading_font_base:$heading_font_base;
	--thm_heading_font_scale:$heading_font_scale;

	--thm_post_display_author:$post_display_author;
	--thm_post_display_category:$post_display_category;
	--thm_post_display_date:$post_display_date;
	--thm_post_display_tag:$post_display_tag;
	--thm_primary_menu_background:$primary_menu_background;
	--thm_primary_menu_color:$primary_menu_color;
	--thm_primary_menu_link_color:$primary_menu_link_color;
	--thm_relate_posts_bg:$relate_posts_bg;
	--thm_relate_posts_color:$relate_posts_color;
	--thm_relate_posts_link_color:$relate_posts_link_color;
	--thm_sidebar_bg_color:$sidebar_background;
	--thm_sidebar_hover_color:$sidebar_hover_color;
	--thm_sidebar_link_color:$sidebar_link_color;
	--thm_sidebar_text_color:$sidebar_color;
	--thm_sub_background_color_darken:$sub_background_color_darken;
	--thm_sub_background_color_lighten:$sub_background_color_lighten;
    --thm_align_offset:$align_offset;
    --thm_background_color: $background_color;
    --thm_box_gap: $box_gap;
    --thm_caption_height: $caption_height;

    --thm_common_font_family: $common_font_family;
    --thm_common_font_size: $common_font_size;
    --thm_common_line_height: $common_line_height;
    --thm_content_gap: $content_gap;
    --thm_content_line_height: $content_line_height;
    --thm_content_width: $content_width;
    --thm_default_header_height: $default_header_height;
    --thm_footer_widget_width: $footer_widget_width;

    --thm_header_bg_color: $header_bg_color;
    --thm_header_text_color: $header_text_color;
    --thm_heading_font_family: $heading_font_family;
    --thm_heading_font_transform:$heading_font_transform;
    --thm_heading_font_weight: $heading_font_weight;
    --thm_hover_color:$hover_color;
    --thm_i18n_no_title:$i18n_no_title;/* Not Work Now( .hoge:before{content:var(--thm_i18n_no_title,'No Title');}). Please use SCSS variables(.hoge:before{content:'#{$i18n_no_title}';}) */
    --thm_main_width-with-sidebar: calc(100vw - var(--thm_sidebar_width) - 48px );
    --thm_main_width: $main_width;
    --thm_meta_data_font_family: $meta_data_font_family;
    --thm_meta_data_font_size: $meta_data_font_size;
    --thm_meta_data_font_transform: $meta_data_font_transform;
    --thm_sidebar_width: $sidebar_width;
    --thm_social_icon_color:$general_link_color;

}
CSS;

	$style = apply_filters( 'emulsion__css_variables', $style );

	$style = emulsion_sanitize_css( $style );

	//set_transient( $transient_name, $style, 60 * 60 * 24 );
	set_theme_mod( 'emulsion__css_variables', $style );


	return $css . $style;
}

function emulsion_dinamic_css( $css = '' ) {

	if( 'fse' == get_theme_mod('emulsion_editor_support') ) {

		return $css;
	}

	/**
	 * CSS variables
	 */
	if ( ! is_user_logged_in() ) {

		$saved_css = get_theme_mod( 'dinamic_css' );

		if ( $saved_css !== false ) {

			return $css . $saved_css;
		}
	}

	$make_boxed_style	 = '';
	$boxed_style_1		 = ' .has-column main .grid {	--thm_main_width: calc(100vw - var(--thm_sidebar_width) - 48px);}';
	$boxed_style_2		 = ' main .grid {	--thm_content_width: 300px; }';
	$boxed_style_3		 = ' main .grid article {--thm_content_width: 100%;}';
	$boxed_style_4		 = ' main .stream { --thm_content_width: 410px;}';
	$boxed_style_5		 = ' main .stream article {--thm_content_width: 100%;}';

	if ( ! empty( $stream_condition ) || ! empty( $grid_condition ) ) {

		if ( false === strstr( trim( $boxed_conditions, ',' ), ',' ) ) {

			$boxed_conditions[] = $boxed_conditions;
		} else {

			$boxed_conditions = explode( ',', $boxed_conditions );
		}

		foreach ( $boxed_conditions as $condition ) {
			$make_boxed_style	 .= $condition . $boxed_style_1;
			$make_boxed_style	 .= $condition . $boxed_style_2;
			$make_boxed_style	 .= $condition . $boxed_style_3;
			$make_boxed_style	 .= $condition . $boxed_style_4;
			$make_boxed_style	 .= $condition . $boxed_style_5;
		}
	}

	$style = emulsion__css_variables();



	$style .= <<<CSS


.emulsion-has-sidebar .has-column .page-wrapper main {
  max-width: 100%;
}
.emulsion-has-sidebar .has-column .wp-nav-menu {
  --thm_main_width: calc(100vw - var(--thm_sidebar_width) - 48px);
}
.has-column main .grid {
  --thm_main_width: calc(100vw - var(--thm_sidebar_width) - 48px);
}
.has-column main .stream {
  --thm_main_width: calc(100vw - var(--thm_sidebar_width) - 48px);
  --thm_content_width: 410px;
}
/* for customizer */
main .grid {
  --thm_content_width: 300px;
}
main .grid article {
  --thm_content_width: 100%;
}
main .stream {
  --thm_content_width: 600px;
}
main .stream article {
  --thm_content_width: 100%;
}

$make_boxed_style

.header-layer{
	color:var(--thm_header_text_color);
	background:var(--thm_header_bg_color);

}
.header-is-dark{
	color:#fff;
}
.header-is-light{
	color:#333;
}

CSS;

	$style = emulsion_remove_spaces_from_css( $style );

	$stream_css = emulsion_stream_layout_css();
	$stream_css = '';
	$grid_css = emulsion_grid_layout_css();
	$grid_css = '';

	//$responsive_css = "/* responsive test */\n". emulsion_resuponsive_css();
	$responsive_css = '';


	$css_result = $grid_css . $stream_css . $style . $responsive_css;

	set_theme_mod( 'dinamic_css', $css_result );

	if ( is_page() && emulsion_metabox_display_control( 'page_style' ) ) {

		return $css . $css_result;
	}

	if ( is_single() && emulsion_metabox_display_control( 'style' ) ) {

		return $css . $css_result;
	}

	if ( emulsion_get_supports( 'enqueue' ) ) {

		return $css . $css_result;
	}
}

/**
 *
 * @return type
 */
function emulsion_stream_layout_css() {

	/**
	 * Theme main CSS is a compiled static file described in common.css.
	 * If you do not use the wp-scss plugin, this function will need to dynamically override common.css.
	 */
	$stream_condition	 = emulsion_get_css_variables_values( 'stream' );
	$content_width		 = emulsion_get_css_variables_values( 'content_width' );

	if ( empty( $stream_condition ) ) {
		return;
	}
	if ( ! empty( $stream_condition ) ) {

		if ( false === strstr( $stream_condition, ',' ) ) {

			$stream_condition_array[] = $stream_condition;
		} else {

			$stream_condition_array = explode( ',', $stream_condition );
		}
	}

	$css = '';

	foreach ( $stream_condition_array as $class ) {
		$css .= <<<CSS

		$class .stream {
			/**
			 * Apply stream Layout
			 */
			overflow: visible;
			margin-left: auto;
			margin-right: auto;
		  }
		$class .stream .article-wrapper article .stream-wrapper {
			overflow: visible;
			position: relative;
			display: flex;
			align-items: stretch;
			height: 100%;
			width: 100%;
		  }
		 $class .stream .article-wrapper article .stream-wrapper .post-thumb-col {
			flex: 0 0 150px;
			justify-content: flex-start;
			align-self: stretch;
			order: 2;
		  }
		$class .stream .article-wrapper article .stream-wrapper .post-thumb-col img {
			position: relative;
			object-fit: cover;
			height: 100%;
			width: 100%;
		  }
		 $class .stream .article-wrapper article .stream-wrapper .post-thumb-col:empty {
			display: none;
		  }
		$class .stream .article-wrapper article .stream-wrapper .post-thumb-col:empty + .content-col {
			flex: 1 1 auto;
			width: 100%;
			margin:0;
			max-width:100%;
		  }
		$class .stream .article-wrapper article .stream-wrapper .content-col {
			flex: 1 1 calc(100% - 150px);
			width: calc(100% - 150px);
			align-self: stretch;
			order: 1;
			max-width: calc(100% - 150px);
		  }
		 $class .stream .article-wrapper article .stream-wrapper .content-col .entry-title {
			margin-top: 0.75rem;
		  }
		$class .stream .article-wrapper article .stream-wrapper .content-col .posted-on {
			margin-top: 0.75rem;
			margin-bottom: 0;
		  }
		$class .stream .article-wrapper article .stream-wrapper .content-col .entry-content p {
			margin-top: 0.75rem;
		  }

		$class .stream .article-wrapper article .stream-wrapper .content-col .content .trancate {
			padding-left: var(--thm_content_gap, 24px);
			padding-right: var(--thm_content_gap, 24px);
			position: relative;
		  }
		$class .stream .article-wrapper article .stream-wrapper .content-col footer {
			display: none;
		  }
CSS;
	}
	$css .= '@media screen and ( max-width : ' . $content_width . 'px ) {';

	foreach ( $stream_condition_array as $class ) {
		/* @media screen and ( max-width : 720px ) { */

		$css .= <<<CSS2
				$class .stream .article-wrapper {
					flex: 1 1 auto;
					width: 100%;
					max-width: 100%;
				    overflow:hidden;
					margin:0 var(--thm_box_gap) var(--thm_box_gap);
				  }
				$class .stream .article-wrapper article {
					width: 100%;
				}
				$class .stream .article-wrapper article .stream-wrapper {
					flex-direction: column;
					width: 100%;
				}
				$class .stream .article-wrapper article .stream-wrapper .content-col {
					width: 100vw;
					max-width: 100%;
					order: 2;
					margin-left: 0;
					margin-right: 0;
				}
				$class .stream .article-wrapper article .stream-wrapper .post-thumb-col {
					max-width: 100%;
					margin-left: 0;
					margin-right: 0;
				  }
				$class .stream .article-wrapper article .stream-wrapper .show-content:before {
					top:-64px;
				}
				$class .stream .article-wrapper article.has-post-thumbnail .show-content:before {
					top:-64px;
                    right:-150px;
				}
				$class .stream .article-wrapper article.has-post-thumbnail .show-content.is-active:before {
					top:-64px;
                    right:0;
				}


CSS2;
	}

	$css .= '}';
	$css = emulsion_remove_spaces_from_css( $css );
	return $css;
}

/**
 *
 * @return type
 */
function emulsion_grid_layout_css() {

	/**
	 * Theme main CSS is a compiled static file described in common.css.
	 * If you do not use the wp-scss plugin, this function will need to dynamically override common.css.
	 */
	$grid_condition	 = emulsion_get_css_variables_values( 'grid' );
	$main_width		 = emulsion_get_css_variables_values( 'main_width' );

	$stream_classes_array = array();

	if ( empty( $grid_condition ) ) {
		return;
	}

	if ( ! empty( $grid_condition ) ) {

		if ( false === strstr( $grid_condition, ',' ) ) {

			$grid_condition_array[] = $grid_condition;
		} else {

			$grid_condition_array = explode( ',', $grid_condition );
		}
	}

	$css = '';

	foreach ( $grid_condition_array as $class ) {
		$css .= <<<CSS
		$class .grid {
			width: var( --thm_main_width, 1280px );
			margin-top:1.5rem;
			margin-bottom:.75rem;
			padding-left:var( --thm_content_gap, 24px );
			padding-right:var( --thm_content_gap, 24px );
			box-sizing:border-box;
			margin-top: 1rem;
			display: flex;
			align-items: stretch;
			flex-wrap: wrap;
			overflow: visible;
			padding: 0;
		}
		$class .grid .article-wrapper {
			flex: 1 1 var(--thm_content_width, 24%);
			width: var(--thm_content_width, 296px);
			align-self: stretch;
			margin: var(--thm_box_gap, 3px);

		}
		$class .grid .article-wrapper article {
			display: flex;
			align-items: center;
			flex-direction: column;
			justify-content: center;
			align-items: stretch;
			max-width: 100%;
			height: 100%;
		}
		$class .grid .article-wrapper article header {
			flex: 0 1 auto;
			align-self: flex-start;
			margin-top: 0;
		}
		$class .grid .article-wrapper article header .wrapper-in-the-loop {
			display: block;
			max-width: 100%;
			padding: 0;
			margin: 0;
		}
		$class .grid .article-wrapper article header .wrapper-in-the-loop span {
			display: block;
			width: 100%;
		}
		$class .grid .article-wrapper article header .wrapper-in-the-loop span .post-thumbnail-in-the-loop {
			margin: 0 auto -6px;
			width: 100%;
			max-width: 100%;
			object-fit: contain;
		}
		$class .grid .article-wrapper article header .wrapper-in-the-loop .entry-title {
			display: block;
			width: 100%;
		}
		$class .grid .article-wrapper article footer {
			flex: 1 0 auto;
			align-self: flex-end;
			margin-top:0
			margin-bottom: var(--thm_content_gap, 24px);
			height: auto;
			display: flex;
			justify-content: flex-end;

		}
		$class .grid .article-wrapper article footer:empty,
		$class .grid .article-wrapper article footer:empty:after,
		$class .grid .article-wrapper article footer:empty:before {
			display:none;
            margin-bottom:0;

		}
		$class .grid .article-wrapper article footer span {
			display: flex;
			display: inline-flex;
			justify-content: flex-end;
			flex: 0 0 auto;
			align-self: flex-end;
			width: auto;
			height: 100%;
			margin-left: calc( var( --thm_box_gap) * 2 );
		}
		$class .grid .article-wrapper article footer span a {
			flex: 0 0 auto;
			justify-content: flex-end;
			display: inline-block;
			vertical-align: baseline;
		}
		$class .grid .article-wrapper article footer:empty {
			margin: 0;
		}
		$class .grid .article-wrapper:nth-child(2), .grid .article-wrapper:nth-child(1) {
			flex-basis: 40%;
		}
CSS;
	}
	$css .= '@media screen and ( max-width : ' . $main_width . 'px ) {';
	foreach ( $stream_classes_array as $class ) {


		$css .= <<<CSSRES

	$class.emulsion-has-sidebar main .grid{

						--thm_main_width:100%;
			}
	$class.emulsion-has-sidebar main .stream{
			--thm_main_width:100%;
			--thm_content_width:320px;
		}
	$class.emulsion-no-sidebar main .grid{

			--thm_main_width:100%;
	}
	$class.emulsion-no-sidebar main .stream{
				--thm_main_width:100%;
				--thm_content_width:320px;
	}
CSSRES;
	}
	$css .= '}';



	$css = emulsion_remove_spaces_from_css( $css );

	return $css;
}

function emulsion_resuponsive_css() {

	 if ( false === get_theme_mod( 'emulsion_main_width', false ) &&
			false === get_theme_mod( 'emulsion_content_width', false ) &&
			false === get_theme_mod( 'emulsion_sidebar_width', false ) ) {

		return;
	}

	/**
	 * Theme main CSS is a compiled static file described in common.css.
	 * If you do not use the wp-scss plugin, this function will need to dynamically override common.css.
	 */
	$main_width								 = emulsion_get_css_variables_values( 'main_width' );
	$content_width							 = emulsion_get_css_variables_values( 'content_width' );
	$content_gap							 = emulsion_get_css_variables_values( 'content_gap' );
	$sidebar_width							 = emulsion_get_css_variables_values( 'sidebar_width' );
	$content_width_plus_content_gap			 = (int) emulsion_get_var( 'emulsion_content_width' ) + 24 * 2 + 16; // todo hard code 24
	$content_width_plus_content_gap			 = $content_width_plus_content_gap . 'px';
	$content_width_plus_sidebar_width_plus1	 = (int) emulsion_get_var( 'emulsion_content_width' ) + (int) emulsion_get_var( 'emulsion_sidebar_width' ) + 1 + 16;
	$content_width_plus_sidebar_width_plus1	 = $content_width_plus_sidebar_width_plus1 . 'px';
	$content_width_plus_sidebar_width		 = (int) emulsion_get_var( 'emulsion_content_width' ) + (int) emulsion_get_var( 'emulsion_sidebar_width' ) + 16;
	$content_width_plus_sidebar_width		 = $content_width_plus_sidebar_width . 'px';
	//@since 1.0.2 fixed hard coded uri
	$theme_image_uri						 = esc_url( get_template_directory_uri() );

	$css = <<<CSS
/*?
 * responsive start
 */
@media screen and (max-width: $main_width) {
  body{
    --thm_main_width: 100%;
    --thm_main_width-with-sidebar: 100%;
  }

  ul.wp-nav-menu[data-direction="horizontal"] {
    --thm_main_width: 100%;
  }
  .category.emulsion-has-sidebar .wp-nav-menu, .tag.emulsion-has-sidebar .wp-nav-menu, .author.emulsion-has-sidebar .wp-nav-menu, .date.emulsion-has-sidebar .wp-nav-menu, .layout_stream.emulsion-has-sidebar .wp-nav-menu, .layout-grid.emulsion-has-sidebar .wp-nav-menu {
    --thm_main_width: calc(100vw  - 48px);
  }
  .category.emulsion-has-sidebar main .grid, .tag.emulsion-has-sidebar main .grid, .author.emulsion-has-sidebar main .grid, .date.emulsion-has-sidebar main .grid, .layout_stream.emulsion-has-sidebar main .grid, .layout-grid.emulsion-has-sidebar main .grid {
    --thm_main_width: 100%;
  }
.emulsion-has-sidebar main .stream,
  .category.emulsion-has-sidebar main .stream, .tag.emulsion-has-sidebar main .stream, .author.emulsion-has-sidebar main .stream, .date.emulsion-has-sidebar main .stream, .layout_stream.emulsion-has-sidebar main .stream, .layout-grid.emulsion-has-sidebar main .stream {
    --thm_main_width: 100%;
    --thm_content_width: 320px;
  }
  .category.emulsion-no-sidebar .wp-nav-menu, .tag.emulsion-no-sidebar .wp-nav-menu, .author.emulsion-no-sidebar .wp-nav-menu, .date.emulsion-no-sidebar .wp-nav-menu, .layout_stream.emulsion-no-sidebar .wp-nav-menu, .layout-grid.emulsion-no-sidebar .wp-nav-menu {
    --thm_main_width: calc(100vw  - 48px);
  }
  .category.emulsion-no-sidebar main .grid, .tag.emulsion-no-sidebar main .grid, .author.emulsion-no-sidebar main .grid, .date.emulsion-no-sidebar main .grid, .layout_stream.emulsion-no-sidebar main .grid, .layout-grid.emulsion-no-sidebar main .grid {
    --thm_main_width: 100%;
  }
  .category.emulsion-no-sidebar main .stream, .tag.emulsion-no-sidebar main .stream, .author.emulsion-no-sidebar main .stream, .date.emulsion-no-sidebar main .stream, .layout_stream.emulsion-no-sidebar main .stream, .layout-grid.emulsion-no-sidebar main .stream {
    --thm_main_width: 100%;
    --thm_content_width: 320px;
  }
  .category main .page-title-block, .tag main .page-title-block, .author main .page-title-block, .date main .page-title-block, .layout_stream main .page-title-block, .layout-grid main .page-title-block {
    --thm_main_width: 100%;
  }
}
@media screen and (max-width: $content_width) {
  body {
    --thm_main_width: 100vw;
    --thm_content_width: 100vw;
    --thm_main_width-with-sidebar: 100vw;
  }


}
@media screen and (max-width: $content_width) {
    .entry-content > div.wp-block-image.is-resized.alignright,
    .entry-content > div.wp-block-image.is-resized.alignleft{
        margin-right:auto;
        margin-left:auto;
    }
	body.home .header-video-active .site-title-text, body.home .header-image-active .site-title-text {
	  font-size: 1.5rem;
	}
	.emulsion-has-sidebar.enable-alignfull .wp-block-media-text.alignfull{
		display:grid;
	}

  ul.wp-nav-menu[data-direction="horizontal"], .entry-content .alignright, .entry-content .alignleft, .entry-content .aligncenter, .aligncenter, div.alignleft, img.alignleft, .alignleft, div.alignright, img.alignright, .alignrigh, .wp-block-cover.alignright, .wp-block-cover.alignleft, .page .entry-content figure.alignfull, .post .entry-content figure.alignfull, .wp-block-embed.alignleft, .wp-block-embed.alignright, .archive-title, .social, main > nav, article footer, article address, article aside, article canvas, article menu, article dl, article form, article nav, article noscript, article ol, article p, article pre, article section, article tfoot, article ul, article video, article cite, .entry-content figure.alignwide img, .entry-content figure.alignfull img .entry-content ul.alignright .rd-table-wrapper, .entry-content ul.alignleft .rd-table-wrapper, ol.alignright, ul.alignright, ol.alignleft, ul.alignleft, .entry-content :not([class|="wp-block"]) a > img.alignleft, .entry-content :not(.wp-caption) a > img.alignleft, .entry-content > p > a > img.alignleft, .line .size1of2, .line .size1of3, .line .size1of4, .line .size1of5, .line .size2of3, .line .size2of5, .line .size3of4, .line .size3of5, .line .size4of5, .entry-content .size1of2, .entry-content .size1of3, .entry-content .size1of4, .entry-content .size1of5, .entry-content .size2of3, .entry-content .size2of5, .entry-content .size3of4, .entry-content .size3of5, .entry-content .size4of5, article .entry-content p.alignleft, article .entry-content p.alignright, article .entry-content p.aligncenter, article .entry-content p.alignfull, .hentry .entry-content .alignleft, .hentry .entry-content .alignright, .hentry .entry-content .aligncenter, .hentry .entry-content .alignfull, .entry-content .alignfull, .hentry .entry-content .is-resized, .hentry .entry-content .wp-block-image.alignleft, .hentry .entry-content .wp-block-image.alignright, .hentry .entry-content .wp-block-image.aligncenter, .hentry .entry-content .wp-block-image.alignfull, .hentry .entry-content .wp-block-image.is-resized {
    display: block;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    float: none;
    width: var(--thm_content_width, 100%);
    max-width: 100%;
    left: 0;

  }
.hentry .entry-content .alignfull.has-background-dim:before,
.entry-content .alignfull.has-background-dim:before{
	display:none;
}

	.hentry .entry-content .wp-block-columns.aligfull {
		display: flex;
	}

	.entry-content [class|="wp-block"].alignfull{
		display:block;
	}

	.hentry .entry-content .wp-block-group.alignfull{
        display:flex;
        flex-wrap:wrap;
        flex-direction:column;
		position:static;
    }
	.hentry .entry-content .wp-block-columns.alignfull{
        display:flex;
        flex-wrap:wrap;
        flex-direction:row;
        position:static;
    }
	.entry-content .emulsion-table-wrapper{
        margin-left:0;
        margin-right:0;
        max-width:100%;
        padding-left:var(--thm_content_gap);
        padding-right:var(--thm_content_gap);
    }
    .entry-content .wp-block-table{
        margin-left:0;
        margin-right:0;
        max-width:100%;
    }
    .wp-block-table.stretch,
    .hentry .entry-content .alignright,
    .hentry .entry-content .alignleft,
    .emulsion-no-sidebar.enable-alignfull .emulsion-table-wrapper.alignfull .wp-block-table,
    .emulsion-has-sidebar.enable-alignfull .emulsion-table-wrapper.alignfull .wp-block-table,
    .entry-content  .emulsion-table-wrapper.alignfull,
    .entry-content  .emulsion-table-wrapper.alignwide{
        margin-left:0;
        margin-right:0;
        width:100%;
    }
	.entry-content .wp-block-media-text{
        margin-left:0;
        margin-right:0;
    }

  .hentry .entry-content .wp-block-cover {
    display: flex;
  }
  .emulsion-has-sidebar .hentry .entry-content .wp-block-image {
    display: block;
  }
  .hentry .entry-content ul.wp-block-gallery .blocks-gallery-item {
    width: auto;
  }
	.wp-caption.alignright,
	.wp-caption.aligncenter,
	.wp-caption.alignleft,
	figure img {
		margin-left: auto;
		margin-right: auto;
		display: block;
		height: auto;
	}
  .entry-content .wp-block-gallery.aligncenter {
    margin-left: auto;
    margin-right: auto;
    width: var(--thm_content_width, 100%);
    padding-right: 0;
  }
	.emulsion-has-sidebar .sidebar-widget-area form.search-form,
	.emulsion-has-sidebar body .template-part-widget-footer.footer-widget-area form.search-form,
	body .emulsion-has-sidebar .template-part-widget-footer.footer-widget-area form.search-form {
		padding-left: var(--thm_content_gap, 24px);
	}
  figure[class|="wp-block-embed"] {
    width: var(--thm_content_width, 100%);
    position: static;
    max-width: var(--thm_content_width, 100%);
    margin-left: auto;
    margin-right: auto;
  }
	figure.wp-block-embed-reddit.alignright,
	figure.wp-block-embed-reddit.alignleft {
		width: 100vw;
		float: none;
		clear: both;
		min-height: 260px;
	}
	figure.wp-block-embed-reddit.alignright .wp-block-embed__wrapper iframe,
	figure.wp-block-embed-reddit.alignleft .wp-block-embed__wrapper iframe {
		min-height: 240px;
	}
  body .wp-block-image figure.alignleft.is-resized {
    margin-left: var(--thm_content_gap);
    margin-right: auto;
  }
  body .wp-block-image figure.alignright.is-resized {
    margin-right: var(--thm_content_gap);
    margin-left: auto;
  }
  .emulsion-has-sidebar .page-wrapper {
    width: var(--thm_content_width, 100%);
    min-width: var(--thm_content_width, 100%);
  }
  body.emulsion-has-sidebar .footer-widget-area .footer-widget-area-lists .widget, body.emulsion-no-sidebar .footer-widget-area .footer-widget-area-lists .widget {
    flex: 1 1 auto;
  }
	.comment-form,
	.comment-respond .comment-form {
		box-sizing: border-box;
	}
	.comment-form textarea,
	.comment-respond .comment-form textarea {
		width: 100%;
		max-width: 100%;
		margin-left: auto;
		margin-right: auto;
	}
	.comment-form input[name="author"],
	.comment-respond .comment-form input[name="author"],
	.comment-form input[type="url"],
	.comment-respond .comment-form input[type="url"],
	.comment-form input[type="email"],
	.comment-respond .comment-form input[type="email"],
	.comment-form input[type="author"],
	.comment-respond .comment-form input[type="author"],
	.comment-form input[type="comment"],
	.comment-respond .comment-form input[type="comment"] {
		width: 100%;
		max-width: 100%;
		margin-left: auto;
		margin-right: auto;
	}
	.comment-form input[type="submit"],
	.comment-respond .comment-form input[type="submit"] {
		font-size: 0.8125rem;
		line-height: 1.5;
		line-height: calc(1em * var( --thm_content_line_height, 1.5 ));
		padding: 0.83rem;
		margin-left: auto;
		margin-right: auto;
	}
	.comment-form label[for="url"], .comment-respond .comment-form label[for="url"],
	.comment-form label[for="email"], .comment-respond .comment-form label[for="email"],
	.comment-form label[for="author"], .comment-respond .comment-form label[for="author"],
	.comment-form label[for="comment"], .comment-respond .comment-form label[for="comment"] {
		vertical-align: top;
		display: inline-block;
		width: 8em;
	}
  .comment-form label.wp-comment-cookies-consent, .comment-respond .comment-form label.wp-comment-cookies-consent {
    font-size: 0.8125rem;
    line-height: 1.5;
  }
  .comment-form .logged-in-as, .comment-respond .logged-in-as {
    font-size: 0.8125em;
    padding-left: var(--thm_content_gap, 24px);
    padding-right: var(--thm_content_gap, 24px);
  }
  .comment-form .logged-in-as a, .comment-respond .logged-in-as a {
    text-decoration: none;
  }
}
@media screen and (min-width: $main_width) {
  article footer.fit, article header.fit {
    margin-right: auto;
    margin-left: auto;
  }
  article footer.fit .entry-title, article header.fit .entry-title {
    padding-left: 0;
    padding-right: 0;
  }
  article footer.fit .wrapper-in-the-loop, article header.fit .wrapper-in-the-loop {
    padding-left: 0;
    padding-right: 0;
  }
  article footer.fit .wrapper-in-the-loop .entry-title,
  article header.fit .wrapper-in-the-loop .entry-title {
    padding-left: var(--thm_content_gap, 24px);
  }

  .emulsion-has-sidebar .entry-content .wp-block-columns.alignwide {
    position: static;
    width: calc(  var(--thm_content_width) + var(--thm_align_offset));
    max-width: 100%;
  }
  .emulsion-has-sidebar .entry-content .wp-block-columns.alignfull {
    position: relative;
    width: 100%;
    /*max-width: none;*/
  }
  .emulsion-no-sidebar .entry-content .wp-block-columns.alignwide {
    position: static;
    width: calc(  var(--thm_content_width) + var(--thm_align_offset));

    padding-left:0;
    padding-right:0;
    /*max-width: none;*/
  }
  .emulsion-no-sidebar .entry-content .wp-block-columns.alignfull {
    position: static;
    width: 100%;
    /*max-width: none;*/
    left: 0;
  }
  body.emulsion-has-sidebar .primary-menu-wrapper .menu-placeholder {
	flex-basis: auto;
    /*width: auto;*/
    min-width: 0;
    z-index: 4;
  }
  .footer-widget-area .footer-widget-area-lists {
    justify-content: center;
  }
  body.on-scroll .primary-menu-wrapper.side-right input[type="checkbox"][data-skin="inset"][id="toc-toggle"]:checked ~ .toc {
    width: var(--thm_sidebar_width);
    right: 0;
    left: auto;
    text-align: left;
  }
  body.on-scroll .primary-menu-wrapper.side-left input[type="checkbox"][data-skin="inset"][id="toc-toggle"]:checked ~ .toc {
    width: var(--thm_sidebar_width);
    right: auto;
    left: 0;
    text-align: left;
  }
  nav[class|="menu"] ul.wp-nav-menu[data-direction="horizontal"] {
   /* padding-left: var(--thm_content_gap, 24px);*/
    padding-right: var(--thm_content_gap, 24px);
    display: flex;
    width: auto;
  }
  nav[class|="menu"] ul.wp-nav-menu[data-direction="vertical"] li {
    width: 100%;
  }
}
@media screen and (min-width: $main_width) {
	.emulsion-has-sidebar nav[class|="menu"] {
	  flex: 1 1 auto;
	  width: calc(100vw - var(--thm_sidebar_width) - 1rem);
	}
	.emulsion-has-sidebar .primary-menu-wrapper .menu-placeholder{
		background: var(--thm_primary_menu_background);
        color: var(--thm_primary_menu_color);
	}
}
@media screen and ( max-width : $main_width ) {
	nav[class|="menu"] ul.wp-nav-menu[data-direction="horizontal"] li .sub-menu .sub-menu,
	nav[class|="menu"] ul.wp-nav-menu[data-direction="horizontal"] li .children .sub-menu,
	nav[class|="menu"] ul.wp-nav-menu[data-direction="horizontal"] li .sub-menu .children,
	nav[class|="menu"] ul.wp-nav-menu[data-direction="horizontal"] li .children .children {
		left: calc(-50% + 1rem);
		top: 1.5rem;
	}
	nav[class|="menu"] ul.wp-nav-menu[data-direction="horizontal"] li .sub-menu .sub-menu .sub-menu,
	nav[class|="menu"] ul.wp-nav-menu[data-direction="horizontal"] li .children .sub-menu .sub-menu,
	nav[class|="menu"] ul.wp-nav-menu[data-direction="horizontal"] li .sub-menu .children .sub-menu,
	nav[class|="menu"] ul.wp-nav-menu[data-direction="horizontal"] li .children .children .sub-menu,
	nav[class|="menu"] ul.wp-nav-menu[data-direction="horizontal"] li .sub-menu .sub-menu .children,
	nav[class|="menu"] ul.wp-nav-menu[data-direction="horizontal"] li .children .sub-menu .children,
	nav[class|="menu"] ul.wp-nav-menu[data-direction="horizontal"] li .sub-menu .children .children,
	nav[class|="menu"] ul.wp-nav-menu[data-direction="horizontal"] li .children .children .children {
		left: calc(50% + 1rem);
		top: 1.5rem;
	}
	.emulsion-has-sidebar .primary-menu-wrapper.side-left .menu-placeholder {
		position: relative;
		z-index: 1;
		flex-basis: auto;
		width: auto;
		min-width: 0;
		flex: 1 0;
		text-align: right;
		padding-right: var(--thm_content_gap, 24px);
	}
	.emulsion-has-sidebar .primary-menu-wrapper.side-right .menu-placeholder {
		position: relative;
		z-index: 1;
		width: auto;
		min-width: 96px;
		flex: 1 1 auto;
	}
	body.on-scroll .primary-menu-wrapper.side-right input[type="checkbox"][data-skin="inset"][id="toc-toggle"]:checked ~ .toc {
		right: 0;
	}
	body.on-scroll .primary-menu-wrapper.side-left input[type="checkbox"][data-skin="inset"][id="toc-toggle"]:checked ~ .toc {
		right: auto;
		left: 0;
	}
}

@media screen and (max-width: $content_width_plus_content_gap) {

  .archive main .page-title-block .taxonomy-description {
	margin-left: 0;
	margin-right: 0;
	width: 100%;
	max-width: 100%;
  }
  .archive main .page-title-block .taxonomy-description p{
	padding-left:0;
	padding-right:0;
  }
}
@media screen and (max-width: $content_width_plus_content_gap) {
  body .template-part-header.header-image-active {
    height: auto;
    max-height: none;
  }
  body .template-part-header.header-image-active + div {
    padding-top: 0;
  }
  body .template-part-header.header-image-active .entry-text {
    overflow: visible;
    height: auto;
    padding-bottom: 1.5rem;
    margin-bottom: 0;
  }
  body .template-part-header.header-image-active .entry-text div {
    height: auto;
    overflow: visible;
  }
  .header-layer-nav-menu input[type="checkbox"][data-skin] + label[for="primary-menu-controll"] {
	visibility:visible;
    display: block;
  }
  .header-layer-nav-menu input[type="checkbox"][data-skin="hamburger"] ~ nav {
	visibility:hidden;
    /*display: none;*/
  }
  .header-layer-nav-menu input[type="checkbox"][data-skin="hamburger"]:checked ~ nav {

	visibility:visible;
    display: block;
    z-index: 10;
    position: absolute;
    right: 48px;
    top: 1.5rem;
  }

  .header-layer-nav-menu input[type="checkbox"][data-skin="hamburger"]:checked ~ nav .menu {
    width: 100%;
	display:block;
  }

  .header-layer-nav-menu input[type="checkbox"][data-skin="hamburger"]:checked ~ nav .menu .nav-menu-child-opener[type="checkbox"]:checked ~ label:before {
    background: url("{$theme_image_uri}/images/svg/arrow-up.svg#white");
    background-size: contain;
  }
  .on-scroll .template-part-header-custom ~ .primary-menu-wrapper {
    transition: box-shadow 0.5s ease-in-out;
    transition-property: box-shadow;
    transition-duration: 0.5s;
    transition-timing-function: ease-in-out;
    transition-delay: 0s;
    -webkit-box-shadow:var(--thm_box_shadow);
    -moz-box-shadow:var(--thm_box_shadow);
    box-shadow:var(--thm_box_shadow);
  }
  .template-part-header-custom ~ .primary-menu-wrapper input[type="checkbox"][data-skin] + label[for="primary-menu-controll"] {
    visibility: visible;
    display: block;
  }
  .template-part-header-custom ~ .primary-menu-wrapper input[type="checkbox"][data-skin="hamburger"] ~ nav {
    visibility: hidden;
    display: none;
  }
  .template-part-header-custom ~ .primary-menu-wrapper input[type="checkbox"][data-skin] + label[for="primary-menu-controll"] {
    margin: 0 1em 45px;
    display: block;
    vertical-align: middle;
    clear: both;
    position: relative;
    left: 0;
    top: 1.2rem;
    width: 45px;
  }
  .template-part-header-custom ~ .primary-menu-wrapper input[type="checkbox"][data-skin="hamburger"]:checked ~ nav {
    display: block;
    visibility: visible;
    z-index: 10;
    position: absolute;
    left: 72px;
    top: auto;
    width:calc(100vw - 72px - 1rem);
  }

  body.on-scroll .primary-menu-wrapper .menu-placeholder {
    padding-top: 0;
    margin-left: 48px;
    text-align: right;
  }
  body.on-scroll .primary-menu-wrapper input[type="checkbox"][data-skin="inset"][id="toc-toggle"]:checked ~ .toc {
    width: 50vw;
    right: 0;
    left: auto;
  }
  body.emulsion-has-sidebar .page-wrapper {
    width: var(--thm_content_width, 100%);
    min-width: 100%;
  }
  article footer {
    max-width: 100%;
  }
}
@media screen and (min-width: $content_width_plus_sidebar_width_plus1) {
  body.emulsion-has-sidebar .sidebar-widget-area{
    position: relative;
    z-index: 1;
    flex-basis: var(--thm_sidebar_width, 400px);
    flex: 0 0;
  }
  body .template-part-widget-footer.footer-widget-area {
    position: relative;
    z-index: 1;
    flex-basis: var(--thm_sidebar_width, 400px);
    flex: 0 0;
  }
}
@media screen and ( max-width : $content_width_plus_sidebar_width ) {
    body.emulsion-has-sidebar .sidebar-widget-area{
        position:relative;
        z-index:1;
        flex-basis:100%;
        width:100%;
        max-width:100%;
        flex:1 0;
    }
	ul.sidebar-widget-area-lists{
        width:100%;
		max-width:100%;
    }
}


@media screen and (min-width: $content_width_plus_sidebar_width_plus1) {
	.emulsion-has-sidebar .grid .wp-block-columns.alignfull,
	.emulsion-has-sidebar .grid .wp-block-text-columns.alignfull,
	.emulsion-has-sidebar .grid table.alignfull,
	.emulsion-has-sidebar .grid p.alignfull,
	.emulsion-has-sidebar .grid .wp-block-gallery.alignfull,
	.emulsion-has-sidebar .grid .entry-content figure.alignfull {
		width: 100%;
		margin-left: 0;
		margin-right: 0;
	}
	.enable-alignfull.emulsion-no-sidebar table.alignfull {
			width: calc(100vw - var( --thm_content_gap, 24px ) * 2);
			margin-left: calc(-50vw + var( --thm_content_gap, 24px ));
	}
}
@media screen and (max-width: $content_width_plus_sidebar_width) {
	.emulsion-has-sidebar .has-column {
		overflow-x: hidden;
	}
	.sidebar-widget-area{
        max-width:100vw;
    }
}
@media screen and (max-width: $content_width_plus_sidebar_width) {
	.enable-alignfull.emulsion-has-sidebar article .alignfull {
		/*max-width: none;*/
	}
}
@media screen and (max-width: $content_width_plus_sidebar_width) {

	div.emulsion-has-sidebar .sidebar-widget-area,
	div.emulsion-has-sidebar body .template-part-widget-footer.footer-widget-area,
	body div.emulsion-has-sidebar .template-part-widget-footer.footer-widget-area {
		min-width: 100vw;
	}

	.enable-alignfull.emulsion-has-sidebar table.alignfull,
	.enable-alignfull.emulsion-no-sidebar table.alignfull {
			width: calc(100vw - var( --thm_content_gap, 24px ) * 2);
			margin-left: calc(-50vw + var( --thm_content_gap, 24px ));
	}
}
@media screen and (max-width: $content_width_plus_sidebar_width_plus1) {
	body.emulsion-no-sidebar article header, body.emulsion-has-sidebar article header {
		margin: 0;
	}
	.emulsion-has-sidebar .nav-links {
		max-width: 100%;
	}
	.emulsion-has-sidebar .sidebar-widget-area,
	.emulsion-has-sidebar body .template-part-widget-footer.footer-widget-area,
	body .emulsion-has-sidebar .template-part-widget-footer.footer-widget-area {
		position: static;
	}
}
@media screen and (max-width: $content_width_plus_content_gap) {
	body header.template-part-header .header-layer-site-title-navigation {
		display: block;
	}

	body header.template-part-header .header-layer-site-title-navigation .header-text {
		display: block;
	}

	body header.template-part-header .header-layer-site-title-navigation .header-layer-nav-menu {
		display: block;
		position: absolute;
		top: 64px;
		right: 0;
		z-index: 8;
		width: 100vw;
		height: 53px;
	}
	body header.template-part-header .header-layer-site-title-navigation .header-layer-nav-menu nav[class|="menu"] {
		width: calc(100vw - 48px);
	}
	body header.template-part-header .header-layer-site-title-navigation .header-layer-nav-menu input[type="checkbox"][data-skin="hamburger"]:checked ~ nav {
		top: 0;
	}
	body.on-scroll.logged-in .template-part-header .header-layer-site-title-navigation {
		top: 32px;
	}
	body.on-scroll .template-part-header .header-layer-site-title-navigation {
	  max-width: 100%;
		top: 0;
	}
}
@media screen and (max-width: 600px) {
	body.on-scroll.logged-in .template-part-header .header-layer-site-title-navigation {
		top: 0;
	}
}
/**
 * Responsive
 */
@media screen and (max-width: 640px) {
	.entry-content.alignnone, .entry-content p.alignright,
	.entry-content p.alignleft, p.aligncenter,
	div.alignleft,
	img.alignleft,
	.alignleft,
	div.alignright,
	img.alignright,
	.alignright {
		float: none;
		clear: both;
		margin-left: auto;
		margin-right: auto;
	}
}
@media screen and (max-width: 600px) {
	.emulsion-has-sidebar.enable-alignfull .wp-block-media-text,
	.emulsion-no-sidebar.enable-alignfull .wp-block-media-text {
		grid-template-column: 50% 50%;
	}
	.emulsion-has-sidebar.enable-alignfull .wp-block-media-text.is-stacked-on-mobile,
	.emulsion-no-sidebar.enable-alignfull .wp-block-media-text.is-stacked-on-mobile {
		grid-template-areas: "media-text-media" "media-text-content";
		grid-template-columns: 100% ! important;
		grid-template-rows: 2;
		grid-column: span 1;
	}
	.on-scroll[class].logged-in .menu-active {
		margin-top: 0;
	}
}
@media (min-width: 600px) {
	.wp-block-gallery.columns-1 .blocks-gallery-image:nth-of-type(1n),
	.wp-block-gallery.columns-1 .blocks-gallery-item:nth-of-type(1n),
	.wp-block-gallery.columns-2 .blocks-gallery-image:nth-of-type(2n),
	.wp-block-gallery.columns-2 .blocks-gallery-item:nth-of-type(2n),
	.wp-block-gallery.columns-3 .blocks-gallery-image:nth-of-type(3n),
	.wp-block-gallery.columns-3 .blocks-gallery-item:nth-of-type(3n),
	.wp-block-gallery.columns-4 .blocks-gallery-image:nth-of-type(4n),
	.wp-block-gallery.columns-4 .blocks-gallery-item:nth-of-type(4n),
	.wp-block-gallery.columns-5 .blocks-gallery-image:nth-of-type(5n),
	.wp-block-gallery.columns-5 .blocks-gallery-item:nth-of-type(5n),
	.wp-block-gallery.columns-6 .blocks-gallery-image:nth-of-type(6n),
	.wp-block-gallery.columns-6 .blocks-gallery-item:nth-of-type(6n),
	.wp-block-gallery.columns-7 .blocks-gallery-image:nth-of-type(7n),
	.wp-block-gallery.columns-7 .blocks-gallery-item:nth-of-type(7n),
	.wp-block-gallery.columns-8 .blocks-gallery-image:nth-of-type(8n),
	.wp-block-gallery.columns-8 .blocks-gallery-item:nth-of-type(8n) {
		margin-right: var(--thm_box_gap);
	}
}
@media screen and (max-width: 480px) {
	body .sidebar-widget-area .widget_calendar .calendar_wrap,
	body .template-part-widget-footer.footer-widget-area .widget_calendar .calendar_wrap {
		margin-left: auto;
		margin-right: auto;
		text-align: center;
		padding-left: var(--thm_content_gap);
		padding-right: var(--thm_content_gap);
		box-sizing: border-box;
	}
}
CSS;



	$css = emulsion_sanitize_css( $css );

	return $css;
}

function emulsion_image_dir() {

	$theme_image_dir = esc_url( get_template_directory_uri() . '/images/' );
	$child_image_dir = esc_url( get_stylesheet_directory_uri() . '/images/' );

	if ( file_exists( $child_image_dir ) && is_child_theme() ) {

		$theme_image_dir = $child_image_dir;
	}

	$theme_image_dir = wp_make_link_relative( $theme_image_dir );

	return $theme_image_dir;
}
