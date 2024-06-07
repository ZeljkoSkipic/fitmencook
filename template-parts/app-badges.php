<div class="fmc_app_icons">
	<figure>
	<?php
	$app_store_link = get_field('app_store_link', 'option');
	if( $app_store_link ):
		$app_store_url = $app_store_link['url'];
		$app_store_target = $app_store_link['target'] ? $app_store_link['target'] : '_self';
		?>
		<a href="<?php echo esc_url( $app_store_url ); ?>" target="<?php echo esc_attr( $app_store_target ); ?>" aria-label="App Store">
		<?php
		$iphone = get_field('app_store_image', 'option');
		$size = 'full'; // (thumbnail, medium, large, full or custom size)
		if( $iphone ) {
			echo wp_get_attachment_image( $iphone, $size );
		} ?>
		</a>
	<?php endif;
	?>
	</figure>
	<figure>
	<?php
	$google_play_link = get_field('google_play_link', 'option');
	if( $google_play_link ):
		$google_play_url = $google_play_link['url'];
		$google_play_target = $google_play_link['target'] ? $google_play_link['target'] : '_self';
		?>
		<a href="<?php echo esc_url( $google_play_url ); ?>" target="<?php echo esc_attr( $google_play_target ); ?>" aria-label="Google Play Store">
		<?php
		$android = get_field('google_play_image', 'option');
		if( $android ) {
			echo wp_get_attachment_image( $android, $size );
		} ?>
		</a>
	<?php endif;
	?>
	</figure>
</div>
