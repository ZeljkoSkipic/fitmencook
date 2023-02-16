<?php

$block_title = get_field('block_title');
$style = get_field('title_style');

$class = 'fmc_blurbs fmc_container spacing_1';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

?>


<div class="<?php echo $class; ?>">
	<?php if( have_rows('blurb') ): ?>
		<?php if($block_title) { ?>
		<h2 class="fmc_blurbs_title <?php echo $style; ?>"><?php echo $block_title; ?></h2>
		<?php } ?>
		<div class="fmc_blurbs_inner">
			<?php while( have_rows('blurb') ): the_row();
				$b_icon = get_sub_field('b_icon');
				$b_title = get_sub_field('b_title');
				$b_subtitle = get_sub_field('b_subtitle');
				?>
				<div class="fmc_blurb">
					<?php
						$size = 'full'; // (thumbnail, medium, large, full or custom size)
						if( $b_icon ) { ?>
							<figure class="fmc_b_icon">
							<?php echo wp_get_attachment_image( $b_icon, $size ); ?>
							</figure>
						<?php } ?>
					<?php if( $b_title ) { ?>
					<h3 class="fmc_b_title">
						<?php echo $b_title; ?>
					</h3>
					<?php } ?>
					<div class="fmc_b_content text_1">
						<?php echo $b_subtitle; ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>
</div>
