<?php

/**
 * Theme options page
 */
emulsion_add_supports( 'theme_documents' );
/**
 * enqueue style and script
 */
emulsion_add_supports( 'enqueue' );

emulsion_add_supports( 'primary_menu' );
/**
 * Search drawer
 */
emulsion_add_supports( 'search_drawer' );
//get_theme_mod( 'emulsion_search_drawer', emulsion_get_var( 'emulsion_search_drawer' ) ) == 'disable' ? emulsion_remove_supports( 'search_drawer' ) : '';

/**
 * Search keyword highlight
 */
emulsion_add_supports( 'search_keyword_highlight' );
//get_theme_mod( 'emulsion_layout_search_results', emulsion_get_var( 'emulsion_layout_search_results' ) ) == 'full_text' ? emulsion_remove_supports( 'search_keyword_highlight' ) : '';

/**
 * Sidebar
 */
emulsion_add_supports( 'sidebar' );
emulsion_add_supports( 'sidebar_page' );

/**
 * Ecitor metabox
 */
emulsion_add_supports( 'metabox' );

/**
 * Footer
 */
//emulsion_add_supports( 'footer', array( 'cols' => 4 ) );
emulsion_add_supports( 'footer' );
emulsion_add_supports( 'footer_page' );
//emulsion_customizer_add_supports_footer();

/**
 * Alignfull
 */
emulsion_add_supports( 'alignfull' );
//get_theme_mod( 'emulsion_alignfull', emulsion_get_var( 'emulsion_alignfull' ) ) == 'disable' ? emulsion_remove_supports( 'alignfull' ) : '';

/**
 * Layout
 */
/**
 * Title
 */
emulsion_add_supports( 'title_in_page_header' );
//get_theme_mod( 'emulsion_title_in_header', emulsion_get_var( 'emulsion_title_in_header' ) ) == 'no' ? emulsion_remove_supports( 'title_in_page_header' ) : '';

/**
 * Table of contents
 */
emulsion_add_supports( 'toc' );
//get_theme_mod( 'emulsion_table_of_contents', emulsion_get_var( 'emulsion_table_of_contents' ) ) == 'disable' ? emulsion_remove_supports( 'toc' ) : '';

/**
 * Header
 */
emulsion_add_supports( 'header', array(
	'default' => array(
		'default-text-color'	 => '333333',
		'width'					 => 0,
		'flex-width'			 => true,
		'height'				 => 0,
		'flex-height'			 => true,
		'header-text'			 => true,
		'default-image'			 => '',
		'wp-head-callback'		 => apply_filters( 'emulsion_wp_head_callback', '' ),
		'admin-head-callback'	 => '',
		'admin-preview-callback' => '',
	),
		)
);

//get_theme_mod( 'emulsion_page_header', emulsion_get_var( 'emulsion_page_header' ) ) == 'remove' ? emulsion_remove_supports( 'header' ) : '';

/**
 * Background
 */
emulsion_add_supports( 'background' );
/**
 * Custom Logo
 */
emulsion_add_supports( 'custom-logo' );

/**
 * SVG
 * include footer
 */
emulsion_add_supports( 'social-link-menu' );

emulsion_add_supports( 'footer-svg' );

/**
 * Excerpt
 */
emulsion_add_supports( 'excerpt' );
/**
 * relate posts
 */
emulsion_add_supports( 'relate_posts' );
//get_theme_mod( 'emulsion_relate_posts', emulsion_get_var( 'emulsion_relate_posts' ) ) == 'disable' ? emulsion_remove_supports( 'relate_posts' ) : '';

/**
 * Tooltip
 */
emulsion_add_supports( 'tooltip' );
//get_theme_mod( 'emulsion_tooltip', emulsion_get_var( 'emulsion_tooltip' ) ) == 'disable' ? emulsion_remove_supports( 'tooltip' ) : '';

/**
 * AMP
 */
emulsion_add_supports( 'amp' ); //https://wordpress.org/plugins/amp/

/**
 * utility
 */
emulsion_add_supports( 'entry_content_filter' );

/**
 * sectionize
 */
//emulsion_add_supports( 'block_sectionize' ); // gutenberg block wrap with section elements

/**
 * background pattern
 */
emulsion_add_supports( 'background_css_pattern' );

/**
 * meta description
 */
emulsion_add_supports( 'meta_description' );

/**
 * Viewport
 * header meta viewport element
 */
emulsion_add_supports( 'viewport' );
/**
 * Plugin TGMPA
 */
emulsion_add_supports( 'TGMPA' );

//! emulsion_is_user_logged_in() 後で検証
if ( ! is_admin() && ! is_customize_preview() && empty( $_GET ) ) {

	emulsion_add_supports( 'instantclick' );
	//get_theme_mod( 'emulsion_instantclick', emulsion_get_var( 'emulsion_instantclick' ) ) == 'disable' ? emulsion_remove_supports( 'instantclick' ) : '';

	emulsion_add_supports( 'lazyload' );
	//get_theme_mod( 'emulsion_lazyload', emulsion_get_var( 'emulsion_lazyload' ) ) == 'disable' ? emulsion_remove_supports( 'lazyload' ) : '';
}

if ( ! function_exists( 'amp_init' ) ) {

	emulsion_remove_supports( 'amp' );
}
/**
 * Block Editor experimantal styles
 *
 */
emulsion_add_supports( 'block_experimentals' );
/**
 * Scheme
 */
emulsion_add_supports( 'scheme' );

/**
 * FSE
 */
emulsion_add_supports( 'full_site_editor' );

if ( 'fse' == get_theme_mod( 'emulsion_editor_support', false ) ) {

	emulsion_remove_supports( 'sidebar' );
	emulsion_remove_supports( 'sidebar-page' );
	//emulsion_remove_supports( 'title_in_page_header' );
	//emulsion_remove_supports( 'scheme' );
}



