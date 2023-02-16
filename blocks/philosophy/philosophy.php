<?php

$class = 'fmc_philosophy';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

?>


<div class="<?php echo $class; ?>">
<div class="img_bg">
	<?php
	$background_image = get_field('background_image');
	$size = 'full'; // (thumbnail, medium, large, full or custom size)
	if( $background_image ) {
		echo wp_get_attachment_image( $background_image, $size );
	} ?>
</div>
	<div class="fmc_container">
		<div class="fmc_philosophy_content">
			<h2 class="fmc_title_2"><?php the_field('philosophy_title'); ?></h2>
			<div class="fmc_pc_columns">
				<?php if( have_rows('column') ): ?>
					<?php while( have_rows('column') ): the_row();
						$c_title = get_sub_field('title');
						$c_content = get_sub_field('subtitle');
						?>
						<div class="fmc_p_box">
							<h3 class="fmc_p_title">
								<?php echo $c_title; ?>
							</h3>
							<div class="fmc_p_content">
								<?php echo $c_content; ?>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
