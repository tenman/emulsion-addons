<div class="wp-block-group grid">

	<h2><?php esc_html_e("Significant changes", 'emulsion-addons' ) ?></h2>
	<div class="wp-block-group__inner-container">


		<div class="grid-child centered vh25 size1of2 solid-border color-scheme-sunrise">
			<h3><?php printf('<a href="%1$s">%2$s</a>' , esc_url( esc_html__('https://www.tenman.info/wp3/emulsion/en/2021/03/31/%e3%83%96%e3%83%ad%e3%83%83%e3%82%af%e3%82%a8%e3%83%87%e3%82%a3%e3%82%bf%e3%81%ae%e8%89%b2%e8%a8%ad%e5%ae%9a%e3%81%a8%e3%83%86%e3%83%bc%e3%83%9e%e9%96%93%e3%81%ae%e4%ba%92%e6%8f%9b%e6%80%a7%e3%81%ab/', 'emulsion') ),
					esc_html__( 'Notes on block editor color settings and compatibility between themes', 'emulsion-addons' ) );?></h3>
		</div>
		<div class="grid-child centered vh25 size1of2 solid-border color-scheme-light">
			<h3><?php printf('<a href="%1$s">%2$s</a>' , esc_url( esc_html__( 'https://www.tenman.info/wp3/emulsion/en/2020/12/01/emulsion-block-variation-and-styles/', 'emulsion-addons' ) ),
					esc_html__( 'Supported the experimental Block Variation and Styles', 'emulsion-addons' ) );?></h3>
		</div>

		<div class="grid-child centered vh25 size1of3 solid-border color-scheme-light">
			<h3><?php printf('<a href="%1$s">%2$s</a>' , esc_url( esc_html__( 'https://www.tenman.info/wp3/emulsion/en/2020/11/21/fse-experimental-support/', 'emulsion-addons' ) ),
					esc_html__( 'Supported the experimental environment of FSE theme', 'emulsion-addons' ) );?></h3>
			<p><?php esc_html_e( 'required Gutenberg Plugin', 'emulsion-addons' ) ?></p>
			<p><?php esc_html_e( 'required emulsion-addons Plugin', 'emulsion-addons' ) ?></p>
		</div>

		<div class="grid-child centered vh25 size1of3 solid-border color-scheme-light">
			<h3><?php printf('<a href="%1$s">%2$s</a>' , esc_url( esc_html__( 'https://www.tenman.info/wp3/emulsion/en/2020/09/24/scheme/', 'emulsion-addons' ) ),
					esc_html__( 'Scheme support', 'emulsion-addons' ) );?></h3>
		</div>

		<div class="grid-child centered vh25 size1of3 solid-border color-scheme-light">
			<h3><?php  emulsion_get_customizer_link_element( 'panel', 'emulsion_theme_settings_border_panel', esc_html__( 'Support Custom Border', 'emulsion-addons' ) ); ?></h3>
		</div>
		<div class="grid-child centered vh25 size1of3 solid-border color-scheme-light">
			<h3>The primary menu can be displayed normally even if javascript is off</h3>
		</div>

		<div class="grid-child centered size1of3 solid-border color-scheme-light">
			<h3><?php printf('<a href="%1$s">%2$s</a>' , esc_url( esc_html__( 'https://www.tenman.info/wp3/emulsion/en/2020/06/29/block-group/', 'emulsion-addons' ) ),
					esc_html__( 'Block group grid class support', 'emulsion-addons' ) );?></h3>
			<p><?php esc_html_e( 'required Gutenberg Plugin', 'emulsion-addons' ) ?></p>
		</div>
		<div class="grid-child centered size1of3 solid-border color-scheme-light">
			<h3><?php printf('<a href="%1$s">%2$s</a>' , esc_url( esc_html__( 'https://www.tenman.info/wp3/emulsion/en/2020/06/29/link-color-settings/', 'emulsion-addons' ) ),
					esc_html__( 'Block paragraph, heading link color support', 'emulsion-addons' )); ?></h3>
			<p><?php esc_html_e( 'required Gutenberg Plugin', 'emulsion-addons' ) ?></p>
		</div>
	</div>
</div>
<h2><?php esc_html_e( 'Theme Info', 'emulsion-addons' ) ?></h2>
<table class="theme-info-table form-table color-scheme-fresh">
	<tr>
		<td class='col-1'><?php esc_html_e( 'Theme', 'emulsion-addons' ); ?></td>
		<td><?php emulsion_theme_info( 'Name' ); ?></td>
	</tr>
	<tr>
		<td class='col-1'><?php esc_html_e( 'Version', 'emulsion-addons' ); ?></td>
		<td><?php emulsion_theme_info( 'Version' ); ?></td>
	</tr>
	<tr>
		<td class='col-1'><?php esc_html_e( 'Theme Home Page', 'emulsion-addons' ); ?></td>
		<td><a href="<?php echo esc_url( emulsion_theme_info( 'ThemeURI', false ) ); ?>"><?php echo esc_url( emulsion_theme_info( 'ThemeURI', false ) ); ?></a></td>
	</tr>
	<tr>
		<td class='col-1'>Reports bug, any questions</td>
		<td><?php printf('<a href="%1$s">%1$s</a>', esc_url( esc_html( 'https://wordpress.org/support/theme/emulsion/', 'emulsion-addons' ) ) );?></td>
	</tr>
	<tr>
		<td class='col-1'><?php esc_html_e( 'Minimum PHP version', 'emulsion-addons' ); ?></td>
		<td>PHP<?php echo esc_html( EMULSION_MIN_PHP_VERSION ); ?></td>
	</tr>
</table>

<h2><?php esc_html_e( 'Theme-specific features', 'emulsion-addons' ); ?></h2>
<div class="wp-block-group grid">
	<div class="wp-block-group__inner-container">
		<div class='grid-child centered vh25 size1of2 solid-border color-scheme-ectoplasm'>
			<h3><?php esc_html_e( 'Social menu', 'emulsion-addons' ); ?></h3>
			<p><?php esc_html_e( 'Social menu supports phone links and email links', 'emulsion-addons' ); ?></p>
			<p><?php esc_html_e( 'These features are closely related to your privacy protection. Please use it after careful consideration', 'emulsion-addons' ); ?></p>
			<p><?php esc_html_e( 'The telephone number is displayed on the PC browser, but the link does not work. The link works only when access from a mobile browser is detected.', 'emulsion-addons' ); ?></p>
		</div>
		<div class='grid-child centered vh25 size1of2 solid-border color-scheme-ocean'>
			<h3><?php esc_html_e( 'Auto Contrast', 'emulsion-addons' ); ?></h3>
			<p><?php esc_html_e( 'This theme will automatically set the text color suitable for the background color setting you made', 'emulsion-addons' ); ?></p>
			<p><?php esc_html_e( 'For example, if a shortcode or plug-in has a background color, try to keep it as readable as possible, but it is not perfect', 'emulsion-addons' ); ?></p>
			<p><?php esc_html_e( 'If you have any problems, please contact the above support', 'emulsion-addons' ); ?></p>
		</div>
		<div class='grid-child centered vh25 size1of2 solid-border color-scheme-midnight'>
			<h3><?php esc_html_e( 'Dark Mode', 'emulsion-addons' ); ?></h3>
			<p><?php esc_html_e( 'It is not enabled by default, but can be enabled by changing the EMULSION_DARK_MODE_SUPPORT constant in lib / config.php to true.', 'emulsion-addons' ); ?></p>
		</div>
		<div class='grid-child centered vh25 size1of2 solid-border color-scheme-light'>
		<h3><?php printf( '<a href="%1$s">%2$s</a>', esc_url( esc_html__( 'https://www.tenman.info/wp3/emulsion/en/2019/12/27/accsessibility-ui-2/', 'emulsion-addons' ) ), esc_html__( 'Accessibility', 'emulsion-addons' ) ); ?></h3>
		<p><?php esc_html_e( 'Themes have a tab navigation feature for accessibility', 'emulsion-addons' ); ?></p>
		</div>
	</div>
</div>