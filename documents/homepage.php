<div class="wp-block-group grid">
	<h1><?php esc_html_e("What's New", 'emulsion' ) ?></h1>
	<div class="wp-block-group__inner-container">
		<div class="grid-child centered vh25 size1of2 solid-border color-scheme-sunrise">
			<h3><?php  emulsion_get_customizer_link_element( 'panel', 'emulsion_theme_settings_border_panel', esc_html__( 'Support Custom Border', 'emulsion' ) ); ?></h3>
		</div>
		<div class="grid-child centered vh25 size1of2 solid-border color-scheme-sunrise">
			<h3>The primary menu can be displayed normally even if javascript is off</h3>
		</div>		
		
		<div class="grid-child centered size1of2 solid-border color-scheme-default">
			<h3><?php printf('<a href="%1$s">%2$s</a>' ,'https://www.tenman.info/wp3/emulsion/en/2020/06/29/block-group/', 
					esc_html__( 'Block group grid class support', 'emulsion' ) );?></h3>
			<p><?php esc_html_e( 'required Gutenberg Plugin', 'emulsion' ) ?></p>
		</div>
		<div class="grid-child centered size1of2 solid-border color-scheme-default">
			<h3><?php printf('<a href="%1$s">%2$s</a>' ,'https://www.tenman.info/wp3/emulsion/en/2020/06/29/link-color-settings/',  
					esc_html__( 'Block paragraph, heading link color support', 'emulsion' )); ?></h3>
			<p><?php esc_html_e( 'required Gutenberg Plugin', 'emulsion' ) ?></p>
		</div>
	</div>
</div>
<h1><?php esc_html_e( 'Theme Info', 'emulsion' ) ?></h1>
<table class="theme-info-table form-table color-scheme-fresh">
	<tr>
		<td class='col-1'><?php esc_html_e( 'Theme', 'emulsion' ); ?></td>
		<td><?php emulsion_theme_info( 'Name' ); ?></td>
	</tr>
	<tr>
		<td class='col-1'><?php esc_html_e( 'Version', 'emulsion' ); ?></td>
		<td><?php emulsion_theme_info( 'Version' ); ?></td>
	</tr>
	<tr>
		<td class='col-1'><?php esc_html_e( 'Theme Home Page', 'emulsion' ); ?></td>
		<td><a href="<?php echo esc_url( emulsion_theme_info( 'ThemeURI', false ) ); ?>"><?php echo esc_url( emulsion_theme_info( 'ThemeURI', false ) ); ?></a></td>
	</tr>
	<tr>
		<td class='col-1'>Reports bug, any questions</td>
		<td><?php printf('<a href="%1$s">%1$s</a>', 'https://wordpress.org/support/theme/emulsion/' );?></td>
	</tr>
	<tr>
		<td class='col-1'><?php esc_html_e( 'Minimum PHP version', 'emulsion' ); ?></td>
		<td>PHP<?php echo esc_html( EMULSION_MIN_PHP_VERSION ); ?></td>
	</tr>
</table>

<h1><?php esc_html_e( 'Theme-specific features', 'emulsion' ); ?></h1>
<div class="wp-block-group grid">
	<div class="wp-block-group__inner-container">	
		<div class='grid-child centered vh25 size1of2 solid-border color-scheme-ectoplasm'>
			<h3><?php esc_html_e( 'Social menu', 'emulsion' ); ?></h3>
			<p><?php esc_html_e( 'Social menu supports phone links and email links', 'emulsion' ); ?></p>
			<p><?php esc_html_e( 'These features are closely related to your privacy protection. Please use it after careful consideration', 'emulsion' ); ?></p>
			<p><?php esc_html_e( 'The telephone number is displayed on the PC browser, but the link does not work. The link works only when access from a mobile browser is detected.', 'emulsion' ); ?></p>
		</div>
		<div class='grid-child centered vh25 size1of2 solid-border color-scheme-ocean'>
			<h3><?php esc_html_e( 'Auto Contrast', 'emulsion' ); ?></h3>
			<p><?php esc_html_e( 'This theme will automatically set the text color suitable for the background color setting you made', 'emulsion' ); ?></p>
			<p><?php esc_html_e( 'For example, if a shortcode or plug-in has a background color, try to keep it as readable as possible, but it is not perfect', 'emulsion' ); ?></p>
			<p><?php esc_html_e( 'If you have any problems, please contact the above support', 'emulsion' ); ?></p>
		</div>
		<div class='grid-child centered vh25 size1of2 solid-border color-scheme-midnight'>
			<h3><?php esc_html_e( 'Dark Mode', 'emulsion' ); ?></h3>
			<p><?php esc_html_e( 'It is not enabled by default, but can be enabled by changing the EMULSION_DARK_MODE_SUPPORT constant in lib / config.php to true.', 'emulsion' ); ?></p>
		</div>
		<div class='grid-child centered vh25 size1of2 solid-border color-scheme-light'>
		<h3><?php printf( '<a href="%1$s">%2$s</a>', esc_url( 'https://www.tenman.info/wp3/emulsion/en/2019/12/27/accsessibility-ui-2/' ), esc_html__( 'Accessibility', 'emulsion' ) ); ?></h3>
		<p><?php esc_html_e( 'Themes have a tab navigation feature for accessibility', 'emulsion' ); ?></p>
		</div>
	</div>
</div>