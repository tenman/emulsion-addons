<?php
if ( ! function_exists( 'emulsion_has_archive_format' ) ) {
	/**
	 * Determine whether the archive page is full text or summary
	 *
	 * @param type $supports_stream
	 * @return string
	 */
	function emulsion_has_archive_format( $supports_stream = array() ) {

		$post_id		 = get_the_ID();
		$post_body_type	 = emulsion_the_theme_supports( 'excerpt' );

		if ( false !== $post_id && ! empty( $supports_stream[0] ) ) {

			foreach ( $supports_stream[0] as $stream ) {

				if ( is_string( $stream ) ) {

					$conditiona_func_name = 'is_' . $stream;

					if ( 'blog' == $stream ) {
						$conditiona_func_name = 'emulsion_is_posts_page';
					}
					if ( 'post_tag' == $stream ) {
						$conditiona_func_name = 'is_tag';
					}

					if ( function_exists( $conditiona_func_name ) && $conditiona_func_name() ) {

						if( $post_body_type ) {
							return 'excerpt';
						} else {
							return 'full-text';
						}

					}
				} elseif ( is_array( $stream ) && 'post_type' == key( $stream ) ) {

					foreach ( $stream as $custom_post ) {

						if ( is_post_type_archive( $custom_post ) ) {

							if( $post_body_type ) {
								return 'excerpt';
							} else {
								return 'full-text';
							}
						}
					}
				}
			}
		}
	}

}


if ( ! function_exists( 'emulsion_post_excerpt_more' ) ) {
	/**
	 * grid layout read more
	 */
	function emulsion_post_excerpt_more() {

		$supports_grid	 = emulsion_the_theme_supports( 'grid' );
		$grid			 = emulsion_has_archive_format( $supports_grid );
		$post_id		 = get_the_ID();

		if( false === $post_id ){
			__return_empty_string();
		}

		$permalink		 = get_permalink( $post_id );
		$article		 = get_post( $post_id );

		if ( $article ) {

			if ( preg_match( '$<!--more-->$', $article->post_content ) && 'excerpt' == $grid ) {

				printf( '<span><a href="%1$s#top" class="skin-button">%2$s<span class="screen-reader-text read-more-context">%3$s</span></a></span>',
						esc_url( $permalink ),
						esc_html__( 'Read More', 'emulsion-addons' ),
						/* translators: %1$s entry title */
						sprintf( esc_html__('link to post %1$s' ,'emulsion-addons'), wp_kses_post( $article->post_title ) ) );
			}
		}
	}
}

