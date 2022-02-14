<?php
add_action( 'admin_menu', 'emulsion_settings_page_init' );

/**
 * Create Page
 */
function emulsion_settings_page_init() {

	$theme_name		 = emulsion_theme_info( 'Name', false );
	$settings_page	 = add_theme_page( $theme_name . ' Documents', $theme_name . ' Documents', 'edit_theme_options', 'theme-settings', 'emulsion_settings_page' );

	if ( $settings_page ) {
		add_action( 'admin_print_styles-' . $settings_page, 'emulsion_document_style', 99 );
	}
}

/**
 * Page CSS
 */
function emulsion_document_style() {

	$css = <<<CSS
		.admin-color-fresh,
		.admin-color-default{
			--thm_emulsion-accent-bg:#fff;
			--thm_emulsion-accent-fg:#222;



		}
		.wrap-emulsion_document_shortcode .admin-color-fresh a,
		.wrap-emulsion_document_shortcode .admin-color-default a,
		.emulsion-document .admin-color-fresh a,
		.emulsion-document .admin-color-default a{
				color:var(--thm_emulsion-accent-fg);
			}
		.color-scheme-default,
		.color-scheme-fresh{
			background:#fff;
			color:#222;

		}

		.emulsion-document .color-scheme-default a,
		.emulsion-document .color-scheme-fresh	a{
				color:#222;
		}

		.color-scheme-light,
		.admin-color-light{
			--thm_emulsion-accent-bg:#e5e5e5;
			--thm_emulsion-accent-fg:#333;
		}
		.wrap-emulsion_document_shortcode .color-scheme-light,
		.emulsion-document .color-scheme-light,
		.color-scheme-light{
			background:var(--thm_emulsion-accent-bg);
			color:var(--thm_emulsion-accent-fg);

		}
		.wrap-emulsion_document_shortcode .color-scheme-light a,
		.emulsion-document .color-scheme-light	a,
		.wrap-emulsion_document_shortcode .admin-color-light a,
		.emulsion-document .admin-color-light a{
				color:var(--thm_emulsion-accent-fg);
		}

		.admin-color-blue{
			--thm_emulsion-accent-bg:#52accc;
			--thm_emulsion-accent-fg:#fff;

		}
		.wrap-emulsion_document_shortcode .admin-color-blue a,
		.emulsion-document .admin-color-blue a{
				color:var(--thm_emulsion-accent-fg);
			}
		.wrap-emulsion_document_shortcode .color-scheme-blue,
		.emulsion-document .color-scheme-blue,
		.color-scheme-blue{
			background:#52accc;
			color:#fff;
		}
		.emulsion-document .color-scheme-blue a{
			color:#fff;
		}
		.admin-color-coffee{
			--thm_emulsion-accent-bg:#59524c;
			--thm_emulsion-accent-fg:#fff;

		}
		.wrap-emulsion_document_shortcode .admin-color-coffee a,
		.emulsion-document .admin-color-coffee	a{
				color:var(--thm_emulsion-accent-fg);
			}
		.emulsion-document .color-scheme-coffee *,
		.color-scheme-coffee{
			background:#59524c;
			color:#fff;
		}
		.wrap-emulsion_document_shortcode .color-scheme-coffee a,
		.emulsion-document .color-scheme-coffee a{
			color:#fff;
		}
		.admin-color-ectoplasm{
			--thm_emulsion-accent-bg:#523f6d;
			--thm_emulsion-accent-fg:#fff;

		}
		.wrap-emulsion_document_shortcode .admin-color-ectoplasm a,
		.emulsion-document .admin-color-ectoplasm a{
			color:var(--thm_emulsion-accent-fg);
		}
		.wrap-emulsion_document_shortcode .admin-color-ectoplasm h3,
		.emulsion-document .color-scheme-ectoplasm h3,
		.wrap-emulsion_document_shortcode .admin-color-ectoplasm,
		.emulsion-document .color-scheme-ectoplasm,
		.color-scheme-ectoplasm{
			background:#523f6d;
			color:#fff;
		}
		.wrap-emulsion_document_shortcode .color-scheme-ectoplasm a,
		.emulsion-document .color-scheme-ectoplasm a{
			background:transparent;
			color:#fff;
		}
		.admin-color-midnight{
			--thm_emulsion-accent-bg:#363b3f;
			--thm_emulsion-accent-fg:#fff;

		}
		.wrap-emulsion_document_shortcode .admin-color-midnight a,
		.emulsion-document .admin-color-midnight a{
			color:var(--thm_emulsion-accent-fg);
			}
		.emulsion-document .color-scheme-midnight *,
		.color-scheme-midnight{
			background:#363b3f;
			color:#fff;
		}
		.wrap-emulsion_document_shortcode .color-scheme-midnight a,
		.emulsion-document .color-scheme-midnight a{
			color:#fff;
		}
		.admin-color-ocean{
			--thm_emulsion-accent-bg:#738e96;
			--thm_emulsion-accent-fg:#fff;

		}
		.wrap-emulsion_document_shortcode .admin-color-ocean a,
		.emulsion-document .admin-color-ocean a{
			color:var(--thm_emulsion-accent-fg);
			}
		.emulsion-document .color-scheme-ocean *,
		.color-scheme-ocean{
			background:#738e96;
			color:#fff;
		}
		.wrap-emulsion_document_shortcode .color-scheme-ocean a,
		.emulsion-document .color-scheme-ocean a{
			color:#fff;
		}
		.admin-color-sunrise{
			--thm_emulsion-accent-bg:#cf4944;
			--thm_emulsion-accent-fg:#fff;

		}
		.wrap-emulsion_document_shortcode .color-scheme-sunrise a,
		.emulsion-document .color-scheme-sunrise a,
		.wrap-emulsion_document_shortcode .admin-color-sunrise a,
		.emulsion-document .admin-color-sunrise a{
			color:#fff;
		}

		.wrap-emulsion_document_shortcode .color-scheme-sunrise,
		.emulsion-document .color-scheme-sunrise,
		.color-scheme-sunrise{
			background:#cf4944;
			color:#fff;
		}

		p{
			padding-left:24px;
			padding-right:24px;
		}
		.wrap-emulsion_document_shortcode p{
			 margin-top:1.5rem;
			margin-bottom:0;
		}
		div#wpcontent{
			padding-left:0;
		}
		#wpbody-content .emulsion-document{
			width:auto;
			max-width:100%;
			margin-left:auto;
			margin-right:auto;
			font-size:13px;

		}
		.emulsion-document header{

		}
		.emulsion-document footer{
			text-align:center;
			padding:1.5rem 1.5rem .75rem;

		}
		.emulsion-document .nav-tab-wrapper{
			margin-left:1rem;
			margin-right:1rem;
		}
		.nav-tab-wrapper .nav-tab {
			float: left;
			border: 1px solid #ccc;
			border-bottom: none;
			margin-left: 0.5em;
			padding: 5px 10px;
			font-size: 14px;
			line-height: 1.71428571;
			font-weight: 600;
			background: #fff;
			color: #555;
			text-decoration: none;
			white-space: nowrap;
		}

		.nav-tab-wrapper .nav-tab:hover,
		.nav-tab-wrapper .nav-tab:focus {
			background-color: #eee;
			color: #444;
		}
		.nav-tab-wrapper .nav-tab-active{
			background:var(--thm_emulsion-accent-bg);
			color:var(--thm_emulsion-accent-fg);
		}
		#poststuff{
			padding-left:1.5rem;
			padding-right:1.5rem;
			box-sizing:border-box;
		}
		.emulsion-document-header{
			padding:1.5rem 1.5rem .75rem;
			background:#efefef;
		}
		.emulsion-document-header h2{
			font-size:1.5rem;
		}
		th{
			padding:.5rem;
		}
		.emulsion-document-table{
			margin-left:auto;
			margin-right:auto;
			width:calc(100% - 2rem);
		}
		.emulsion-document-table a{
			text-decoration:none;
		}
		.emulsion-document-table.form-table tr:nth-child(odd){
			background:#ecf0f1;
		}
		.emulsion-document-table.form-table td{
			padding:.5rem 10px;
		}
		thead,
		.emulsion-document-table.form-table tr.item-title{
			background:var(--thm_emulsion-accent-bg);

		}
		th,
		.emulsion-document-table.form-table tr.item-title th{
			text-align:center;
			color:var(--thm_emulsion-accent-fg);
			background:var(--thm_emulsion-accent-bg);
			padding:.5rem;

		}
		tfoot td{
			padding:.5rem;
		}
		.theme-info-table td{
			text-align:left;
			border:1px solid #ccc;
		}
		.theme-info-table td.col-1{
			width:240px;
			margin:var(--thm_box_gap);
		}
		.emulsion-document-table.form-table tr.sub-title,
		.emulsion-document-table.form-table tr.title{
			margin:0;
			padding:1rem 10px;
			background:transparent;
			vertical-align:top;

		}
		.emulsion-document-table .sub-title td[colspan]{
			border:none;
			padding:1rem 10px;
			background:transparent;
		}
		.emulsion-document-table pre code{
			display:block;
		}
		.emulsion-document-table tbody tr{
			border:1px solid #ccc;
		}
		.form-table.emulsion-document-table td{
			vertical-align:top;
		}
		.dashicons-layout:before {
			content: "\\f538";
			margin-right:6px;
		}
		.template-tag-table,
		.svg-icon-table{
			width:100%;
			border-collapse: collapse;
		}
		.template-tag-table thead th,
		.template-tag-table td{
			padding-left:24px;
			padding-right:24px;
		}
		.svg-icon-table thead th,
		.svg-icon-table .svg-icon{
			text-align:center;
		}
		.template-tag-table tr:nth-child(odd),
		.svg-icon-table tr:nth-child(odd) {
			background: #ecf0f1;
		}
		.template-tag-table code,
		.svg-icon-table code{
			background:transparent;
		}
		.template-tag-table th,
		.template-tag-table td,
		.svg-icon-table th,
		.svg-icon-table td{
			border:1px solid #ccc;
		}
		.emulsion-info{
			padding:1rem;
			width:-moz-fit-content;
			width:fit-content;
		}
		.additional-class{
			margin-left:2rem;
			padding-left:40px;
		}
		.additional-class li{

		}
		.additional-class li ul{
			margin-left:2rem;
		}
		.additional-class .label{
			font-weight:700;
		}
		.emulsion-notice{
			display:inline-block;
		}
		.block-name{
			margin-left:2rem;
		}
		.additional-class{
			margin-left:4rem;
		}
		.lvl-1{
			text-indent:2rem;
		}
		.lvl-2{
			text-indent:4rem;
		}
		.lvl-3{
			text-indent:6rem;
		}
		.wrap-emulsion_document_shortcode h1,
		.emulsion-document #poststuff h1{
			font-size:3rem;
			margin:1.5em auto .75em;
			padding-left:24px;
			padding-right:24px;
		}
		.wrap-emulsion_document_shortcode h2,
		.emulsion-document #poststuff h2{
			font-size:2rem;
			margin:1.5em auto .75em;
			padding-left:24px;
			padding-right:24px;
		}
		.wrap-emulsion_document_shortcode h3,
		.emulsion-document #poststuff h3{
			font-size:1.15rem;
			margin:1.5em auto .75em;
			padding-left:24px;
			padding-right:24px;
		}
		.wrap-emulsion_document_shortcode h4,
		.emulsion-document #poststuff h4{
			font-size:1rem;
			margin:1.5em auto .75em;
			padding-left:24px;
			padding-right:24px;
		}

		.custom-classes{
		}
		.custom-classes h4,
		.custom-classes h3,
				.custom-classes h2,
		.custom-classes h1{
			margin-top:1.5rem;
			margin-bottom:.75rem;
		}
		.icon{
			width:18px;
			height:18px;
		}
	svg.icon-cool{
            --thm_social_icon_color:rgba(52, 152, 219, 1);
            fill:var(--thm_social_icon_color, #666);
    }
    svg.icon-notice{
            --thm_social_icon_color:rgba(163, 140, 8, 1);
            fill:var(--thm_social_icon_color, #666);
    }
	svg.icon-info{
            --thm_social_icon_color:rgba(22, 160, 133, 1);
            fill:var(--thm_social_icon_color, #666);
    }
	svg.icon-alert{
            --thm_social_icon_color:rgba(231, 76, 60, 1);
            fill:var(--thm_social_icon_color, #666);
    }
	svg.icon.icon-dark{
            --thm_social_icon_color:#000;
            fill:#000;
    }

	.wp-block-group.grid {

		--thm_content_width: 720px;
	  --thm_box_gap:3px;
	}
	.wp-block-group.grid .wp-block-group__inner-container {
	  margin-left: auto;
	  margin-right: auto;
	}
	.wp-block-group.grid > .wp-block-group__inner-container{
	  display: flex;
	  flex-wrap: wrap;
	  overflow: visible;
	  padding-top: var(--thm_box_gap);
	}
	.wp-block-group.grid > .wp-block-group__inner-container > .grid-child *,
	.wp-block-group.grid > .wp-block-group__inner-container > .grid-child *{

	}
	.wrap-emulsion_document_shortcode .wp-block-group.grid  .wp-block-group__inner-container > .grid-child,
	.wp-block-group.grid > .wp-block-group__inner-container > .grid-child {

		border:1px solid #ccc;
	  --thm_content_width: 720px;

	margin:5px;
	  max-width: 100%;
	  min-width: 0;
	  box-sizing: border-box;
	  display: block;
	  margin-left: auto;
	  margin-right: auto;
	  flex: 0 1 calc(50% - 5px - var(--thm_box_gap) * 2);
	}
.wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size1of1, .wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size1of1 {
  flex: 0 1 calc(100% - 5px - var(--thm_box_gap) * 2);
}
.wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size1of3, .wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size1of3 {
  flex: 0 1 calc(33.33333% - 5px - var(--thm_box_gap) * 2);
}
.wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size1of4, .wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size1of4 {
  flex: 0 1 calc(24.99% - 5px - var(--thm_box_gap) * 2);
}
.wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size1of2, .wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size1of2 {
  flex: 0 1 calc(50% - 5px - var(--thm_box_gap) * 2);
}
.wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size1of5, .wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size1of5 {
  flex: 0 1 calc(19.99% - 5px - var(--thm_box_gap) * 2);
}
.wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size2of3, .wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size2of3 {
  flex: 0 1 calc(66.66666% - 5px - var(--thm_box_gap) * 2);
}
.wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size2of5, .wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size2of5 {
  flex: 0 1 calc(40% - 5px - var(--thm_box_gap) * 2);
}
.wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size3of4, .wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size3of4 {
  flex: 0 1 calc(75% - 5px - var(--thm_box_gap) * 2);
}
.wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size3of5, .wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size3of5 {
  flex: 0 1 calc(60% - 5px - var(--thm_box_gap) * 2);
}
.wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size4of5, .wp-block-group.grid > .wp-block-group__inner-container > .grid-child.size4of5 {
  flex: 0 1 calc(80% - 5px - var(--thm_box_gap) * 2);
}
.wp-block-group.grid > .wp-block-group__inner-container .centered {
  display: flex;
  height: auto;
}
.wp-block-group.grid > .wp-block-group__inner-container .wp-block-image {
  width: 100%;
  margin: 0;
  min-height: 100%;
}
.wp-block-group.grid > .wp-block-group__inner-container .wp-block-image img {
  display: block;
  max-width: 100%;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
@media screen and (max-width: 768px) {
  .wp-block-group.grid .wp-block-group__inner-container {
    display: block;
  }
  .wp-block-group.grid .wp-block-group__inner-container .grid-child {
    margin-left: auto;
    margin-right: auto;
  }
}
.centered{
    display: -webkit-box;
    -webkit-box-pack: center;
    -webkit-box-align: center;
    -webkit-box-sizing:border-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
    -ms-flex-direction:column;
    flex-direction:column;
    height:100%;
    box-sizing:border-box;
}
.vh25{
    min-height:25vh;
}
.vh50{
    min-height:50vh;
}
.vh75{
    min-height:75vh;
}
.vh100{
    min-height:100vh;
}
.block-name{
	margin-top:3rem;
	margin-bottom:3rem;
	font-size:1.15rem;
	border:1px solid;
	background:#fff;
	text-decoration:none;
	display:inline-block;
	padding:.6rem .8rem;
}
.document-description,
.block-wrapper{
	overflow:hidden;
}

CSS;

	printf( '<style>%1$s</style>', wp_strip_all_tags( $css ) );
}

/**
 * Create Tab Menu
 */
function emulsion_admin_tabs( $current = 'homepage' ) {

	$tabs	 = array(
		'homepage'		 => esc_html__( 'Home', 'emulsion-addons' ),
		'customizer'	 => esc_html__( 'Customizer', 'emulsion-addons' ),
		'embed'			 => esc_html__( 'Embed Media', 'emulsion-addons' ),
		'advanced'		 => esc_html__( 'Advanced Class', 'emulsion-addons' ),
		'templatetag'	 => esc_html__( 'Template Tag', 'emulsion-addons' ),
		'icon'			 => esc_html__( 'Theme Icon', 'emulsion-addons' ),
	);
	if( 'theme' !== emulsion_get_theme_operation_mode() ) {

		$tabs	 = array(
			'homepage'		 => esc_html__( 'Home', 'emulsion-addons' ),
			'advanced'		 => esc_html__( 'Advanced Class', 'emulsion-addons' ),
		);
	}
	$links	 = array();

	echo '<h2 class="nav-tab-wrapper">';

	foreach ( $tabs as $tab => $name ) {
		$class = ( $tab == $current ) ? ' nav-tab-active' : '';

		printf( '<a class="nav-tab %1$s" href="?page=theme-settings&tab=%2$s">%3$s</a>', esc_attr( $class ), esc_attr( $tab ), esc_html( $name ) );
	}
	echo '</h2>';
}

/**
 *  Make Customizer link
 */
function emulsion_get_customizer_link_element( $place, $name, $link_text = '' ) {



	if($place == 'section' && empty( $link_text ) ) {

		global $emulsion_theme_customize_sections;

		$label = $emulsion_theme_customize_sections[$name]['title'];

	}
	if($place == 'panel' && empty( $link_text ) ) {

		global $emulsion_theme_customize_panels;

		$label = $emulsion_theme_customize_panels[$name]['title'];

	}

	if($place == 'control' && empty( $link_text ) ) {


	$label = emulsion_get_var( $name, 'label' );

	// Exception setting
	switch ( $name ) {

		case('header_image'):
			$label	 = esc_html__( 'Header Media', 'emulsion-addons' );
			break;
		case('header_textcolor'):
			$label	 = esc_html__( 'Header Text Color', 'emulsion-addons' );
			break;
		case('widgets'):
			$label	 = esc_html__( 'Widgets', 'emulsion-addons' );
			break;
		case('emulsion_section_fonts_widget_meta'):
			$label	 = esc_html__( 'Widget, Meta data,', 'emulsion-addons' );
			break;

		case('background_color'):
			$label	 = esc_html__( 'Background Color', 'emulsion-addons' );
			break;
		case('emulsion_layout_homepage'):
			$label	 = esc_html__( 'Home Page', 'emulsion-addons' );
			break;
		case('emulsion_layout_posts_page'):
			$label	 = esc_html__( 'Posts Page', 'emulsion-addons' );
			break;
		case('emulsion_layout_date_archives'):
			$label	 = esc_html__( 'Date Archives', 'emulsion-addons' );
			break;
		case('emulsion_layout_category_archives'):
			$label	 = esc_html__( 'Category Archives', 'emulsion-addons' );
			break;
		case('emulsion_layout_tag_archives'):
			$label	 = esc_html__( 'Category Archives', 'emulsion-addons' );
			break;
		case('emulsion_layout_author_archives'):
			$label	 = esc_html__( 'Author Page', 'emulsion-addons' );
			break;
		case('background_image'):
			$label	 = esc_html__( 'Background Image', 'emulsion-addons' );
			break;
		case('custom_logo'):
			$label	 = esc_html__( 'Custom Logo', 'emulsion-addons' );
			break;
	}
	}

	if( ! empty( $link_text ) ) {
		$label = sanitize_text_field( $link_text );
	}
	$query["autofocus[{$place}]"] = $name;

	$link = add_query_arg( $query, admin_url( 'customize.php' ) );

	printf( '<a href="%1$s">%2$s</a>', esc_url( $link ), wp_kses( $label, array() ) );
}

/**
 * Display Pages
 */
function emulsion_settings_page() {
	global $pagenow;

	$theme_name			 = emulsion_theme_info( 'Name', false );
	?>

	<div class="emulsion-document">
		<header class="emulsion-document-header">
			<h2><span class="dashicons dashicons-welcome-learn-more"></span> <?php esc_html_e( 'Theme:', 'emulsion-addons' ) ?> <?php echo esc_html( $theme_name ); ?></h2>
		</header>

	<?php //isset( $_GET['tab'] ) ? emulsion_admin_tabs( $_GET['tab'] ) : emulsion_admin_tabs( 'homepage' );   ?>
		<?php
		$emulsion_tab_value	 = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_SPECIAL_CHARS );
		$emulsion_page_value = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS );
		isset( $emulsion_tab_value ) ? emulsion_admin_tabs( $emulsion_tab_value ) : emulsion_admin_tabs( 'homepage' );
		?>
		<div id="poststuff">

	<?php
	if ( $pagenow == 'themes.php' && $emulsion_page_value == 'theme-settings' ) {

		$tab = isset( $emulsion_tab_value ) ? $emulsion_tab_value : 'homepage';

		switch ( $tab ) {
			case 'general' :
				?>
						<tr>
							<th>Tags with CSS classes:</th>
							<td>
								<span class="description">Output each post tag with a specific CSS class using its slug.</span>
							</td>
						</tr>
				<?php
				break;
			case 'templatetag' :
				emulsion_plugin_template_part( 'documents/' . $tab );
				break;
			case 'customizer' :
				emulsion_plugin_template_part( 'documents/' . $tab );
				break;
			case 'embed' :
				emulsion_plugin_template_part( 'documents/' . $tab );
				break;
			case 'homepage' :
				emulsion_plugin_template_part( 'documents/' . $tab );
				break;
			case 'advanced':
				emulsion_plugin_template_part( 'documents/' . $tab );
				break;
			case 'icon':
				emulsion_plugin_template_part( 'documents/' . $tab );
				break;
		}
	}
	?>
		</div>
		<footer class="emulsion-document-footer">
			<p><?php echo esc_html( $theme_name ); ?></p>
		</footer>

	</div>
	<?php
}
