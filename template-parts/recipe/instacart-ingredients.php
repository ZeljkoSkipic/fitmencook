<div class="fmc_ingredients">
	<?php

	if( have_rows('ing_group') ): ?>

		<?php while( have_rows('ing_group') ) : the_row(); ?>
		<?php $ing_title = get_sub_field('ing_g_title'); ?>
		<?php if( $ing_title ) { ?>
			<strong><?php echo $ing_title; ?></strong>
		<?php } ?>
		<ul>
		<?php while( have_rows('ingredients_instacart') ) : the_row(); ?>

			<?php
			$ingredient = get_sub_field('ingredient');
			$ingredient_link = get_sub_field('ingredient_link');
			$note = get_sub_field('note');
			$substitution = get_sub_field('substitution');
			?>
			<li>

			<?php if( $ingredient_link ) { ?>
				<a href="<?php echo $ingredient_link; ?>" target="_blank">
			<?php } ?>
			<?php echo $ingredient; ?>
			<?php if( $ingredient_link ) { ?>
				</a>
			<?php } ?>



			<?php if( $note || $substitution ) : ?>
				<ul>
					<?php if( $note ) { ?>
					<li><?php echo $note; ?></li>
					<?php } ?>
					<?php if( $substitution ) { ?>
					<li><?php echo $substitution; ?></li>
					<?php } ?>
				</ul>
			<?php endif; ?>
		</li>
		<?php endwhile; ?>
		</ul>

		<?php endwhile; ?>

	<?php endif; ?>
</div>
