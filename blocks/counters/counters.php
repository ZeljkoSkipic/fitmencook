<?php

$class = 'fmc_counters fmc_container';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

?>


<div class="<?php echo $class; ?>">
	<?php if( have_rows('column') ): ?>
		<?php while( have_rows('column') ): the_row();
			$c_title = get_sub_field('title');
			$c_content = get_sub_field('subtitle');
			?>
			<div class="fmc_counter_col">
				<h3 class="fmc_c_title fmc_title_2">
					<?php echo $c_title; ?>
				</h3>
				<div class="fmc_c_content">
					<?php echo $c_content; ?>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
