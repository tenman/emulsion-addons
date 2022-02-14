<?php
if( 'theme' !== emulsion_get_theme_operation_mode() ) {

	return;
}
?>
<h3>Oembed media support</h3>

<table class="form-table emulsion-document-table color-scheme-default">
	<thead>
		<tr class="item-title">
			<th><?php esc_html_e('Service', 'emulsion-addons' ) ?></th>
			<th><?php esc_html_e('Type', 'emulsion-addons' ) ?></th>
			<th><?php esc_html_e('Since', 'emulsion-addons' ) ?></th>
			<th><?php esc_html_e('alignleft', 'emulsion-addons' ) ?></th>
			<th><?php esc_html_e('aligncenter', 'emulsion-addons' ) ?></th>
			<th><?php esc_html_e('alignright', 'emulsion-addons' ) ?></th>
			<th><?php esc_html_e('alignwide', 'emulsion-addons' ) ?></th>
			<th><?php esc_html_e('alignfull', 'emulsion-addons' ) ?></th>
		</tr>
	</thead>
    <tbody>
		 <tr>
           <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://www.tiktok.com/', esc_html__( 'TikTok', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-media-video"></span> <?php esc_html_e('Videos', 'emulsion-addons' ) ?></td>
            <?php printf('<td>%1$s</td>', 'WordPress 5.4' ) ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
           <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://amazon.com',  esc_html__( 'Amazon Kindle instant previews', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-media-video"></span> <?php esc_html_e('Videos', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_4.9', 'WordPress 4.9' ) ?>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://animoto.com', esc_html__( 'Animoto', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-media-video"></span> <?php esc_html_e('Videos', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_4.0','WordPress 4.0' ) ?>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://blip.tv/', esc_html__( 'Blip', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-media-video"></span> <?php esc_html_e('Videos', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_2.9', 'WordPress 2.9' ) ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
             <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://cloudup.com', esc_html__( 'Cloudup', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-media-video"></span> <?php esc_html_e('Videos', 'emulsion-addons' ) ?>, Galleries, <br /><span class="dashicons dashicons-format-image"></span> <?php esc_html_e('Images', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_4.4', 'WordPress 4.4' ) ?>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://crowdsignal.com/', esc_html__( 'Crowdsignal', 'emulsion-addons' ) ) ?>
            <td> <?php esc_html_e('Polls &amp; Surveys', 'emulsion-addons') ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_3.0', 'WordPress 3.0' ) ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://www.dailymotion.com/', esc_html__( 'DailyMotion', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-media-video"></span> <?php esc_html_e('Videos', 'emulsion-addons' ) ?></td>
             <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_2.9', 'WordPress 2.9' ) ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
             <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://www.facebook.com/', esc_html__( 'Facebook', 'emulsion-addons' ) ) ?>
            <td> <?php esc_html_e('post, activity, photo, video, media, question, note', 'emulsion-addons') ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_4.7', 'WordPress 4.7' ) ?>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-no-alt"></span></td>
            <td><span class="dashicons dashicons-no-alt"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://www.flickr.com/', esc_html__( 'Flickr', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-media-video"></span> <?php esc_html_e('Videos', 'emulsion-addons' ) ?> <br /> <span class="dashicons dashicons-format-image"></span> <?php esc_html_e('Images', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_2.9', 'WordPress 2.9' ) ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://www.funnyordie.com/', esc_html__( 'FunnyOrDie.com', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-media-video"></span> <?php esc_html_e('Videos', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_3.0', 'WordPress 3.0' ) ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://www.hulu.com/', esc_html__( 'Hulu', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-media-video"></span> <?php esc_html_e('Videos', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_2.9', 'WordPress 2.9' ) ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://imgur.com', esc_html__( 'Imgur', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-format-image"></span> <?php esc_html_e('Images', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_3.9', 'WordPress 3.9' ) ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://instagram.com', esc_html__( 'Instagram', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-format-image"></span> <?php esc_html_e('Images', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_3.5', 'WordPress 3.5' ) ?>
            <td><span class="dashicons dashicons-yes"></span>              </td>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td>  <span class="dashicons dashicons-no-alt"></span></td>
            <td>  <span class="dashicons dashicons-no-alt"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://issuu.com', esc_html__( 'Issuu', 'emulsion-addons' ) ) ?>
            <td> <?php esc_html_e('Documents', 'emulsion-addons') ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_4.0', 'WordPress 4.0' ) ?>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td>  <span class="dashicons dashicons-no-alt"></span></td>
            <td> <span class="dashicons dashicons-no-alt"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://www.kickstarter.com/', esc_html__( 'Kickstarter', 'emulsion-addons' ) ) ?>
            <td> <?php esc_html_e('Projects', 'emulsion-addons') ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_4.2', 'WordPress 4.2' ) ?>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td> <span class="dashicons dashicons-yes"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://meetup.com', esc_html__( 'Meetup.com', 'emulsion-addons' ) ) ?>
            <td> <?php esc_html_e('Various', 'emulsion-addons') ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_3.9', 'WordPress 3.9' ) ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://mixcloud.com', esc_html__( 'Mixcloud', 'emulsion-addons' ) ) ?>
            <td> <?php esc_html_e('Music', 'emulsion-addons') ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_4.0', 'WordPress 4.0' ) ?>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://photobucket.com/', esc_html__( 'Photobucket', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-format-image"></span> <?php esc_html_e('Images', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_2.9', 'WordPress 2.9' ) ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://reddit.com/', esc_html__( 'Reddit', 'emulsion-addons' ) ) ?>
            <td> <?php esc_html_e('Posts &amp; Comments', 'emulsion-addons') ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_4.4', 'WordPress 4.4' ) ?>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-no-alt"></span></td>
            <td><span class="dashicons dashicons-no-alt"></span></td>
        </tr>
        <tr>
           <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://reverbnation.com/', esc_html__( 'ReverbNation', 'emulsion-addons' ) ) ?>
            <td> <?php esc_html_e('Music', 'emulsion-addons') ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_4.4', 'WordPress 4.4' ) ?>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-no-alt"></span></td>
            <td><span class="dashicons dashicons-no-alt"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://www.scribd.com/', esc_html__( 'Scribd', 'emulsion-addons' ) ) ?>
            <td> <?php esc_html_e('Documents', 'emulsion-addons') ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_2.9', 'WordPress 2.9' ) ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://www.slideshare.net', esc_html__( 'SlideShare', 'emulsion-addons' ) ) ?>
            <td><?php esc_html_e('Presentation slideshows', 'emulsion-addons') ?> </td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_3.5', 'WordPress 3.5' ) ?>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://www.smugmug.com/', esc_html__( 'SmugMug', 'emulsion-addons' ) ) ?>
            <td> <?php esc_html_e('Various', 'emulsion-addons') ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_3.0', 'WordPress 3.0' ) ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://soundcloud.com/', esc_html__( 'SoundCloud', 'emulsion-addons' ) ) ?>
            <td> <?php esc_html_e('Music', 'emulsion-addons') ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_3.5', 'WordPress 3.5' ) ?>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://speakerdeck.com/', esc_html__( 'Speaker Deck', 'emulsion-addons' ) ) ?>
            <td> <?php esc_html_e('Presentation slideshows', 'emulsion-addons') ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_4.4', 'WordPress 4.4' ) ?>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td> <span class="dashicons dashicons-yes"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://www.spotify.com/', esc_html__( 'Spotify', 'emulsion-addons' ) ) ?>
            <td> <?php esc_html_e('Music', 'emulsion-addons') ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_3.6', 'WordPress 3.6' ) ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://www.ted.com/', esc_html__( 'TED', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-media-video"></span> <?php esc_html_e('Videos', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_4.0', 'WordPress 4.0' ) ?>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td> <span class="dashicons dashicons-yes"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://www.tumblr.com/', esc_html__( 'Tumblr', 'emulsion-addons' ) ) ?>
            <td> <?php esc_html_e('Various', 'emulsion-addons') ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_4.2', 'WordPress 4.2' ) ?>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-no-alt"></span></td>
            <td> <span class="dashicons dashicons-no-alt"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://twitter.com', esc_html__( 'Twitter', 'emulsion-addons' ) ) ?>
            <td> <?php esc_html_e('Tweet, profile, list, collection, likes, Moment', 'emulsion-addons') ?></td>
             <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_3.4', 'WordPress 3.4' ) ?>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td> <span class="dashicons dashicons-no-alt"></span></td>
            <td> <span class="dashicons dashicons-no-alt"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://videopress.com/', esc_html__( 'VideoPress', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-media-video"></span> <?php esc_html_e('Videos', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_4.4', 'WordPress 4.4' ) ?>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://vimeo.com/', esc_html__( 'Vimeo', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-media-video"></span> <?php esc_html_e('Videos', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_2.9', 'WordPress 2.9' ) ?>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://vine.co/', esc_html__( 'Vine', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-media-video"></span> <?php esc_html_e('Videos', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_4.1', 'WordPress 4.1' ) ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'http://wordpress.org/plugins-wp/', esc_html__( 'WordPress plugin directory', 'emulsion-addons' ) ) ?>
            <td><?php esc_html_e('Plugins', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_4.4', 'WordPress 4.4' ) ?>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://wordpress.tv/', esc_html__( 'WordPress.tv', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-media-video"></span> <?php esc_html_e('Videos', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_2.9', 'WordPress 2.9' ) ?>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
        </tr>
        <tr>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://www.youtube.com/', esc_html__( 'YouTube', 'emulsion-addons' ) ) ?>
            <td> <span class="dashicons dashicons-media-video"></span> <?php esc_html_e('Videos', 'emulsion-addons' ) ?></td>
            <?php printf('<td> <a href="%1$s">%2$s</a></td>', 'https://codex.wordpress.org/Version_2.9', 'WordPress 2.9' ) ?>
            <td> <span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
            <td><span class="dashicons dashicons-yes"></span></td>
        </tr>
    </tbody>
</table>