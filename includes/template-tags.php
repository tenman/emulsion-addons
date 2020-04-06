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
if ( ! function_exists( 'emulsion_post_content' ) ) {
	/**
	 * The summary sentence displays the text that removes the table element,
	 * the figure element excluded from the HTML5 outline, etc.,
	 * which significantly impairs readability when the text is extracted.
	 */

	function emulsion_post_content() {
		

		$use_excerpt	 = emulsion_the_theme_supports( 'excerpt' );
		$supports_stream = emulsion_the_theme_supports( 'stream' );
		$supports_grid	 = emulsion_the_theme_supports( 'grid' );

		$message_protected_post	 = esc_html__( 'Password is required to view this post', 'emulsion' );
		$post_id				 = get_the_ID();
		$stream					 = emulsion_has_archive_format( $supports_stream );
		$grid					 = emulsion_has_archive_format( $supports_grid );
		$get_post				 = get_post( $post_id, 'OBJECT', 'display' );
		$excerpt_length			 = apply_filters( 'excerpt_length', 256 );
		$read_more_text			 = esc_html__( '...', 'emulsion' );
		$excerpt_from_content	 = '';
		$excerpt_html_wrapper	 = '<blockquote cite="%2$s" class="content-excerpt">%1$s</blockquote>';

		// Create excerpt from entry content
		$post_text = strip_shortcodes( $get_post->post_content );
		$has_more	 = stristr( $post_text, '<!--more-->' );

		if( empty( $post_id ) && ! empty( $post_text ) ) {
			//case bbpress forums, woocommerce product-category
			echo wp_kses_post( $get_post->post_content );
			return;
		}

		if ( ! empty( $post_text ) ) {

			/**
			 * Delete deactivated short code
			 * it is not certain,but
			 */

			$post_text = preg_replace( '!\[[^\]]+\]!', '', $post_text );

			/**
			 * add space end tag before element text
			 * Even if tags are removed, keep space and increase readability
			 */

			$word_separate_count = 0;

			$post_text	 = str_replace( '</', ' </', $post_text, $word_separate_count );

			/**
			 * remove element and their contents
			 */

			$post_text	 = emulsion_strip_tags_content( $post_text, '<table><del><figure><blockquote>', true );

			/**
			 * Remove Comments
			 */

			$post_text	 = strip_tags( $post_text );

			/**
			 * remove white space More than 3 consecutive times to 2 (paragraph)
			 */

			$post_text	 = preg_replace( '/(\s\s)\s+/', '$1', $post_text );
			/**
			 * remove &nbsp;
			 */
			$post_text	 = preg_replace( '!\s*&nbsp;\s*!', '', $post_text );

			/**
			 * remove text URL oEmbed etc. Delete text URL
			 *
			 */

			$post_text	 = emulsion_remove_url_from_text( $post_text );

			/**
			 * To keeping line breaks, substitute with alternative characters
			 */

			$post_text	 = str_replace( array( "\r\n\r\n" ), array( "[lb2]" ), $post_text, $count_paragraph );
			$post_text	 = str_replace( array( "\n\n", "\n" ), array( "[lb2]", "[lb1]" ), $post_text, $count_break );

			/**
			 * Adjust the increased number of characters by substitution character
			 * Not correct but
			 */

			if ( ! empty( $count ) ) {

				$excerpt_length = $excerpt_length + $count_paragraph * 2 + $count_break;
			}

			/**
			 * Deletion of html element and setting character length
			 * not word count , string length
			 */

			/* translators: ... is read more */
			$post_text	 = wp_html_excerpt( $post_text, $excerpt_length, $read_more_text );

			/**
			 * Return an alternate character to a line feed to hold line breaks
			 */

			$post_text	 = str_replace( array( "[lb2]", "[lb1]" ), array( "\r\n\r\n", "\r\n" ), $post_text );

			$post_text = preg_replace( array( '/\[[lb12]*(' . $read_more_text . ')?\s*$/' ), $read_more_text, $post_text );

			/**
			 * the blockquote element to indicate that it is not the posted content itself
			 */

			$post_text = trim( $post_text );

			if ( $read_more_text !== $post_text && ! empty( $post_id ) ) {

				$excerpt_from_content = sprintf( $excerpt_html_wrapper, wpautop( $post_text ), get_permalink( $post_id ) );
			} else {

				$excerpt_from_content = '';
			}
		}

		// has excerpt allow all elements

		$has_excerpt = $get_post->post_excerpt;

		if ( ! $has_excerpt ) {

			$excerpt_plain_text = trim( wp_strip_all_tags( $excerpt_from_content ) );
		} else {

			$excerpt_plain_text = trim( wp_strip_all_tags( $has_excerpt ) );
		}

		if ( ! post_password_required( $post_id ) ) {

			if ( 'excerpt' == $grid ) {

				$lines	 = absint( get_theme_mod( 'emulsion_excerpt_length_grid', 4 ) );
				$result	 = sprintf( '<p class="%2$s" data-rows="%3$d">%1$s</p>', wp_kses_post( $excerpt_plain_text ), 'trancate', $lines );
				$result	 = apply_filters( 'the_excerpt', $result );

				echo wp_kses( $result, EMULSION_EXCERPT_ALLOWED_ELEMENTS );
			} elseif ( 'excerpt' == $stream ) {

				$lines	 = absint( get_theme_mod( 'emulsion_excerpt_length_stream', 2 ) );
				$result	 = sprintf( '<p class="%2$s" data-rows="%3$d">%1$s</p>', wp_kses_post( $excerpt_plain_text ), 'trancate', $lines );
				$result	 = apply_filters( 'the_excerpt', $result );

				echo wp_kses( $result, EMULSION_EXCERPT_ALLOWED_ELEMENTS );
			} else {

				if ( ! $use_excerpt || is_search() ) {

						the_content();

				} else {

					if ( ! is_singular() ) {

						if ( ! $has_excerpt && $excerpt_from_content ) {

							if ( false === $has_more ) {

								$excerpt_from_content  = apply_filters('the_excerpt', $excerpt_from_content );
																																
								echo wp_kses_post( $excerpt_from_content );
							} else {
								/**
								 * The HTML element from the beginning of the post to the read-more tag is displayed without being deleted.
								 */
								the_content();
							}
						} elseif ( $has_excerpt ) {
							/**
							 * Since the specially-written summary sentence may not necessarily quote the content, we do not use blockquote
							 */
							if( 0 == strcmp( trim( $has_excerpt ), $excerpt_plain_text ) ) {

								$has_excerpt  = apply_filters('the_excerpt', $has_excerpt );
								
								echo wpautop( $has_excerpt );
							} else {
							    //Wrap with fit class to match content_width
								$has_excerpt = sprintf('<div class="post-excerpt-html fit">%1$s</div>', $has_excerpt );
								$has_excerpt  = apply_filters('the_excerpt', $has_excerpt );
								
								echo  $has_excerpt;
							}
						}
					} else {

						the_content();
					}
				}
			}
		} else {

				echo get_the_password_form( $post_id );		
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
						esc_html__( 'Read More', 'emulsion' ),
						/* translators: %1$s entry title */
						sprintf( esc_html__('link to post %1$s' ,'emulsion'), wp_kses_post( $article->post_title ) ) );
			}
		}
	}
}

