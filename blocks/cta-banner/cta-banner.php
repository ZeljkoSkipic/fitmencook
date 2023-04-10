<?php

$title = get_field('title');
$ac_text = get_field('ac_text');

$class = 'fmc_cta_banner';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

?>

<div class="<?php echo $class; ?>">
	<div class="fmc_container">
		<div class="fmc_ctab_content">
			<div class="img_bg">
			<?php
				$background_image = get_field('background_image');
				$size = 'full'; // (thumbnail, medium, large, full or custom size)
				if( $background_image ) {
					echo wp_get_attachment_image( $background_image, $size );
			} ?>
			</div>
			<h2 class="fmc_title_2 fmc_acta_title"><?php echo $title; ?></h2>
			<?php
			$button = get_field('button');
			if( $button ):
				$button_url = $button['url'];
				$button_title = $button['title'];
				$button_target = $button['target'] ? $button['target'] : '_self';
				?>
				<a class="fmc_btn" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_title ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</div>
