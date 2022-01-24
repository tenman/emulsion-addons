<?php
class emulsion_add_meta_boxes {

	public $screens = array(

		'emulsion_post_sidebar'			 => array(
			'post_type'	 => 'post',
			'title'		 => 'Sidebar',
			'html'		 => 'emulsion_post_metabox_html',
			'args'		 => array(
				'icon'			 => '<span class="dashicons dashicons-lightbulb"></span>',
				'fields'		 => array( 'Default' => 'default', 'Remove Sidebar' => "no_sidebar" ),
				'description'	 => 'You can hide the sidebar for each post.',
			),
		),
		'emulsion_post_header'				 => array(
			'post_type'	 => 'post',
			'title'		 => 'Header',
			'html'		 => 'emulsion_post_metabox_html',
			'args'		 => array(
				'icon'			 => '<span class="dashicons dashicons-lightbulb"></span>',
				'fields'		 => array( 'Default' => 'default', 'Remove Header' => "no_header",'Reset Header Color Settings' => 'no_bg' ),
				'description'	 => 'This setting is mainly for page builder users.',
			),
		),

		'emulsion_post_theme_style_script'	 => array(
			'post_type'	 => 'post',
			'title'		 => 'Style',
			'html'		 => 'emulsion_post_metabox_html',
			'args'		 => array(
				'icon'			 => '<span class="dashicons dashicons-lightbulb"></span>',
				'fields'		 => array( 'Default' => 'default', 'Remove All Style, Script' => "no_style", "Reset Background Color" => 'no_bg' ),
				'description'	 => 'This setting is mainly for page builder users.',
			),
		),
		'emulsion_post_primary_menu'		 => array(
			'post_type'	 => 'post',
			'title'		 => 'Menu',
			'html'		 => 'emulsion_post_metabox_html',
			'args'		 => array(
				'icon'			 => '<span class="dashicons dashicons-lightbulb"></span>',
				'fields'		 => array( 'Default' => 'default', 'Remove Primary Menu' => "no_menu" ),
				'description'	 => 'Remove Primary Menu',
			),
		),
		'emulsion_post_background_image'		 => array(
			'post_type'	 => 'post',
			'title'		 => 'Background Image',
			'html'		 => 'emulsion_post_metabox_html',
			'args'		 => array(
				'icon'			 => '<span class="dashicons dashicons-lightbulb"></span>',
				'fields'		 => array( 'Default' => 'default', 'Remove Background Image' => "no_background" ),
				'description'	 => 'Remove Background Image',
			),
		),

		// Page
		'emulsion_page_sidebar'			 => array(
			'post_type'	 => 'page',
			'title'		 => 'Sidebar',
			'html'		 => 'emulsion_post_metabox_html',
			'args'		 => array(
				'icon'			 => '<span class="dashicons dashicons-lightbulb"></span>',
				'fields'		 => array( 'Default' => 'default', 'Remove Sidebar' => "no_sidebar" ),
				'description'	 => 'You can hide the sidebar for each page.',
			),
		),
		'emulsion_page_header'				 => array(
			'post_type'	 => 'page',
			'title'		 => 'Header',
			'html'		 => 'emulsion_post_metabox_html',
			'args'		 => array(
				'icon'			 => '<span class="dashicons dashicons-lightbulb"></span>',
				'fields'		 => array( 'Default' => 'default', 'Remove Header' => "no_header",'Reset Header Color Settings' => 'no_bg' ),
				'description'	 => 'This setting is mainly for page builder users.',
			),
		),
		'emulsion_page_theme_style_script'	 => array(
			'post_type'	 => 'page',
			'title'		 => 'Style',
			'html'		 => 'emulsion_post_metabox_html',
			'args'		 => array(
				'icon'			 => '<span class="dashicons dashicons-lightbulb"></span>',
				'fields'		 => array( 'Default' => 'default', 'Remove All Style, Script' => "no_style", "Reset Background Color" => 'no_bg'  ),
				'description'	 => 'This setting is mainly for page builder users.',
			),
		),
		'emulsion_page_primary_menu'		 => array(
			'post_type'	 => 'page',
			'title'		 => 'Menu',
			'html'		 => 'emulsion_post_metabox_html',
			'args'		 => array(
				'icon'			 => '<span class="dashicons dashicons-lightbulb"></span>',
				'fields'		 => array( 'Default' => 'default', 'Remove Primary Menu' => "no_menu" ),
				'description'	 => 'Remove Primary Menu',
			),
		),
		'emulsion_page_background_image'		 => array(
			'post_type'	 => 'page',
			'title'		 => 'Background Image',
			'html'		 => 'emulsion_post_metabox_html',
			'args'		 => array(
				'icon'			 => '<span class="dashicons dashicons-lightbulb"></span>',
				'fields'		 => array( 'Default' => 'default', 'Remove Background Image' => "no_background" ),
				'description'	 => 'Remove Background Image',
			),
		),
	);

	public function __construct() {

		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
		add_action( 'rest_api_init', array( $this, 'rest_save' ) );
		//$this->metabox_display_control();
		add_action( 'wp', array( $this, 'metabox_display_control' ) );
	}

	public function metabox_display_control() {

		if ( ! is_active_sidebar( 'sidebar-1' ) && is_single() ) {
			unset( $this->screens['emulsion_post_sidebar'] );
		}
		if ( ! is_active_sidebar( 'sidebar-3' ) && is_page() ) {
			unset( $this->screens['emulsion_page_sidebar'] );
		}

		$this->screens = $this->screens;
	}

	public function add_meta_box() {

		$args			 = $this->screens[key( $this->screens )]['args'];
		$metabox_label	 = '';
		if ( current_user_can( 'edit_posts' ) ) {

			if( 'boilerplate' == get_theme_mod( 'emulsion_scheme' ) ) {

				unset( $this->screens['emulsion_post_theme_style_script'] );
			}

			foreach ( $this->screens as $key => $screen ) {

				if ( 'Sidebar' == $screen['title'] ) {

					add_meta_box(
							$key, esc_html__( 'Sidebar', 'emulsion-addons' ), $screen['html'], $screen['post_type'], 'side', 'low', $screen['args']
					);
				} elseif ( 'Header' == $screen['title'] ) {

					add_meta_box(
							$key, esc_html__( 'Header', 'emulsion-addons' ), $screen['html'], $screen['post_type'], 'side', 'low', $screen['args']
					);
				} elseif ( 'Style' == $screen['title'] ) {

					add_meta_box(
							$key, esc_html__( 'Style', 'emulsion-addons' ), $screen['html'], $screen['post_type'], 'side', 'low', $screen['args']
					);
				} elseif ( 'Menu' == $screen['title'] ) {

					add_meta_box(
							$key, esc_html__( 'Menu', 'emulsion-addons' ), $screen['html'], $screen['post_type'], 'side', 'low', $screen['args']
					);
				} elseif ( 'Background Image' == $screen['title'] ) {

					add_meta_box(
							$key, esc_html__( 'Background Image', 'emulsion-addons' ), $screen['html'], $screen['post_type'], 'side', 'low', $screen['args']
					);
				} else {

					add_meta_box(
							$key, $screen['title'], $screen['html'], $screen['post_type'], 'side', 'low', $screen['args']
					);
				}
			}
		}
	}
	public function rest_save( $post_id ) {

	}
	public function save( $post_id ) {

		if ( ! current_user_can( 'edit_posts' ) ) {

			return;
		}

		if ( isset( $this->screens ) ) {

			foreach ( $this->screens as $key => $screen ) {

				$key_check = filter_input(INPUT_POST, $key );
				if ( isset( $key_check ) && ! empty( $key_check ) ) {

					$nonce		 = $key . '-nonce';
					$nonce =  filter_input(INPUT_POST, $nonce );
					$post_type	 = filter_input(INPUT_POST, 'post_type' );

					if ( ! isset( $nonce ) ||
							! wp_verify_nonce( $nonce, $key ) ||
							defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ||
							'post' == $post_type && ! current_user_can( 'edit_posts', $post_id ) ||
							'page' == $post_type && ! current_user_can( 'edit_pages', $post_id ) ) {

						return;
					}

					$data = wp_filter_nohtml_kses( filter_input(INPUT_POST, $key ) );
					update_post_meta( $post_id, $key, $data );
				}
			}
		}
	}

}

function emulsion_header_reset_no_bg( $css ){

	$post_id = get_the_ID();

	$text_color	 = emulsion_header_text_color_reset();
	$link_color	 = emulsion_header_link_color_reset();
	$hover_color = emulsion_header_text_color_reset();
	$header_bg	 = emulsion_header_background_color_reset();

	$css_reset = <<<CSS

	body.page-id-{$post_id}.metabox-reset-page-header,
	body.postid-{$post_id}.metabox-reset-post-header{
		--thm_header_text_color:{$text_color};
		--thm_header_link_color: {$link_color};
		--thm_header_hover_color: {$hover_color};
		--thm_header_bg_color: {$header_bg};
		--thm_header_background_gradient_color: {$header_bg};
	}

CSS;

	$setting = get_post_meta( $post_id, 'emulsion_post_header', true );
	$setting_page = get_post_meta( $post_id, 'emulsion_page_header', true );

	if ( 'no_bg' == $setting && is_single() || 'no_bg' == $setting_page && is_page()) {

			return $css. $css_reset;
	}
	return $css;
}

function emulsion_reset_no_bg( $css ){

	$post_id = get_the_ID();


	$sidebar_background		 = emulsion_sidebar_background_reset();
	$header_bg_color		 = emulsion_header_background_color_reset();
	$background_color		 = emulsion_background_color_reset();
	$general_text_color		 = emulsion_general_text_color_reset();
	$general_link_color		 = emulsion_general_link_color_reset();
	$primary_menu_background = emulsion_primary_menu_background_reset();
	$sidebar_color			 = emulsion_sidebar_text_color_reset();
	$sidebar_link_color		 = emulsion_sidebar_link_color_reset();
	$header_text_color		 = emulsion_header_text_color_reset();
	$header_link_color		 = emulsion_header_link_color_reset();
	$primary_menu_link_color = emulsion_primary_menu_link_color_reset();
	$primary_menu_color		 = emulsion_primary_menu_text_color_reset();


	$css_reset = <<<CSS

		.page-id-{$post_id}.metabox-reset-page-presentation,
		.postid-{$post_id}.metabox-reset-post-presentation{

			--thm_gallery_section_link_color: {$general_link_color};
			--thm_gallery_section_color: {$general_text_color};
			--thm_gallery_section_bg: {$general_text_color};
			--thm_columns_section_link_color: {$general_link_color};
			--thm_columns_section_color: {$general_text_color};
			--thm_columns_section_bg: {$background_color};
			--thm_media_text_section_link_color: {$general_link_color};
			--thm_media_text_section_color: {$general_text_color};
			--thm_media_text_section_bg: {$background_color};
			--thm_relate_posts_link_color: {$general_link_color};
			--thm_relate_posts_color: {$general_text_color};
			--thm_relate_posts_bg: {$background_color};
			--thm_comments_link_color: {$general_link_color};
			--thm_comments_color: {$general_text_color};
			--thm_comments_bg: {$background_color};
			--thm_social_icon_color:{$general_link_color};

			--thm_general_text_color:{$general_text_color};
			--thm_general_link_color:{$general_link_color};
			--thm_primary_menu_background:{$primary_menu_background};
			--thm_primary_menu_link_color:$primary_menu_link_color;
			--thm_primary_menu_color:$primary_menu_color;
			--thm_sidebar_bg_color:{$sidebar_background};
			--thm_sidebar_text_color:{$sidebar_color};
			--thm_sidebar_link_color:{$sidebar_link_color};
			--thm_background_color:{$background_color};
		}
		.page-id-{$post_id}.metabox-reset-page-presentation.custom-background,
		.postid-{$post_id}.metabox-reset-post-presentation.custom-background{
			background:{$background_color};
		}
CSS;

	$setting = get_post_meta( $post_id, 'emulsion_post_theme_style_script', true );
	$setting_page = get_post_meta( $post_id, 'emulsion_page_theme_style_script', true );

	if ( 'no_bg' == $setting && is_single() || 'no_bg' == $setting_page && is_page()) {

			return $css. $css_reset;
	}

	return $css;

}

function emulsion_post_metabox_html( $post, $callback_args ) {

	$checked = get_post_meta( $post->ID, $callback_args["id"], true );

	if ( empty( $checked ) ) {
		$checked = 'default';
	}

	$echo = true;
	$nonce = $callback_args['id'] . '-nonce';

	echo '<input type="hidden" '
	. 'name="' . esc_attr( $nonce ) . '"'
	. ' id="' . esc_attr( $nonce ) . '"'
	. ' value="' . esc_attr( wp_create_nonce( $callback_args['id'] ) ) . '" />';

	if ( 'emulsion_post_sidebar' == $callback_args['id'] ) {
		$description = esc_html__( 'You can hide the sidebar for each post.', 'emulsion-addons' );
	}
	if ( 'emulsion_post_theme_style_script' == $callback_args['id'] ||
			'emulsion_post_header' == $callback_args['id'] ||
			'emulsion_page_header' == $callback_args['id'] ||
			'emulsion_page_theme_style_script' == $callback_args['id'] ) {

		$description = esc_html__( 'This setting is mainly for page builder users.', 'emulsion-addons' );
	}
	if ( 'emulsion_page_sidebar' == $callback_args['id'] ) {
		$description = esc_html__( 'You can hide the sidebar for each page.', 'emulsion-addons' );
	}
	if ( 'emulsion_post_primary_menu' == $callback_args['id'] ||
			'emulsion_page_primary_menu' == $callback_args['id'] ) {
		$description = esc_html__( 'Remove Primary Menu', 'emulsion-addons' );
	}
	if ( 'emulsion_post_background_image' == $callback_args['id'] ||
			'emulsion_page_background_image' == $callback_args['id'] ) {
		$description = esc_html__( 'Remove Background Image', 'emulsion-addons' );
	}

	?>
	<p><?php echo wp_kses( $callback_args['args']['icon'], array('span' => array('class' => array() ) ) ) ?><?php echo esc_html( $description ); ?></p>
	<?php
	emulsion_radio_fields( $checked, $callback_args['id'], $callback_args['args']['fields'] );
}

function emulsion_radio_fields( $current_field, $group_name = '', $fields = array() ) {

	foreach ( $fields as $key => $val ) {

		if( 'Default' == $key ) {

			printf( '<p><input type="radio" id="%1$s" name="%2$s" value="%3$s" %4$s><label for="%5$s">%6$s</label></p>',
					esc_attr( $val ),
					esc_attr( $group_name ),
					esc_attr( $val ),
					checked( $current_field, $val, false ),
					esc_attr( $val ),
					esc_html__( 'Default', 'emulsion-addons' )
					);
		}elseif( 'Remove Sidebar' == $key ) {

			printf( '<p><input type="radio" id="%1$s" name="%2$s" value="%3$s" %4$s><label for="%5$s">%6$s</label></p>',
					esc_attr( $val ),
					esc_attr( $group_name ),
					esc_attr( $val ),
					checked( $current_field, $val, false ),
					esc_attr( $val ),
					esc_html__( 'Remove Sidebar', 'emulsion-addons' )
					);
		}elseif( 'Reset Header Color Settings' == $key ) {

			printf( '<p><input type="radio" id="%1$s" name="%2$s" value="%3$s" %4$s><label for="%5$s">%6$s</label></p>',
					esc_attr( $val ),
					esc_attr( $group_name ),
					esc_attr( $val ),
					checked( $current_field, $val, false ),
					esc_attr( $val ),
					esc_html__( 'Reset Header Color Settings', 'emulsion-addons' )
					);
		}elseif( 'Reset Background Color' == $key ) {

			printf( '<p><input type="radio" id="%1$s" name="%2$s" value="%3$s" %4$s><label for="%5$s">%6$s</label></p>',
					esc_attr( $val ),
					esc_attr( $group_name ),
					esc_attr( $val ),
					checked( $current_field, $val, false ),
					esc_attr( $val ),
					esc_html__( 'Reset Background Color', 'emulsion-addons' )
					);
		}elseif( 'Remove Header' == $key ) {

			printf( '<p><input type="radio" id="%1$s" name="%2$s" value="%3$s" %4$s><label for="%5$s">%6$s</label></p>',
					esc_attr( $val ),
					esc_attr( $group_name ),
					esc_attr( $val ),
					checked( $current_field, $val, false ),
					esc_attr( $val ),
					esc_html__( 'Remove Header', 'emulsion-addons' )
					);
		}elseif( 'Remove All Style, Script' == $key ) {

			printf( '<p><input type="radio" id="%1$s" name="%2$s" value="%3$s" %4$s><label for="%5$s">%6$s</label></p>',
					esc_attr( $val ),
					esc_attr( $group_name ),
					esc_attr( $val ),
					checked( $current_field, $val, false ),
					esc_attr( $val ),
					esc_html__( 'Remove All Style, Script', 'emulsion-addons' )
					);
		}elseif( 'Remove Primary Menu' == $key ) {

			printf( '<p><input type="radio" id="%1$s" name="%2$s" value="%3$s" %4$s><label for="%5$s">%6$s</label></p>',
					esc_attr( $val ),
					esc_attr( $group_name ),
					esc_attr( $val ),
					checked( $current_field, $val, false ),
					esc_attr( $val ),
					esc_html__( 'Remove Primary Menu', 'emulsion-addons' )
					);
		} else {
			printf( '<p><input type="radio" id="%1$s" name="%2$s" value="%3$s" %4$s><label for="%5$s">%6$s</label></p>',
					esc_attr( $val ),
					esc_attr( $group_name ),
					esc_attr( $val ),
					checked( $current_field, $val, false ),
					esc_attr( $val ),
					esc_html( $key )
					);
		}
	}
}

//emulsion_get_supports('metabox') ? new emulsion_add_meta_boxes() : '';
