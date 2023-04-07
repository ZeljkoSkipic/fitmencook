<?php

$title = get_field('title');
$style = get_field_object('style');

$class = 'fmc_media spacing_1_0';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}
if ( ! empty( $style ) ) {
    $class .=  ' ' . $style['value'];
}

?>

<div class="<?php echo $class; ?>">
	<div class="fmc_container">
		<h2 class="fmc_title_1 title_spacing_2"><?php echo $title; ?></h2>
		<div class="fmc_media_content">
		<?php
		// Check rows existexists.
		if( have_rows('media_column') ):

			// Loop through rows.
			while( have_rows('media_column') ) : the_row();

				// Load sub field value.
				$logo = get_sub_field('logo');
				$image = get_sub_field('image');
				$size = 'full';
				$col_text = get_sub_field('col_text');
				$button_text_and_link = get_sub_field('button_text_and_link');
				// Do something... ?>
				<div class="fmc_media_col">
					<?php if( $logo ) {
						echo wp_get_attachment_image( $logo, $size, "", array('class' => 'fmc_media_logo') );
					} ?>
					<?php if($col_text) : ?>
					<div class="col_text">
						<?php echo $col_text; ?>
					</div>
					<?php endif; ?>
					<div class="fmc_col_content">
					<?php if( $image ) {
						echo wp_get_attachment_image( $image, $size, "", array('class' => 'fmc_media_image') );
					} ?>
					<?php if( $button_text_and_link ):
						$link_url = $button_text_and_link['url'];
						$link_title = $button_text_and_link['title'];
						$link_target = $button_text_and_link['target'] ? $button_text_and_link['target'] : '_self';
						?>
					<a class="fmc_btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					<?php endif; ?>
					</div>
				</div>
			<?php // End loop.
			endwhile;
		endif; ?>
		</div>
	</div>
</div>
